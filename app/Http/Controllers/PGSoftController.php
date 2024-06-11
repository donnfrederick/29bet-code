<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PGGamesAccess;
use App\Http\Controllers\ControlBalanceController;
use App\Models\Admin\GameList;
use App\Models\ControlBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PGSoftController extends Controller
{
    public $host;
    public $pgHost;
    public $pgOT;
    private $pgSC;
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }

    public function PGCreds($host) {
        if ($host == "29bet.com") {
            $this->pgHost = "https://api.pg-bo.co/";
            $this->pgOT = "FFEFA831-12C9-4637-B791-C445FFE40394";
            $this->pgSC = "F6E2BFC83865448E9C7B28DFF7584F99";
        } else {
            $this->pgHost = "https://api.pg-bo.me/";
            $this->pgOT = "404e6a1e01771a3cf4cd6d028386337c";
            $this->pgSC = "f00100f9caea895502996b77365aa6dc";
        }
    }

    /**
     * Route = /api/testgame/VerifySession
     * This route is for VerifySession
     */
    public function ApiVerifySession(Request $request) {
        $this->PGCreds($request->getHost());
        $traceId = $request->get('trace_id');
        $req = $this->requestParser($request->getContent());

        $PGGamesAccess = new PGGamesAccess();
        $access_id = $PGGamesAccess->saveNew($traceId, $request->getContent(), now(), "");

        $PGGamesAccess->saveResponse($access_id, "Successfully Accessed");
        if ($this->validatePG($req['operator_token'], $req['secret_key'])) {
            $PGGamesAccess->saveResponse($access_id, "Successfully Validated");
            if ($user = $this->userController->validateToken($req['operator_player_session'])) {
                $PGGamesAccess->saveResponse($access_id, "OPS Successfully Validated");

                $data = [
                    "player_name" => $user->username,
                    "nickname" => str_replace(' ', '', $user->name),
                    "currency" => "BRL"
                ];

                $PGGamesAccess->saveResponse($access_id, json_encode($data));

                $response = $this->processResponse($data, null, 200);
            } else $response = $this->processResponse([], "Invalid request", "1034");
        } else $response = $this->processResponse([], "Invalid request", "1034");

        return $response;
    }

    /**
     * Route = /api/testgame/Cash/Get
     * This route is for CashGet
     */
    public function ApiCashGet(Request $request) {
        $this->PGCreds($request->getHost());
        $traceId = $request->get('trace_id');
        $req = $this->requestParser($request->getContent());

        $PGGamesAccess = new PGGamesAccess();
        $access_id = $PGGamesAccess->saveNew($traceId, $request->getContent(), now(), "");

        if ($this->validatePG($req['operator_token'], $req['secret_key'])) {
            if ($user = $this->userController->validateToken($req['operator_player_session'])) {
                if ($req['player_name'] == $user->username) {
                    $data = [
                        "currency_code" => "BRL",
                        "balance_amount" => floatval($user->getControlBalance()->control_balance),
                        "updated_time" => $user->getControlBalance()->getUpdatedAt()
                    ];
                    
                    $PGGamesAccess->saveResponse($access_id, json_encode($data));

                    $response = $this->processResponse($data, null, 200);
                } else $response = $this->processResponse([], "Invalid request", "1034");
            } else $response = $this->processResponse([], "Invalid request", "1034");
        } else $response = $this->processResponse([], "Invalid request", "1034");

        return $response;
    }

    /**
     * Route = /api/testgame/Cash/Transfer
     * This route is for CashTransfer
     */
    public function ApiCashTransfer(Request $request) {
        $this->PGCreds($request->getHost());
        $traceId = $request->get('trace_id');
        $req = $this->requestParser($request->getContent());

        if ($this->validatePG($req['operator_token'], $req['secret_key'])) {
            if ($this->shouldValidateSession($req)) {
                if ($user = $this->userController->validateToken($req['operator_player_session'])) {
                    $response = $this->processTransfer($user, $req, $traceId, $request->getContent(), "CashTransfer");
                } else $response = $this->processResponse([], "Invalid request", "3004");
            } else {
                if ($user = $this->userController->validateName($req['player_name'])) {
                    $response = $this->processTransfer($user, $req, $traceId, $request->getContent(), "CashTransfer");
                } else $response = $this->processResponse([], "Invalid request", "3004");
            }
        } else $response = $this->processResponse([], "Bet failed", "3033");

        return $response;
    }

    /**
     * Route = /api/testgame/Cash/Adjustment
     * or
     * Route = /Cash/Adjustment
     * This route is for Adjustment
     */
    public function ApiCashAdjustment(Request $request) {
        $this->PGCreds($request->getHost());
        $traceId = $request->get('trace_id');
        $req = $this->requestParser($request->getContent());

        if ($this->validatePG($req['operator_token'], $req['secret_key'])) {
            if ($user = $this->userController->validateName($req['player_name'])) {
                $response = $this->processAdjustment($user, $req, $traceId, $request->getContent(), "CashAdjustment");
            } else $response = $this->processResponse([], "Invalid request", "3004");
        } else $response = $this->processResponse([], "Player does not exist", "3004");

        return $response;
    }

    /**
     * This function will deduct the bet_amount to current user balance
     * Will return true if succeed
     * Returns false if balance is Insufficient
     */
    private function processTransfer($user, $req, $traceId, $req_content) {
        $GameHistoryController = new GameHistoryController();
        $GameList = new GameList();
        $game_id = $req['game_id'];
        $transfer_amount = $req['transfer_amount'];
        $provider = $GameList->getGameBy('game_id', $game_id);
        $bet_amount = $req['bet_amount'];
        $win_amount = $req['win_amount'];
        $updated_time = $req['updated_time'];
        $transaction_id = $req['transaction_id'];

        $PGGamesAccess = new PGGamesAccess();

        if ($pg_prev = $PGGamesAccess->where('unix', $transaction_id)->first()) {
            $response = $this->processResponse(json_decode($pg_prev->response), null, 200);
        } else {
            if ($req['currency_code'] == "BRL") {
                if ($this->validateTransferAmount($user->uid, $bet_amount)) {
                    if (bcsub($win_amount, $bet_amount, 2) == $transfer_amount) {
                        if ($req['win_amount'] == 0.00) {
                            if ($GameHistoryController->addLose($user->uid, $bet_amount, $game_id, $provider->game_provider, $traceId, $transfer_amount)) {
                                $data = [
                                    "currency_code" => "BRL",
                                    "balance_amount" => floatval($user->getControlBalance()->control_balance),
                                    "updated_time" => $updated_time + 0
                                ];
                                
                                $PGGamesAccess->saveNew($traceId, $req_content, $transaction_id, json_encode($data));
                
                                $response = $this->processResponse($data, null, 200);
                            } else $response = $this->processResponse([], "InsufficientBalance", "3202");
                        } else {
                            if ($GameHistoryController->addWin($user->uid, $bet_amount, $win_amount, $game_id, $provider->game_provider, $traceId, $transfer_amount)) {
                                $data = [
                                    "currency_code" => "BRL",
                                    "balance_amount" => floatval($user->getControlBalance()->control_balance),
                                    "updated_time" => $updated_time + 0
                                ];
                                
                                $PGGamesAccess->saveNew($traceId, $req_content, $transaction_id, json_encode($data));
                
                                $response = $this->processResponse($data, null, 200);
                            } else $response = $this->processResponse([], "InsufficientBalance", "3202");
                        }
                    } else $response = $this->processResponse([], "BetFailedException", "3073");
                } else $response = $this->processResponse([], "InsufficientBalance", "3202");
            } else $response = $this->processResponse([], "Invalid request", "3004");
        }

        return $response;
    }

    /**
     * This function will adjust player wallet
     * Will return true if succeed
     */
    private function processAdjustment($user, $req, $traceId, $req_content) {
        $transfer_amount = $req['transfer_amount'];
        $adjustment_transaction_id = $req['adjustment_transaction_id'];
        $adjustment_time = $req['adjustment_time'];

        $PGGamesAccess = new PGGamesAccess();

        if ($pg_prev = $PGGamesAccess->where('unix', $adjustment_transaction_id)->first()) {
            $response = $this->processResponse(json_decode($pg_prev->response), null, 200);
        } else {
            if ($req['currency_code'] == "BRL") {
                if ($this->validateTransferAmount($user->uid, $transfer_amount)) {
                    if ($transfer_amount < 0) {
                        if ($user->getControlBalance()->control_balance >= $transfer_amount) {
                            $ControlBalanceController = new ControlBalanceController();
            
                            $balance_before = $user->getControlBalance()->control_balance;
            
                            if ($ControlBalanceController->deduct($user->uid, abs($transfer_amount), 0, "PG")) {
                                $data = [
                                    "adjust_amount" => floatval($transfer_amount),
                                    "balance_before" => floatval($balance_before),
                                    "balance_after" => floatval($ControlBalanceController->getAccount($user->uid)->control_balance),
                                    "updated_time" => $adjustment_time + 0
                                ];
                                
                                $PGGamesAccess->saveNew($traceId, $req_content, $adjustment_transaction_id, json_encode($data));

                                $response = $this->processResponse($data, null, 200);
                            } else $response = $this->processResponse([], "InsufficientBalance", "3202");
                        } else $response = $this->processResponse([], "InsufficientBalance", "3202");
                    } else {
                        $ControlBalanceController = new ControlBalanceController();
            
                        $balance_before = $user->getControlBalance()->control_balance;
            
                        if ($ControlBalanceController->add($user->uid, $transfer_amount, 0, "PG")) {
                            $data = [
                                "adjust_amount" => floatval($transfer_amount),
                                "balance_before" => floatval($balance_before),
                                "balance_after" => floatval($ControlBalanceController->getAccount($user->uid)->control_balance),
                                "updated_time" => $adjustment_time + 0
                            ];
                                
                            $PGGamesAccess->saveNew($traceId, $req_content, $adjustment_transaction_id, json_encode($data));

                            $response = $this->processResponse($data, null, 200);
                        } else $response = $this->processResponse([], "Player wallet does not exist", "3005");
                    }
                } else $response = $this->processResponse([], "InsufficientBalance", "3202");
            } else $response = $this->processResponse([], "Invalid request", "3004");
        }

        return $response;
    }

    private function validateTransferAmount($uid, $amount) {
        $ControlBalance = \App\Models\ControlBalance::where('uid', $uid)
            ->first();

        if ($ControlBalance) {
            if ($ControlBalance->control_balance >= abs($amount)) {
                return true;
            } else return false;
        } else return false;
    }

    /**
     * This will return a complete response to PG
     */
    private function processResponse($data, $err, $status) {
        if ($err == null) {
            $rdata = [
                "data" => $data,
                "error" => null
            ];
        } else {
            $rdata = [
                "data" => null,
                "error" => [
                    "code" => $status,
                    "message" => $err
                ]
            ];
        }
        return response()->json($rdata, 200);
    }

    /**
     * This will determine if operator_player_session is valid
     */
    private function shouldValidateSession($req) {
        $shouldValidate = true;

        if (isset($req['is_validate_bet']) && $req['is_validate_bet'] == true) {
            $shouldValidate = false;
        }

        if (isset($req['is_adjustment']) && $req['is_adjustment'] == true) {
            $shouldValidate = false;
        }

        return $shouldValidate;
    }

    private function validatePG($token, $secret) {
        if ($this->pgOT == $token && $this->pgSC == $secret) {
            return true;
        } else return false;
    }

    private function requestParser($reqBody) {
        $body = explode('&', $reqBody);
        $req = [];

        foreach ($body as $rbody) {
            $requestBody = explode('=', $rbody);

            $req[$requestBody[0]] = $requestBody[1];
        }

        return $req;
    }

    private function stringifyRequest($reqArr) {
        $strReq = "";

        $i = 0;
        foreach ($reqArr as $key => $req) {
            if ($i == 0) {
                $strReq .= $key . '=' . $req;
            } else {
                $strReq .= '&' . $key . '=' . $req;
            }
            $i++;
        }

        return $strReq;
    }
}

?>
