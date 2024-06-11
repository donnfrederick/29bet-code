<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TokenController;
use App\Models\ControlBalance;
use App\Models\FreeSpin;
use App\Models\GameHistory;
use App\Models\Transactions;
use App\Models\ActionType;
use App\Models\RouletteConfigurations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class FreeSpinController extends Controller {
    private $freeSpin;
    private $controlBalance;
    private $transactions;
    private $ActionType;
    private $gameHistory;
    private $minReq;

    public function __construct()
    {
        $this->middleware('auth');
        $this->freeSpin = new FreeSpin();
        $this->controlBalance = new ControlBalance();
        $this->transactions = new Transactions();
        $this->ActionType = new ActionType();
        $this->gameHistory = new GameHistory();
        $this->minReq = RouletteConfigurations::mininumRequirement();
    }

    public function Spin() {
        if ($this->computeChances(Auth::user()->uid)[0] >= 1) {
            if (!$transaction_id = $this->saveSpinTransaction(Auth::user()->uid)) {
                return response()->json([], 500);
            } else return response()->json(['available' => true, 'trId' => TokenController::generateUniqueString($transaction_id, Auth::user()->api_token), 'prb' => $this->getSegmentsProbability()], 200);
        } else return response()->json(['available' => false], 200);
    }

    public function Win(Request $request) {
        $fsTransaction = $this->transactions::where('uid', Auth::user()->uid)->orderBy('id', 'desc')->first();

        $parts = explode('2eAE101', $request->trId);

        if ($parts[1] == Auth::user()->api_token) {
            if (TokenController::validateHash($request->trId, $fsTransaction->transaction_id)) {
                $status = $this->freeSpin->win(
                    \App\Models\RouletteConfigurations::where('status', 1)
                    ->get()
                    ->first()
                    ->roulette_config_id,
                    Auth::user()->uid,
                    $request->win,
                    $request->code,
                    $fsTransaction->transaction_id
                );

                if ($status) {
                    if ($this->saveWinTransaction($fsTransaction->transaction_id, $request->win)) {
                        return response()->json(['bal' => $this->controlBalance->computeControlBalance(Auth::user()->uid)], 200);
                    } else return response()->json([], 500);
                } else return response()->json([], 500);
            } else return response()->json(['Invalid'], 500);
        } else return response()->json(['Unauthorized'], 500);
    }

    public function Settings() {
        $chances = $this->computeChances(Auth::user()->uid);
        return response()->json([
            'ccs' => $chances[0],
            'aps' => $this->freeSpin::select(DB::raw("SUM(win) as total"))->get()->first()->total,
            'map' => $this->computeBetHistory($this->gameHistory->getBets(Auth::user()->uid)),
            'ncs' => $chances[1],
            'rcj' => $this->getRecentJackpots()
        ], 200);
    }

    public function getSegmentsProbability() {
        $prb = [];
        $Configs = \App\Models\RouletteConfigurations::where('status', 1)
            ->get()
            ->first()
            ->RouletteMain()
            ->orderBy('sorting', 'asc')
            ->get();

        foreach ($Configs as $config) {
            $prb[] = $this->numhash($config->probability_rate + 1);
        }

        return implode(";", array_reverse($prb));
    }

    private function computeChances($uid) {
        $apostas = $this->computeBetHistory($this->gameHistory->getBets($uid));
        $spins = $this->computeApostas($apostas);
        return [
            $spins - $this->getSpinCount($uid),
            $this->nextChanceAt($apostas)
        ];
    }

    private function getSpinCount($uid) {
        return $this->transactions->getUserTransactionsByAction($uid, [37])->count();
    }

    private function computeApostas($apostas) {
        for ($i = 0;$apostas > 0; $i++) {
            if ($apostas >= $this->minReq) {
                $apostas -= $this->minReq;
            } else {
                $apostas = 0;
                $i -= 1;
            }
        }

        return $i;
    }

    private function nextChanceAt($apostas) {
        if ($apostas % $this->minReq == 0) {
            return $apostas + $this->minReq;
        } else {
            for ($i = 0;$apostas > 0; $i++) {
                if ($apostas >= $this->minReq) {
                    $apostas -= $this->minReq;
                } else {
                    $apostas = 0;
                }
            }

            return $i * $this->minReq;
        }
    }

    private function computeBetHistory($loseHistory) {
        $bets = 0;

        foreach ($loseHistory->get() as $bet) {
            $bets += $bet->bet;
        }

        return $bets;
    }

    private function computeSpinHistory($spins) {
        $total = 0;

        foreach ($spins->get() as $spin) {
            if (is_int($spin->win)) {
                $total += $spin->win;
            }
        }

        return $total;
    }

    private function saveSpinTransaction($uid) {
        $Transactions = new Transactions();

        $account = $this->controlBalance->getBalance(Auth::user()->uid);

        $Transactions->uid = $uid;
        $Transactions->transaction_id = $this->generateTransactionId();
        $Transactions->transaction_type = $this->ActionType->getActionDescription(37);
        $Transactions->transaction_description = "User played FreeSpin";
        $Transactions->date_transacted = now();
        $Transactions->before_balance = $account->control_balance;
        $Transactions->action_id = 37;
        $Transactions->amount = 0; 
        $Transactions->new_balance = $account->control_balance;
        $Transactions->admin_remarks = '';
        $Transactions->system_remarks = '';

        if ($Transactions->save()) {
            return $Transactions->transaction_id;
        } else {
            return false;
        }
    }

    private function saveWinTransaction($trId, $amount) {
        $Transactions = new Transactions();
        $transaction = $Transactions->getTransaction($trId)->first();

        $uid = Auth::user()->uid;

        if ($this->controlBalance->addDiscountBalance($amount, $uid)) {
            $transaction->amount = $amount;
            $transaction->new_balance = $this->controlBalance->getBalance($uid)->control_balance;

            if ($this->controlBalance->updateRollOver($amount, $uid)) {
                if ($transaction->save()) {
                    return true;
                } else return false;
            } else return false;
        } else return false;
    }

    private function generateTransactionId() {
        $prefix = "TRXWD";
        $maxdigits = '19';
        $randnum = '';
        while (strlen($randnum) < $maxdigits) {
            $randnum .= mt_rand(0, 9);
        }

        return $prefix."-".$randnum;
    }

    private function getRecentJackpots() {
        return FreeSpin::where('win', '!=', 0)->where('win', '<', 3000)->select(DB::raw('SUBSTRING(uid, 1, 4) as uid'), 'win', 'created_at')->orderBy('id', 'desc')->take(4)->get();
    }

    private function numhash($inNum) {
        return (((0x0000FFFF & $inNum) << 16) + ((0xFFFF0000 & $inNum) >> 16));
    }
}

?>
