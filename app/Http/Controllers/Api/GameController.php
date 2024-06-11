<?php

namespace App\Http\Controllers\Api;

use App\Models\ControlBalance;
use App\Models\GameHistory;
use App\Models\HistoryBalance;
use App\Models\Admin\GameConfiguration;
use App\Http\Controllers\GeneralController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TokenController;
use App\Models\Admin\GameList;
use App\Models\Admin\GameProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    private $controlBalance;
    private $gameHistory;
    private $historyBalance;

    //Controller
    private $generalController;

    //Games Configuration
    private $gameConfiguration;
    private $crashConfig;
    private $minesConfig;
    private $towerConfig;
    private $stairsConfig;

    public function __construct()
    {
        $this->middleware('auth');
        $this->controlBalance = new ControlBalance();
        $this->gameHistory = new GameHistory();
        $this->historyBalance = new HistoryBalance();
        $this->gameConfiguration = new GameConfiguration();
        $this->generalController = new GeneralController;
    }

    // -------------------------------------------------------------------------------------------------
    //API Routing

    /**
     * @Route = /api/crash/config
    */
    public function CrashConfig(Request $request) {
        $game_id = $request->game_id;

        if ($game_id == 2) {
            $this->initCrashConfiguration();

            return response()->json([
                'status' => 200,
                'cf' => $this->crashConfig
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
        @Route = /api/mines/init
    */
    public function MinesInit(Request $request) {
        $bet = $request->bet;

        $cfs = [
            3 => 0,
            4 => 1,
            5 => 2,
            6 => 3,
            7 => 4,
            8 => 5,
            9 => 6,
            10 => 7,
            11 => 8,
            12 => 9,
            13 => 10,
            14 => 11,
            15 => 12,
            16 => 13,
            17 => 14,
            18 => 15,
            19 => 16,
            20 => 17,
            21 => 18,
            22 => 19,
            23 => 20,
            24 => 21
        ];

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $this->initMinesConfiguration();
        $mines = $request->mines;
        $ddResponse = $this->deduct($request->bet, $request->game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'new_balance' => $ddResponse['new_balance'],
                'multiplier' => $this->generalController::getMinesMultiplierTable()[$mines],
                'c' => $this->minesConfig[$cfs[$mines]],
                'i' => $this->minesConfig[22],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'ghid' => $ddResponse['ghid']
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/tower/init
    */
    public function TowerInit(Request $request) {
        $bet = $request->bet;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $this->initTowerConfiguration();
        $mines = $request->mines;
        $ddResponse = $this->deduct($request->bet, $request->game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'new_balance' => $ddResponse['new_balance'],
                'multiplier' => $this->generalController::getTowerMultiplierTable()[$mines],
                'c' => $this->towerConfig[$mines - 1],
                'i' => $this->towerConfig[4],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'ghid' => $ddResponse['ghid']
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/double/result
    */
    public function DoubleResult() {
        return response()->json(['status' => 200, 'result' => $this->generateDoubleResult()]);
    }

    /**
     * @Route = /api/blackjack/init
    */
    public function BlackJackInit(Request $request) {
        $bet = $request->bet;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $ddResponse = $this->deduct($request->bet, $request->game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'new_balance' => $ddResponse['new_balance'],
                'game' => $this->generalController->blackjack($request->bet),
                'decks' => $this->generalController->getDeck(),
                'uid' => substr(Auth::user()->uid, 0, 4),
                'ghid' => $ddResponse['ghid']
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/stairs/init
    */
    public function StairsInit(Request $request) {
        $bet = $request->bet;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $this->initStairsConfiguration();
        $mines = $request->mines;
        $ddResponse = $this->deduct($request->bet, $request->game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'n' => $ddResponse['new_balance'],
                'm' => $this->generalController::getStairsMultiplierTable()[$mines],
                'c' => $this->stairsConfig[$mines],
                'i' => $this->stairsConfig['inc'],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'ghid' => $ddResponse['ghid']
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/blackjack/insure
     */
    public function BlackJackInsure(Request $request) {
        $bet = $request->bet;
        $game_id = $request->game_id;
        $uid = Auth::user()->uid;
        $session_id = $request->session_id;
        $provider = GameProvider::where('game_provider_name', '29Bet')
            ->get()
            ->first()
            ->id;

        if ($game_history = $this->gameHistory::where('uid', $uid)->orderBy('id', 'desc')->first()) {
            $game_history_id = $game_history->id;
            $parts = explode('2eAE101', $request->ghid);

            if ($parts[1] == Auth::user()->api_token) {
                $update = [
                    'bet' => $game_history->first()->bet + $bet
                ];

                if ($game_history->update($update)) {
                    if ($this->generalController->blackjack_insure($session_id)->original['error'] == null) {
                        return $this->controlBalance->deduct($bet, $uid, $game_id, $provider, $game_history_id, $this->generateOrderNumber());
                    } else return response()->json(['error', 'An error occurred'], 500);
                } else return response()->json(['error', 'Unable to update game history'], 500);
            } else return response()->json(['error' => 'Invalid'], 500);
        } else return response()->json(['error' => 'Unauthorized'], 500);
    }

    /**
     * @Route = /api/blackjack/double
     */
    public function BlackJackDouble(Request $request) {
        $bet = $request->bet;
        $game_id = $request->game_id;
        $uid = Auth::user()->uid;
        $session_id = $request->session_id;
        $provider = GameProvider::where('game_provider_name', '29Bet')
            ->get()
            ->first()
            ->id;

        if ($game_history = $this->gameHistory::where('uid', $uid)->orderBy('id', 'desc')->first()) {
            $game_history_id = $game_history->id;
            $parts = explode('2eAE101', $request->ghid);

            if ($parts[1] == Auth::user()->api_token) {
                $update = [
                    'bet' => $game_history->first()->bet + $bet
                ];

                if ($game_history->update($update)) {
                    if ($this->generalController->blackjack_double($session_id)->original['error'] == null) {
                        return $this->controlBalance->deduct($bet, $uid, $game_id, $provider, $game_history_id, $this->generateOrderNumber());
                    } else return response()->json(['error' => 'An error occurred'], 500);
                } else return response()->json(['error' => 'Unable to update game history'], 500);
            } else return response()->json(['error' => 'Invalid'], 500);
        } else return response()->json(['error' => 'Unauthorized'], 500);
    }

    /**
     * @Route = /api/keno/result
     */
    public function KenoResult(Request $request) {
        $bet = $request->bet;
        $game_id = $request->game_id;
        $slots = $request->slots;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $keno_game = $this->createKenoGame($slots, $bet);

        if ($keno_game == false) {
            return response()->json(['status' => 500, 'error' => 'Subject for ban']);
        }

        $ddResponse = $this->deduct($bet, $game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'n' => $ddResponse['new_balance'],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'game' => $keno_game,
                'ghid' => $ddResponse['ghid']
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/plinko/init
     */
    public function PlinkoInit(Request $request) {
        $bet = $request->bet;
        $game_id = $request->game_id;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $game = $this->generalController->plinko($request->difficulty, $request->pins, $bet);

        $ddResponse = $this->deduct($bet, $game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'n' => $ddResponse['new_balance'],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'game' => $game,
                'ghid' => $ddResponse['ghid']
            ], 200);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/dice/init
     */
    public function DiceInit(Request $request) {
        $bet = $request->bet;
        $game_id = $request->game_id;
        $type = $request->type;
        $chance = $request->chance;

        if ($bet < 1 || $bet > 1000 || Auth::user()->showBalance() < $bet) return response()->json(['status' => 500, 'error' => 'Invalid bet amount']);

        $ddResponse = $this->deduct($bet, $game_id);
        if ($ddResponse['status'] == 200) {
            return response()->json([
                'status' => 200,
                'new_balance' => $ddResponse['new_balance'],
                'uid' => substr(Auth::user()->uid, 0, 4),
                'response' => $this->generalController->dice($bet, $type, $chance),
                'ghid' => $ddResponse['ghid']
            ], 200);
        } else {
            return response()->json(['status' => 500, 'error' => 'An error occured']);
        }
    }

    /**
     * @Route = /api/pg/refresh/balance
     */
    public function PGRefreshBalance() {
        return response()->json(['balance' => $this->controlBalance->getBalance(Auth::user()->uid)->control_balance], 200);
    }

    /**
     * @Route = /api/session/bets/get
     */
    public function DoubleGetBets() {
        $results = DB::select("SELECT RIGHT(his.uid, 4) AS uid, his.bet, his.session_param FROM game_session ses JOIN game_history his ON his.session_id = ses.id WHERE ses.game_id = 1 AND ses.status = 0 ORDER BY ses.id DESC LIMIT 20");
        return response()->json(['results' => $results], 200);
    }

    /**
     * @Route = /api/session/bet/get
     */
    public function DoubleGetBet() {
        $uid = Auth::user()->uid;
        $results = DB::select("SELECT RIGHT(his.uid, 4) AS uid, his.bet, his.session_param FROM game_session ses JOIN game_history his ON his.session_id = ses.id WHERE his.uid = :uid AND ses.game_id = 1 AND ses.status = 0 ORDER BY ses.id DESC LIMIT 1", ['uid' => $uid]);
        return response()->json(['results' => $results], 200);
    }

    /**
     * @Route = /api/crash/session/bets/get
     */
    public function CrashGetBets() {
        $results = DB::select("SELECT RIGHT(his.uid, 4) AS uid, his.bet, his.session_param FROM game_session ses JOIN game_history his ON his.session_id = ses.id WHERE ses.game_id = 2 AND ses.status = 0 ORDER BY ses.id DESC LIMIT 20");
        return response()->json(['results' => $results], 200);
    }

    /**
     * @Route = /api/crash/session/bet/get
     */
    public function CrashGetBet() {
        $uid = Auth::user()->uid;
        $results = DB::select("SELECT RIGHT(his.uid, 4) AS uid, his.ghid, his.bet, his.session_param FROM game_session ses JOIN game_history his ON his.session_id = ses.id WHERE his.uid = :uid AND ses.game_id = 2 AND ses.status = 0 ORDER BY ses.id DESC LIMIT 1", ['uid' => $uid]);
        return response()->json(['results' => $results], 200);
    }

    /**
     * @Route = /api/double/resultados
     */
    public function DoubleResultados() {
        $results = DB::select("SELECT result FROM game_session WHERE game_id = 1 AND status = 1 ORDER BY id DESC LIMIT 13");
        return response()->json(['results' => $results], 200);
    }

    /**
     * @Route = /api/crash/resultados
     */
    public function CrashResultados() {
        $results = DB::select("SELECT result FROM game_session WHERE game_id = 2 AND status = 1 ORDER BY id DESC LIMIT 8");
        return response()->json(['results' => $results], 200);
    }

    // -------------------------------------------------------------------------------------------------

    //Local functions
    private function deduct($bet, $game_id) {
        $provider = GameProvider::where('game_provider_name', '29Bet')
            ->get()
            ->first()
            ->id;

        $uid = Auth::user()->uid;

        $order_id = $this->generateOrderNumber();

        $description = "User has lose ".$bet;
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
            $response = json_decode($this->controlBalance->deduct($bet, $uid, $game_id, $provider, $game_history_id, $order_id)->getContent(), true);
            if ($response['status'] == 200) {
                return ['status' => 200, 'new_balance' => $response['new_balance'], 'ghid' => TokenController::generateUniqueString($game_history_id, Auth::user()->api_token)];
            } else {
                return ['status' => 500];
            }
        } else {
            return ['status' => 500];
        }
    }

    // -------------------------------------------------------------------------------------------------

    //Games Configuration

    private function initCrashConfiguration() {
        $crash_config = $this->gameConfiguration
            ->getBy('game_id', 2)
            ->game_parameter;

        $config = explode(',', trim($crash_config, '{}'));
        $cf0 = explode(':', $config[0]);
        $cf1 = explode(':', $config[1]);
        $cf2 = explode(':', $config[2]);
        $cf3 = explode(':', $config[3]);
        $cf4 = explode(':', $config[4]);
        $cf5 = explode(':', $config[5]);
        $cf6 = explode(':', $config[6]);

        $this->crashConfig = [trim($cf0[1], '"'), trim($cf1[1], '"'), trim($cf2[1], '"'), trim($cf3[1], '"'), trim($cf4[1], '"'), trim($cf5[1], '"'), trim($cf6[1], '"')];
    }

    private function initMinesConfiguration() {
        $mines_config = $this->gameConfiguration
            ->getBy('game_id', 3)
            ->game_parameter;

        $config = explode(',', trim($mines_config, '{}'));
        $cf0 = explode(':', $config[0]);
        $cf1 = explode(':', $config[1]);
        $cf2 = explode(':', $config[2]);
        $cf3 = explode(':', $config[3]);
        $cf4 = explode(':', $config[4]);
        $cf5 = explode(':', $config[5]);
        $cf6 = explode(':', $config[6]);
        $cf7 = explode(':', $config[7]);
        $cf8 = explode(':', $config[8]);
        $cf9 = explode(':', $config[9]);
        $cf10 = explode(':', $config[10]);
        $cf11 = explode(':', $config[11]);
        $cf12 = explode(':', $config[12]);
        $cf13 = explode(':', $config[13]);
        $cf14 = explode(':', $config[14]);
        $cf15 = explode(':', $config[15]);
        $cf16 = explode(':', $config[16]);
        $cf17 = explode(':', $config[17]);
        $cf18 = explode(':', $config[18]);
        $cf19 = explode(':', $config[19]);
        $cf20 = explode(':', $config[20]);
        $cf21 = explode(':', $config[21]);
        $cf22 = explode(':', $config[22]);

        $this->minesConfig = [
            trim($cf0[1], '"'),
            trim($cf1[1], '"'),
            trim($cf2[1], '"'),
            trim($cf3[1], '"'),
            trim($cf4[1], '"'),
            trim($cf5[1], '"'),
            trim($cf6[1], '"'),
            trim($cf7[1], '"'),
            trim($cf8[1], '"'),
            trim($cf9[1], '"'),
            trim($cf10[1], '"'),
            trim($cf11[1], '"'),
            trim($cf12[1], '"'),
            trim($cf13[1], '"'),
            trim($cf14[1], '"'),
            trim($cf15[1], '"'),
            trim($cf16[1], '"'),
            trim($cf17[1], '"'),
            trim($cf18[1], '"'),
            trim($cf19[1], '"'),
            trim($cf20[1], '"'),
            trim($cf21[1], '"'),
            trim($cf22[1], '"')];
    }

    private function initTowerConfiguration() {
        $tower_config = $this->gameConfiguration
            ->getBy('game_id', 5)
            ->game_parameter;

        $config = explode(',', trim($tower_config, '{}'));
        $cf0 = explode(':', $config[0]);
        $cf1 = explode(':', $config[1]);
        $cf2 = explode(':', $config[2]);
        $cf3 = explode(':', $config[3]);
        $cf4 = explode(':', $config[4]);

        $this->towerConfig = [trim($cf0[1], '"'), trim($cf1[1], '"'), trim($cf2[1], '"'), trim($cf3[1], '"'), trim($cf4[1], '"')];
    }

    private function initStairsConfiguration() {
        $stairs_config = $this->gameConfiguration
            ->getBy('game_id', 7)
            ->game_parameter;

        $config = explode(',', trim($stairs_config, '{}'));
        $mul1 = explode(':', $config[0]);
        $mul2 = explode(':', $config[1]);
        $mul3 = explode(':', $config[2]);
        $mul4 = explode(':', $config[3]);
        $mul5 = explode(':', $config[4]);
        $mul6 = explode(':', $config[5]);
        $mul7 = explode(':', $config[6]);
        $inc = explode(':', $config[7]);

        $this->stairsConfig = [1 => trim($mul1[1], '"'), 2 => trim($mul2[1], '"'), 3 => trim($mul3[1], '"'), 4 => trim($mul4[1], '"'), 5 => trim($mul5[1], '"'), 6 => trim($mul6[1], '"'), 7 => trim($mul7[1], '"'), 'inc' => trim($inc[1], '"')];
    }

    private function initKenoConfiguration($slot_count) {
        $keno_config = $this->gameConfiguration
            ->getBy('game_id', 12)
            ->game_parameter;

        $config = explode(',', trim($keno_config, '{}'));
        $game_config = [
            explode(':', $config[0]),
            explode(':', $config[1]),
            explode(':', $config[2]),
            explode(':', $config[3]),
            explode(':', $config[4]),
            explode(':', $config[5]),
            explode(':', $config[6]),
            explode(':', $config[7]),
            explode(':', $config[8]),
            explode(':', $config[9]),
            explode(':', $config[10])
        ];

        $normal_probability = [
            trim($game_config[0][1], '"'),
            trim($game_config[1][1], '"'),
            trim($game_config[2][1], '"'),
            trim($game_config[3][1], '"'),
            trim($game_config[4][1], '"'),
            trim($game_config[5][1], '"'),
            trim($game_config[6][1], '"'),
            trim($game_config[7][1], '"'),
            trim($game_config[8][1], '"'),
            trim($game_config[9][1], '"'),
            trim($game_config[10][1], '"')
        ];

        if ($slot_count == 10) {
            return $normal_probability;
        } else {
            if ($slot_count == 9) {
                return [
                    $normal_probability[0],
                    $normal_probability[1],
                    $normal_probability[2] + 2,
                    $normal_probability[3] + 2,
                    $normal_probability[4] - 1,
                    $normal_probability[5] - 1,
                    $normal_probability[6] - 1,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 8) {
                return [
                    $normal_probability[0] + 3,
                    $normal_probability[1] + 2,
                    $normal_probability[2] + 1,
                    $normal_probability[3],
                    $normal_probability[4] - 1,
                    $normal_probability[5] - 2,
                    $normal_probability[6] - 2,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 7) {
                return [
                    $normal_probability[0] + 5,
                    $normal_probability[1] + 4,
                    $normal_probability[2] + 3,
                    $normal_probability[3] + 2,
                    $normal_probability[4] - 6,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 6) {
                return [
                    $normal_probability[0] + 6,
                    $normal_probability[1] + 5,
                    $normal_probability[2] + 4,
                    $normal_probability[3] + 3,
                    $normal_probability[4] - 9,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 5) {
                return [
                    $normal_probability[0] + 10,
                    $normal_probability[1] + 10,
                    $normal_probability[2] + 8,
                    $normal_probability[3] - 8,
                    $normal_probability[4] - 11,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 4) {
                return [
                    $normal_probability[0] + 17,
                    $normal_probability[1] + 13,
                    $normal_probability[2] + 10,
                    $normal_probability[3] - 20,
                    $normal_probability[4] - 11,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 3) {
                return [
                    $normal_probability[0] + 17,
                    $normal_probability[1] + 13,
                    $normal_probability[2] + 10,
                    $normal_probability[3] - 20,
                    $normal_probability[4] - 11,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 2) {
                return [
                    $normal_probability[0] + 32,
                    $normal_probability[1] + 29,
                    $normal_probability[2] - 18,
                    $normal_probability[3] - 23,
                    $normal_probability[4] - 11,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            } elseif ($slot_count == 1) {
                return [
                    $normal_probability[0] + 76,
                    $normal_probability[1] - 10,
                    $normal_probability[2] - 23,
                    $normal_probability[3] - 23,
                    $normal_probability[4] - 11,
                    $normal_probability[5] - 5,
                    $normal_probability[6] - 3,
                    $normal_probability[7] - 1,
                    $normal_probability[8],
                    $normal_probability[9],
                    $normal_probability[10]
                ];
            }
        }
    }

    private function generateDoubleResult() {
        $distribution = [];

        foreach ($this->generalController->initDoubleConfiguration() as $key => $double_config) {
            if ($key == 'basic') {
                $push = 0;
            } else {
                $push = 1;
            }

            for ($i = 1;$i <= $double_config;$i++) {
                $distribution[] = $push;
            }
        }

        shuffle($distribution);

        $dist = $distribution[array_rand($distribution)];

        $results = $this->getDoubleDestribution()[$dist];

        return $results[array_rand($results)];
    }

    private function createKenoGame($slots, $bet) {
        $picked_count = count($slots);

        $payTable = [
            [0, 3.8],
            [0, 1.7, 5.2],
            [0, 0, 2.7, 48],
            [0, 0, 1.7, 10, 84],
            [0, 0, 1.4, 4, 14, 290],
            [0, 0, 0, 3, 9, 160, 720],
            [0, 0, 0, 2, 7, 30, 280, 800],
            [0, 0, 0, 2, 4, 10, 50, 300, 850],
            [0, 0, 0, 2, 2.5, 4.5, 12, 60, 320, 900],
            [0, 0, 0, 1.5, 2, 4, 6, 22, 80, 400, 1000]
        ];

        $pay = $payTable[$picked_count - 1];

        if ($picked_count < 1) return false;

        $random_count = $this->createRandomDistribution($this->initKenoConfiguration($picked_count))[rand(0, 99)];
        $to_lose = 10 - $random_count;

        if ($random_count > $picked_count) {
            $hits = $picked_count;
        } else {
            $hits = $random_count;
        }

        $keno_slots = [];
        for ($i = 1;$i <= 40;$i++) {
            $keno_slots[$i] = $i;
        }

        $random_slots = [];
        $correct_slots = [];

        for ($i = 1;$i <= $random_count;$i++) {
            $key = array_rand($slots);

            $random_slot = $slots[$key];
            $random_slots[] = $random_slot;
            $correct_slots[] = $random_slot;
            $keno_slots_key = array_search($random_slot, $keno_slots);
            unset($slots[$key]);
            unset($keno_slots[$keno_slots_key]);
        }

        foreach($slots as $key => $slot) {
            $keno_slots_key = array_search($slot, $keno_slots);
            unset($slots[$key]);
            unset($keno_slots[$keno_slots_key]);
        }

        for ($j = 1;$j <= $to_lose;$j++) {
            $key = array_rand($keno_slots);

            $random_slots[] = $keno_slots[$key];
            unset($keno_slots[$key]);
        }

        shuffle($random_slots);

        return [
            "correct" => $correct_slots,
            "grid" => $random_slots,
            "hits" => $hits,
            "multiplier" => $pay[$hits],
            "profit" => $pay[$hits] * $bet,
            "win" => $pay[$hits] * $bet
        ];
    }

    // -------------------------------------------------------------------------------------------------
    //VARIABLE DEPENDENCIES

    private function getDoubleDestribution() {
        return [
            0 => [
                 0,  1,  2,  3,  4,  5,  6,  7,  8,  9,
                10, 11, 12, 13, 14, 15, 16, 17, 18, 19
            ],
            1 => [
                20
            ]
        ];
    }

    private function createRandomDistribution($vars) {
        $distribution = [];
        foreach ($vars as $key => $distcount) {
            for ($i = 1;$i <= $distcount;$i++) {
                $distribution[] = $key;
            }
        }

        shuffle($distribution);
        return $distribution;
    }

    private function generateOrderNumber() {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9);
    }
}

?>
