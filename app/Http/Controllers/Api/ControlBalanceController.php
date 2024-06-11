<?php

namespace App\Http\Controllers\Api;

use App\Models\ControlBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TokenController;
use App\Models\Admin\GameList;
use App\Models\Admin\GameProvider;
use App\Models\GameHistory;
use App\Models\HistoryBalance;
use Illuminate\Support\Facades\Auth;

class ControlBalanceController extends Controller
{
    private $controlBalance;
    private $gameHistory;
    private $historyBalance;

    public function __construct()
    {
        $this->middleware('auth');
        $this->controlBalance = new ControlBalance();
        $this->gameHistory = new GameHistory();
        $this->historyBalance = new HistoryBalance();
    }
    /**
     * Check Balance API
    */
    public function Check() {
        $uid = Auth::user()->uid;
        return $this->controlBalance->check($uid);
    }

    /**
     * Balance API deduction
    */
    public function Deduct(Request $request) {
        $uid = Auth::user()->uid;
        $bet = $request->bet;
        $game_id = $request->game_id;

        $provider = GameProvider::where('game_provider_name', '29Bet')
            ->get()
            ->first()
            ->id;

        $GameList = new GameList();
        $game_details = $GameList->getGameBy('game_id', $game_id);

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['error' => 'Invalid bet amount'], 500);

        $description = "User has lose ".$bet;
        $order_id = $this->generateOrderNumber();
        if ($game_history_id = $this->gameHistory->
            create(
                $game_id,
                $description,
                0,
                0,
                $uid,
                11,
                $bet,
                $provider,
                $order_id
            )
        ) {
            return $this->controlBalance->deduct($bet, $uid, $game_id, $provider, $game_history_id, $order_id);
        } else {
            return response()->json(['status' => 500, 'error', 'Unable to update game history']);
        }
    }

    /**
     * Balance API addition
    */
    public function Add(Request $request) {
        $uid = Auth::user()->uid;
        $winnings = $request->winnings;
        $game_id = $request->game_id;
        $description = "User has won ".$winnings;

        $provider = GameProvider::where('game_provider_name', '29Bet')
            ->get()
            ->first()
            ->id;

        if ($game_history = $this->gameHistory::where('uid', Auth::user()->uid)->orderBy('id', 'desc')->first()) {
            $game_history_id = $game_history->id;
            $parts = explode('2eAE101', $request->ghid);

            if ($parts[1] == Auth::user()->api_token) {
                if (TokenController::validateHash($request->ghid, $game_history_id)) {
                    $game_history = GameHistory::where('id', $game_history_id);

                    $update = [
                        "description" => $description,
                        "result" => 1,
                        "amount" => $winnings,
                        "operation_type" => 10
                    ];

                    $order_id = $game_history->first()->order_number;

                    if ($game_history->update($update)) {
                        if ($this->historyBalance
                            ->create(
                                $winnings,
                                10,
                                $uid,
                                $game_id,
                                'win_balance',
                                $game_history_id
                            )
                        ) {
                            return $this->controlBalance->
                                add($winnings, $uid, $game_id, $provider, $order_id);
                        } else {
                            return response()->json(['error' => 'Unable to update balance history'], 500);
                        }
                    } else return response()->json(['error' => 'Unable to update game history'], 500);
                } else return response()->json(['error' => 'Invalid'], 500);
            } else return response()->json(['error' => 'Unauthenticated'], 500);
        } else return response()->json(['error' => 'Unable to find game history'], 500);



        $game_history_id = $request->ghid;
        if ($game_history = $this->gameHistory::where('id', $game_history_id)) {

        } else {
            return response()->json(['status' => 500, 'error', 'Unable to find game history'], 500);
        }
    }

    /**
     * Balance API addition
    */
    public function SessionAdd(Request $request) {
        $uid = Auth::user()->uid;
        $winnings = $request->winnings;
        $game_id = $request->game_id;
        $description = "User has won ".$winnings;

        if ($game_history = $this->gameHistory::where('uid', Auth::user()->uid)->orderBy('id', 'desc')->first()) {
            $game_history_id = $game_history->id;
            $parts = explode('2eAE101', $request->ghid);

            if ($parts[1] == Auth::user()->api_token) {
                if (TokenController::validateHash($request->ghid, $game_history_id)) {
                    $game_history = GameHistory::where('id', $game_history_id);

                    $session_param = get_object_vars(json_decode($game_history->first()->session_param));
                    $session_param['status'] = 1;

                    $update = [
                        "description" => $description,
                        "result" => 1,
                        "amount" => $winnings,
                        "operation_type" => 10,
                        "session_param" => json_encode($session_param)
                    ];

                    $order_id = $game_history->first()->order_number;

                    if ($game_history->update($update)) {
                        if ($this->historyBalance
                            ->create(
                                $winnings,
                                10,
                                $uid,
                                $game_id,
                                'win_balance',
                                $game_history_id
                            )
                        ) {
                            return $this->controlBalance->
                                add($winnings, $uid, $game_id, $order_id);
                        } else {
                            return response()->json(['error' => 'Unable to update balance history'], 500);
                        }
                    } else return response()->json(['error' => 'Unable to update game history'], 500);
                } else return response()->json(['error' => 'Invalid'], 500);
            } else return response()->json(['error' => 'Unauthenticated'], 500);
        } else return response()->json(['error' => 'Unable to find game history'], 500);



        $game_history_id = $request->ghid;
        if ($game_history = $this->gameHistory::where('id', $game_history_id)) {

        } else {
            return response()->json(['status' => 500, 'error', 'Unable to find game history'], 500);
        }
    }

    /**
     * Balance API deduction
    */
    public function SessionDeduct(Request $request) {
        $uid = Auth::user()->uid;
        $bet = $request->bet;
        $game_id = $request->game_id;
        $session_id = $request->session_id;
        $session_param = $request->session_param;

        $GameList = new GameList();
        $game_details = $GameList->getGameby('game_id', $game_id);

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['error' => 'Invalid bet amount'], 500);

        $description = "User has lose ".$bet;
        $order_id = $this->generateOrderNumber();
        if ($game_history_id = $this->gameHistory->
            createWithSession(
                $game_id,
                $description,
                0,
                0,
                $uid,
                11,
                $bet,
                $game_details->game_provider,
                $order_id,
                $session_id,
                $session_param
            )
        ) {
            return $this->controlBalance->deduct($bet, $uid, $game_id, $game_history_id, $order_id);
        } else {
            return response()->json(['status' => 500, 'error', 'Unable to update game history']);
        }
    }

    private function generateOrderNumber() {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9);
    }
}
