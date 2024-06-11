<?php

namespace App\Http\Controllers;

use App\Models\Admin\GameProvider;
use App\Models\ControlBalance;
use App\Models\GameHistory;
use App\Models\HistoryBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class ControlBalanceController
{
    private $ControlBalance;
    private $gameHistory;
    private $historyBalance;

    public function __construct()
    {
        $this->ControlBalance = new ControlBalance();
        $this->gameHistory = new GameHistory();
        $this->historyBalance = new HistoryBalance();
    }

    public function transferToSafety($amount) {
        $uid = Auth::user()->uid;

        if ($this->ControlBalance->isEnough($amount, $uid)) {
        } else {
            dd(response()->json(["error" => "Not enough balance"], 500));
        }
    }

    public function deduct($uid, $bet, $game_id, $provider = null, $order_number = null) {
        //Get the 29Bet provider_id
        if (isNull($provider)) {
            $provider = GameProvider::where('game_provider_name', '29Bet')
                ->get()
                ->first()
                ->id;
        }

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
                $order_number
            )
        ) {
            return $this->ControlBalance->deductFunds($bet, $uid, $game_id, $provider, $game_history_id, $order_number);
        } else {
            return false;
        }
    }

    public function add($uid, $winnings, $game_id, $provider = null, $order_number = null) {
        //Get the 29Bet provider_id
        if (isNull($provider)) {
            $provider = GameProvider::where('game_provider_name', '29Bet')
                ->get()
                ->first()
                ->id;
        }

        $description = "User has won ".$winnings;
        if ($game_history_id = $this->gameHistory
            ->create(
                $game_id,
                $description,
                1,
                $winnings,
                $uid,
                10,
                0,
                $provider,
                $order_number
            )
        ) {
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
                return $this->ControlBalance->
                    addFunds($winnings, $uid, $game_id, $provider, $order_number);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAccount($uid) {
        return $this->ControlBalance->getBalance($uid);
    }
}

?>
