<?php

namespace App\Http\Controllers;

use App\Models\ControlBalance;
use App\Models\GameHistory;
use App\Models\HistoryBalance;

class GameHistoryController
{
    private $GameHistory;
    private $ControlBalance;

    public function __construct()
    {
        $this->GameHistory = new GameHistory();
        $this->ControlBalance = new ControlBalance();
    }

    /**
     * This controller is for PG Fund Transfer
     */
    public function addLose($uid, $bet_amount, $game_id, $provider, $order_number, $transfer_amount) {
        $description = "User has lose ".$bet_amount;

        if ($game_history_id = $this->GameHistory->
            create(
                $game_id,
                $description,
                0,
                0,
                $uid,
                11,
                $bet_amount,
                $provider,
                $order_number
            )
        ) {
            return $this->transferAmount($transfer_amount, $uid, $provider, $game_history_id, $game_id, $order_number);
        } else {
            return false;
        }
    }

    /**
     * This controller is for PG Fund Transfer
     */
    public function addWin($uid, $bet_amount, $winnings, $game_id, $provider, $order_number, $transfer_amount) {
        $description = "User has won ".$winnings;

        if ($game_history_id = $this->GameHistory->
            create(
                $game_id,
                $description,
                1,
                $winnings,
                $uid,
                10,
                $bet_amount,
                $provider,
                $order_number
            )
        ) {
            $HistoryBalance = new HistoryBalance();
            if ($HistoryBalance->create($bet_amount, 10, $uid, $game_id, "win_balance", $game_history_id)) {
                return $this->transferAmount($transfer_amount, $uid, $provider, $game_history_id, $game_id, $order_number);
            } else return false;
        } else {
            return false;
        }
    }

    //PG Dependency
    private function transferAmount($transfer_amount, $uid, $provider, $game_history_id, $game_id, $order_number) {
        if ($transfer_amount < 0) {
            return $this->ControlBalance->deductFunds(abs($transfer_amount), $uid, $game_id, $provider, $game_history_id, $order_number);
        } else {
            return $this->ControlBalance->addFunds($transfer_amount, $uid, $game_id, $provider, $order_number);
        }
    }
}

?>
