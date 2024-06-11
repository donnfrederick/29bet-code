<?php

namespace App\Models;

use App\Http\Controllers\TokenController;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\Admin\BalanceTypes;
use App\Models\Admin\GameList;
use App\Models\Admin\GameRebates;
use App\Models\Admin\PromoSettings;
use App\Models\Admin\RebateSettings;
use App\Models\Admin\DepositAndWithdrawalConfig;
use App\Models\Admin\RebateConfig;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ControlBalance extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'control_balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'control_balance',
        'deposit_balance',
        'win_balance',
        'discount_balance',
        'frozen_normal_balance',
        'agency_balance',
        'frozen_agency_balance',
        'safety_balance',
        'rollover_balance',
        'created_at',
        'updated_at'
    ];

    public function init($uid) {
        $ControlBalance = new ControlBalance();
        $ControlBalance->uid = $uid;
        $ControlBalance->control_balance = 0;
        $ControlBalance->deposit_balance = 0;
        $ControlBalance->win_balance = 0;
        $ControlBalance->discount_balance = 0;
        $ControlBalance->frozen_normal_balance = 0;
        $ControlBalance->agency_balance = 0;
        $ControlBalance->frozen_agency_balance = 0;
        $ControlBalance->safety_balance = 0;
        $ControlBalance->created_at = now();

        if($ControlBalance->save()){
            return true;
        }else{
            return false;
        }
    }

    public function getBalance($uid) {
        $this->computeControlBalance($uid);

        return $this->getAccount($uid);
    }

    //APIs
    public function check($uid) {
        return response()->json([
            'status' => 200,
            'account' => $this->select()
                ->where('uid', $uid)
                ->first()
        ]);
    }

    public function balance($uid) {
        return $this->select('normal_balance')
            ->where('uid', $uid)
            ->first();
    }

    public function deduct($bet, $uid, $game_id, $game_provider, $game_history_id, $order_number) {
        $user = $this->getUser($uid);
        $account = $this->getAccount($uid);

        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        $before_balance = $account->control_balance;
        $new_balance = bcsub($account->control_balance, $bet, 2);
        $description = "Transfer from main platform, amount: $bet, balance before transfer: $before_balance, balance after transfer: $new_balance";

        //BET integration 2.0
        if ($account->control_balance >= $bet) {
            $dlft = $bet;
            foreach ($balances as $key => $balance) {
                if ($dlft > 0 && $balance > 0) {
                    if ($balance >= $dlft) {
                        $ddct = bcsub($balance, $dlft, 2);
                        $balances[$key] = $ddct;
                        $this->saveTransaction($uid, $order_number, "Game Lose", $description, $key, $before_balance, $dlft, $new_balance, 11);
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = bcsub($dlft, $balance, 2);
                        $this->saveTransaction($uid, $order_number, "Game Lose", $description, $key, $before_balance, $balance, $new_balance, 11);
                    }
                }
            }

            $balances['control_balance'] = bcsub($account->control_balance, $bet, 2);
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                if ($this->deductRollOver($bet, $uid)) {
                    $this->agentCommission($uid, $bet, $game_id, $game_provider, $order_number);
                    $this->checkRebate($uid, $game_id, $game_provider, $bet);
                    $this->betCheckPromo($uid, $bet, $game_id, $game_provider);
                    $ghid = TokenController::generateUniqueString($game_history_id, $user->api_token);
                    $GameHistory = GameHistory::where('id', $game_history_id);
                    $GameHistory->update(['ghid' => $ghid]);
                    return response()->json(['status' => 200, 'new_balance' => $this->computeControlBalance($uid), 'uid' => substr($uid, 0, 4), 'ghid' => $ghid]);
                } else return response()->json(['status' => 500, 'error' => 'Unable to update rollover_balance']);
            } else return response()->json(['status' => 500]);
        } else return response()->json(['status' => 500]);
    }

    public function add($winnings, $uid, $game_id, $game_provider, $order_number) {
        $account = $this->getAccount($uid);
        $win_balance = bcadd($account->win_balance, $winnings, 2);

        $before_balance = $account->control_balance;
        $new_balance = bcadd($account->control_balance, $winnings, 2);
        $description = "Transfer to main platform, amount: $winnings, balance before transfer: $before_balance, balance after transfer: $new_balance";

        $this->saveTransaction($uid, $order_number, "Game Win", $description, "win_balance", $before_balance, $winnings, $new_balance, 10);

        $account->update([
            'win_balance' => $win_balance,
            'updated_at' => now()
        ]);

        $this->winCheckPromo($uid, $winnings, $game_id, $game_provider);

        return response()->json(['status' => 200, 'new_balance' => $this->computeControlBalance($uid)]);
    }

    // -- API Controllers ends here

    public function deductFunds($bet, $uid, $game_id, $game_provider, $game_history_id, $order_number) {
        $account = $this->getAccount($uid);

        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        $before_balance = $account->control_balance;
        $new_balance = bcsub($account->control_balance, $bet, 2);
        $description = "Transfer from main platform, amount: $bet, balance before transfer: $before_balance, balance after transfer: $new_balance";

        //BET integration 2.0
        if ($account->control_balance >= $bet) {
            $dlft = $bet;
            foreach ($balances as $key => $balance) {
                if ($dlft > 0 && $balance > 0) {
                    if ($balance >= $dlft) {
                        $ddct = bcsub($balance, $dlft, 2);
                        $balances[$key] = $ddct;
                        $this->saveTransaction($uid, $order_number, "Game Lose", $description, $key, $before_balance, $dlft, $new_balance, 11);
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = bcsub($dlft, $balance, 2);
                        $this->saveTransaction($uid, $order_number, "Game Lose", $description, $key, $before_balance, $balance, $new_balance, 11);
                    }
                }
            }

            $balances['control_balance'] = $account->control_balance - $bet;
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                if ($this->deductRollOver($bet, $uid)) {
                    $this->agentCommission($uid, $bet, $game_id,$game_provider, $order_number);
                    $this->checkRebate($uid, $game_id, $game_provider, $bet);
                    $this->betCheckPromo($uid, $bet, $game_id,$game_provider);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function hideFunds($uid, $amount) {
        $HistoryBalance = new HistoryBalance();
        $account = $this->getAccount($uid);

        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        //BET integration 2.0
        if ($account->control_balance >= $amount) {
            $dlft = $amount;
            foreach ($balances as $key => $balance) {
                if ($dlft > 0) {
                    if ($balance >= $dlft) {
                        $ddct = bcsub($balance, $dlft, 2);
                        $balances[$key] = $ddct;
                        $HistoryBalance->create($dlft, 11, $uid, 0, $key, 0);
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = bcsub($dlft, $balance, 2);
                        $HistoryBalance->create($balance, 11, $uid, 0, $key, 0);
                    }
                }
            }

            $balances['control_balance'] = $account->control_balance - $amount;
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addFunds($winnings, $uid, $game_id, $game_provider, $order_number) {
        $account = $this->getAccount($uid);
        $win_balance = bcadd($account->win_balance, $winnings, 2);

        $before_balance = $account->control_balance;
        $new_balance = bcadd($account->control_balance, $winnings, 2);
        $description = "Transfer to main platform, amount: $winnings, balance before transfer: $before_balance, balance after transfer: $new_balance";

        $this->saveTransaction($uid, $order_number, "Game Win", $description, "win_balance", $before_balance, $winnings, $new_balance, 10);

        $this->winCheckPromo($uid, $winnings, $game_id, $game_provider);

        $account->update([
            'win_balance' => $win_balance,
            'control_balance' => $new_balance,
            'updated_at' => now()
        ]);

        return true;
    }

    public function addDiscountBalance($amount, $uid) {
        $account = $this->getAccount($uid);
        $account->discount_balance = bcadd($account->discount_balance, $amount, 2);
        $account->updated_at = now();

        if ($account->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addAgencyBalance($amount, $uid) {
        $account = $this->getAccount($uid);
        $account->agency_balance = bcadd($account->agency_balance, $amount, 4);
        $account->updated_at = now();
        if ($account->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function isEnough($amount, $uid) {
        return $this->getAccount($uid)->control_balance >= $amount ? true : false;
    }

    public function deductControlBalance($amount, $uid) {

    }

    public function updateDiscountBalance($uid, $new_balance, $rollover_balance) {
        $account = $this->getAccount($uid);

        if ($account->update(['discount_balance' => $new_balance, 'rollover_balance' => $rollover_balance])) {

            $control_balance = bcadd($account->deposit_balance, $account->win_balance);
            $control_balance = bcadd($control_balance, $account->discount_balance);

            if ($account->update(['control_balance' => $control_balance, 'updated_at' => now()])) {

                return true;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }

    public function updateAgencyBalance($uid, $frozen_balance, $new_balance) {
        $account = $this->getAccount($uid);

        if ($account->update([
            'frozen_agency_balance' => $frozen_balance,
            'agency_balance' => $new_balance,
            'updated_at' => now()
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public function deductAgencyBalance($uid, $new_balance) {
        $account = $this->getAccount($uid);

        if ($account->update([
            'agency_balance' => $new_balance,
            'updated_at' => now()
        ])) {
            return true;
        } else {
            return false;
        }
    }

    public function computeControlBalance($uid) {
        $account = $this->getAccount($uid);

        if (number_format($account->deposit_balance, 0) == 0 && number_format($account->win_balance, 0) == 0 && number_format($account->discount_balance, 0) == 0 && $account->control_balance > 0) {
            $account->deposit_balance = $account->control_balance;
            if ($account->save()) {
                return $account->control_balance;
            } else {
                return false;
            }
        } else {

            $control_balance = bcadd($account->deposit_balance, $account->win_balance, 4);
            $control_balance = bcadd($control_balance, $account->discount_balance, 4);

            if ($account->update([
                'control_balance' => $control_balance,
                'updated_at' => now()
            ])) {
                return round($control_balance, 2);
            } else {
                return false;
            }
        }
    }

    public function NewBalance($data){

        $account = $this->getAccount($data['uid']);
        $amount = $data['amount'];
        
        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        if ($account->control_balance >= $amount) {
            $dlft = $amount;
            foreach ($balances as $key => $balance) {
                if ($dlft > 0) {
                    if ($balance >= $dlft) {
                        $ddct = bcsub($balance, $dlft, 2);
                        $balances[$key] = $ddct;
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = bcsub($dlft, $balance, 2);
                    }
                }
            }

            $balances['control_balance'] = $account->control_balance - $amount;
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function updateBalance($id,$discount) {

        $account = $this->getAccount($id);

        if ($account->update([
            'discount_balance' => bcadd($account->discount_balance, $discount, 4), 
            'updated_at' => now()
        ])) {
            return true;
        } else {
            return false;
        }

    }

    public function getUpdatedAt() {
        $dateString = $this->updated_at;
        $carbonDate = Carbon::parse($dateString);
        $unixMilliseconds = $carbonDate->timestamp * 1000 + $carbonDate->millisecond;

        return $unixMilliseconds;
    }

    public function updateRollOver($amount, $uid) {
        $WithdrawalManagement = new DepositAndWithdrawalConfig();
        $rollOverMulti = $WithdrawalManagement->getWithdrawalManagement()->rollover_multiplier;
        $account = $this->getAccount($uid);

        $new_rollover = bcmul($rollOverMulti, $amount, 2);
        $account->rollover_balance = bcadd($account->rollover_balance, $new_rollover, 2);
        $account->updated_at = now();

        if ($account->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function deductRollOver($amount, $uid) {
        $account = $this->getAccount($uid);
        $control_balance = $this->computeControlBalance($uid);

        if ($control_balance == 0 && $account->safety_balance == 0) {
            $account->rollover_balance = 0;
        } else {
            if ($amount <= $account->rollover_balance) {
                $account->rollover_balance = bcsub($account->rollover_balance, $amount, 2);
            } else {
                $account->rollover_balance = 0;
            }
        }

        $account->updated_at = now();
        if ($account->save()) {
            return true;
        } else {
            return false;
        }
    }

    private function getAccount($uid) {
        return $this->where('uid', $uid)->first();
    }

    private function getUser($uid) {
        return User::where('uid', $uid)->first();
    }

    public function agentCommission($uid, $bet, $game_id, $provider, $order_number) {
        $User_Referral = new User_Referral();
        $RebateSettings = new RebateSettings();

        $directAgent = $User_Referral->directAgent($uid);
        if ($directAgent) {
            $bets = GameHistory::where('uid', $uid)
                ->sum('bet');

            if ($bets >= RebateConfig::first()->amount_to_reach) {
                foreach ($User_Referral->getAgents($uid) as $agent) {
                    if ($agent['uid'] != null) {
                        if ($settings = $RebateSettings->checkGame(GameList::where('game_id', $game_id)->where('game_provider', $provider)->first(), $agent['level'])) {
                            if ($settings->display == 1) {
                                $response['settings'][] = $settings;
                                $response['level'][] = $agent['level'];
                                $amount = $bet * $settings->proportion;
                                if ($RebateSettings->payAgent($game_id, $provider, $agent['uid'], $agent['level'], $amount, $order_number)) {
                                    $response[] = "Agent level " . $agent['level'] . " received a rebate";
                                } else $response[] = "Unable to pay agent level " . $agent['level'];
                            }
                        } else $response[] = "No rebate available for agent level " . $agent['level'];
                    } else $response[] = "No agent level " . $agent['level'];
                }
            } else $response[] = "Not enough bets";
        } else $response[] = "No agent";

        return $response;
    }

    public function checkRebate($uid, $game_id, $game_provider, $bet) {
        $GameRebates = new GameRebates();
        $member_level_id = MemberLevel::where('level', WalletController::UserLevel($uid)['level'])->first()->id;
        
        return $GameRebates->payRebate($uid, $game_id, $game_provider, $member_level_id, $bet);
    }

    public function betCheckPromo($uid, $bet, $game_id, $game_provider) {
        $Game = GameList::where('game_id', $game_id)
            ->where('game_provider', $game_provider)
            ->first();
        
        if ($Game) {
            date_default_timezone_set('America/Sao_Paulo');
            $now = now()->format('Y-m-d H:i:s');
            $settings = PromoSettings::where('game_type', $Game->game_category_id)
            ->where('game_platform', $Game->game_provider)
            ->where('benefits_subtype', 15)
            ->where('event_start_time', '<=', $now)
            ->where('event_end_time', '>=', $now)
            ->where('game', $game_id)
            ->where('apply', 'Yes')
            ->first();

            if ($settings) {
                if (!$settings->isBlacklisted($uid)) {
                    foreach ($settings->rules() as $rule) {
                        if ($rule->validate($bet, $uid)) {
                            if ($settings->validate($uid)) {
                                $PromotionDiscount = new PromotionDiscount();
            
                                $before_balance = $this->getBalance($uid)->control_balance;
                                
                                if ($settings->amount_calculation_method == 1) {
                                    $discount = $bet * $rule->discount_amount_value;
                                } else $discount = $rule->discount_amount_value;
            
                                $this->addDiscountBalance($discount, $uid);
                                if ($PromotionDiscount->addPromoDiscount($uid, $game_id, $game_provider, $settings, $discount, $before_balance, $before_balance + $discount)) {
                                    $this->saveTransaction($uid, $this->generateOrderNumber(), "User Received Rebate", "User Receveid a Rebate", 3, $before_balance, $discount, $before_balance + $discount, 55);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function winCheckPromo($uid, $bet, $game_id, $game_provider) {
        $Game = GameList::where('game_id', $game_id)
            ->where('game_provider', $game_provider)
            ->first();

        if ($Game) {
            $now = now();
            $settings = PromoSettings::where('game_type', $Game->game_category_id)
            ->where('game_platform', $Game->game_provider)
            ->where('benefits_subtype', 14)
            ->where('event_start_time', '<=', $now)
            ->where('event_end_time', '>=', $now)
            ->where('apply', 'Yes')
            ->first();

            if ($settings) {
                if (!$settings->isBlacklisted($uid)) {
                    foreach ($settings->rules() as $rule) {
                        if ($rule->validate($bet, $uid)) {
                            if ($settings->validate($uid)) {
                                $PromotionDiscount = new PromotionDiscount();
            
                                $before_balance = $this->getBalance($uid)->control_balance;
                                $discount = $rule->discount_amount_value;
            
                                $this->addDiscountBalance($discount, $uid);
                                if ($PromotionDiscount->addPromoDiscount($uid, $game_id, $game_provider, $settings, $discount, $before_balance, $before_balance + $discount)) {
                                    $this->saveTransaction($uid, $this->generateOrderNumber(), "User Received Rebate", "User Receveid a Rebate", 3, $before_balance, $discount, $before_balance + $discount, 55);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function saveTransaction($uid, $order_id, $transaction_type, $description, $balance_type, $before_balance, $amount, $new_balance, $action_id) {
        $balance_type_id = BalanceTypes::getBalanceID($balance_type);

        $Transactions = new Transactions();

        $Transactions->uid = $uid;
        $Transactions->transaction_id = $Transactions->generateTransactionId();
        $Transactions->order_id = $order_id;
        $Transactions->transaction_type = $transaction_type;
        $Transactions->transaction_description = $description;
        $Transactions->account_number = '';
        $Transactions->date_transacted = now();
        $Transactions->before_balance = $before_balance;
        $Transactions->amount = $amount;
        $Transactions->new_balance = $new_balance;
        $Transactions->balance_type_id = $balance_type_id;
        $Transactions->withdraw_fee = '';
        $Transactions->new_amount = '';
        $Transactions->action_id = $action_id;
        $Transactions->operator_uid = '';

        return $Transactions->save();
    }

    private function generateOrderNumber() {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9);
    }

    //Slotegrator

    public function SlotegratorDeductFunds($bet, $uid, $game_id, $game_provider, $game_history_id, $order_number, $transaction_id) {
        $account = $this->getAccount($uid);

        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        $before_balance = $account->control_balance;
        $new_balance = $this->ComputeAmount($before_balance, $bet, "bet");
        $description = "Transfer from main platform, amount: $bet, balance before transfer: $before_balance, balance after transfer: $new_balance";

        if ($account->control_balance >= $bet) {
            $compute_balance = $bet;
            $dlft = $bet;
            foreach ($balances as $key => $balance) {
                if ($dlft >= 0 && $balance >= 0) {
                    if ($balance >= $dlft) {
                        $ddct = $this->ComputeAmount($balance, $dlft, "bet");
                        $balances[$key] = $ddct;
                        $this->SlotegratorSaveTransaction($uid, $order_number, $description, $key, $balance, $dlft, $balances[$key], 11, $transaction_id);
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = $this->ComputeAmount($dlft, $balance, "bet");
                        $this->SlotegratorSaveTransaction($uid, $order_number, $description, $key, $balance, $balance, $balances[$key], 11, $transaction_id);
                    }
                    
                }

            }

            $compute_balance = $this->ComputeAmount($account->control_balance, $bet, "bet");
            $balances['control_balance'] = $compute_balance;
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                if ($this->deductRollOver($bet, $uid)) {
                    $this->agentCommission($uid, $bet, $game_id,$game_provider, $order_number);
                    $this->checkRebate($uid, $game_id, $game_provider, $bet);
                    $this->betCheckPromo($uid, $bet, $game_id,$game_provider);
                    return $compute_balance;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
    
    public function WinSlotegrator($winnings, $uid, $game_id, $game_provider, $order_number, $transaction_id) {

        $account = $this->getAccount($uid);
        $win_balance = $this->ComputeAmount($account->win_balance, $winnings, "win");
        $before_balance = $account->control_balance;
        $new_balance = $this->ComputeAmount($account->control_balance, $winnings, "win");
        $description = "Transfer to main platform, amount: $winnings, balance before transfer: $before_balance, balance after transfer: $new_balance";

        $this->SlotegratorSaveTransaction($uid, $order_number, $description, "win_balance", $account->win_balance, $winnings, $win_balance, 10, $transaction_id);

        $this->winCheckPromo($uid, $winnings, $game_id, $game_provider);

        $account->update([
            'win_balance' => $win_balance,
            'control_balance' => $new_balance,
            'updated_at' => now()
        ]);

        return $new_balance;
    }

    public function RefundSlotegrator($amount, $uid, $order_number, $transaction_id) {

        $account = $this->getAccount($uid);
        $refund_balance = $this->ComputeAmount($account->win_balance, $amount, "refund");
        $before_balance = $account->control_balance;
        $new_balance = $this->ComputeAmount($before_balance, $amount, "refund");

        $description = "Transfer Refund to main platform, amount: $amount, balance before transfer: $before_balance, balance after transfer: $new_balance";

        $this->SltoegratorUpdateTransaction($uid, $order_number, $description, $account->win_balance, $amount, $refund_balance, $transaction_id);

        $account->update([
            'win_balance' => $refund_balance,
            'control_balance' => $new_balance,
            'updated_at' => now()
        ]);

        return $new_balance;

    }

    public function BetRollbackSlotegrator($amount, $uid, $order_number, $transaction_id) {

        $account = $this->getAccount($uid);
        $refund_balance = $this->ComputeAmount($account->win_balance, $amount, "win");
        $before_balance = $account->control_balance;
        $new_balance = $this->ComputeAmount($before_balance, $amount, "win");

        $description = "Transfer Rollback to main platform, amount: $amount, balance before transfer: $before_balance, balance after transfer: $new_balance";

        $this->SltoegratorUpdateTransaction($uid, $order_number, $description, $account->win_balance, $amount, $refund_balance, $transaction_id);

       
        if ( $account->update([
            'win_balance' => $refund_balance,
            'control_balance' => $new_balance,
            'updated_at' => now()
        ])) {
            return true;
        }else {
            return false;
        }

    }
    
    public function WinRollbackSlotegrator($bet, $uid, $game_id, $game_provider, $order_number, $transaction_id) {
        $account = $this->getAccount($uid);

        $balances = [
            "deposit_balance" => $account->deposit_balance,
            "win_balance" => $account->win_balance,
            "discount_balance" => $account->discount_balance
        ];

        $before_balance = $account->control_balance;
        $new_balance = $this->ComputeAmount($before_balance, $bet, "bet");
        $description = "Transfer from main platform, amount: $bet, balance before transfer: $before_balance, balance after transfer: $new_balance";

        if ($account->control_balance >= $bet) {
            $compute_balance = $bet;
            $dlft = $bet;
            foreach ($balances as $key => $balance) {
                if ($dlft >= 0 && $balance >= 0) {
                    if ($balance >= $dlft) {
                        $ddct = $this->ComputeAmount($balance, $dlft, "bet");
                        $balances[$key] = $ddct;
                        $this->SlotegratorSaveTransaction($uid, $order_number, $description, $key, $balance, $dlft, $balances[$key], 11, $transaction_id);
                        $dlft = 0;
                    } else {
                        $ddct = 0;
                        $balances[$key] = $ddct;
                        $dlft = $this->ComputeAmount($dlft, $balance, "bet");
                        $this->SlotegratorSaveTransaction($uid, $order_number, $description, $key, $balance, $balance, $balances[$key], 11, $transaction_id);
                    }
                    
                }

            }

            $compute_balance = $this->ComputeAmount($account->control_balance, $bet, "bet");
            $balances['control_balance'] = $compute_balance;
            $balances['updated_at'] = now();

            if ($account->update($balances)) {
                if ($this->deductRollOver($bet, $uid)) {
                    $this->agentCommission($uid, $bet, $game_id,$game_provider, $order_number);
                    $this->checkRebate($uid, $game_id, $game_provider, $bet);
                    $this->betCheckPromo($uid, $bet, $game_id,$game_provider);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function ErrorInternalSlotegrator($uid, $order_number, $transaction_id) {

        $account = $this->getAccount($uid);
        $before_balance = $account->control_balance;

        $description = "Not enough money to continue playing";

        $this->SlotegratorSaveErrorTransaction($uid, $order_number, $description, $before_balance, 53, $transaction_id);

        return true;

    }

    private function SlotegratorSaveTransaction($uid, $order_id, $description, $balance_type, $before_balance, $amount, $new_balance, $action_id, $transaction_id) {
        
        $balance_type_id = BalanceTypes::getBalanceID($balance_type);

        $Transactions = new Transactions();

        $Transactions->uid = $uid;
        $Transactions->transaction_id = $transaction_id;
        $Transactions->order_id = $order_id;
        $Transactions->transaction_type = '';
        $Transactions->transaction_description = $description;
        $Transactions->account_number = '';
        $Transactions->date_transacted = now();
        $Transactions->before_balance = $before_balance;
        $Transactions->amount = $amount;
        $Transactions->new_balance = $new_balance;
        $Transactions->balance_type_id = $balance_type_id;
        $Transactions->withdraw_fee = '';
        $Transactions->new_amount = '';
        $Transactions->action_id = $action_id;
        $Transactions->operator_uid = '';

        return $Transactions->save();

    }

    private function SlotegratorSaveErrorTransaction($uid, $order_id, $description, $before_balance, $action_id, $transaction_id) {
        

        $Transactions = new Transactions();

        $Transactions->uid = $uid;
        $Transactions->transaction_id = $transaction_id;
        $Transactions->order_id = $order_id;
        $Transactions->transaction_type = '';
        $Transactions->transaction_description = $description;
        $Transactions->account_number = '';
        $Transactions->date_transacted = now();
        $Transactions->before_balance = $before_balance;
        $Transactions->amount = 0;
        $Transactions->new_balance = $before_balance;
        $Transactions->withdraw_fee = '';
        $Transactions->new_amount = '';
        $Transactions->action_id = $action_id;
        $Transactions->operator_uid = '';

        return $Transactions->save();

    }

    private function SltoegratorUpdateTransaction($uid, $order_id, $description, $before_balance, $amount, $new_balance, $transaction_id){

        $Transactions = new Transactions();

        $query = $Transactions
        ->where('uid', $uid)
        ->where('order_id', $order_id)
        ->update([
        'transaction_id' => $transaction_id,
        'transaction_description' => $description,
        'date_transacted' => now(),
        'before_balance' => $before_balance,
        'amount' => $amount,
        'new_balance' => $new_balance,
        'action_id' => 52]);

        return $query;

    }

    //End of Slotegrator

    public function getUserBalance($uid){

        $query = $this->where('uid', $uid)->first();
        
        if ($query == null) {
            
            return null;
            
        }else {
            
            return $query['control_balance'];
            
        }

    }
    
    private function ComputeAmount($balance, $amount, $action){

        if ($action == 'bet') {
            return  bcsub(floatval($balance), floatval($amount), 4);
        }elseif ($action == 'win') {
            return bcadd(floatval($balance), floatval($amount), 4);
        }elseif ($action == "refund") {
            return bcadd(floatval($balance), floatval($amount), 4);
        }

        // if (is_int($amount) || $amount == 0) {

        //     $ParseString = strval($balance);
        //     $DecimalPoint = strpos($ParseString, '.');
        //     $length = strlen(substr($ParseString, $DecimalPoint + 1));
            
        //     if ($action == 'bet') {
        //         return  bcsub(floatval($balance), floatval($amount), $length);
        //     }elseif ($action == 'win') {
        //         return bcadd(floatval($balance), floatval($amount), $length);
        //     }elseif ($action == "refund") {
        //         return bcadd(floatval($balance), floatval($amount), $length);
        //     }

        // }else {

        //     $ParseString = strval($amount);
        //     $DecimalPoint = strpos($ParseString, '.');
        //     $length = strlen(substr($ParseString, $DecimalPoint + 1));
    
        //     if ($action == 'bet') {
        //         return  bcsub(floatval($balance), floatval($amount), $length);
        //     }elseif ($action == 'win') {
        //         return bcadd(floatval($balance), floatval($amount), $length);
        //     }elseif ($action == "refund") {
        //         return bcadd(floatval($balance), floatval($amount), $length);
        //     }

        // }

    }

}
