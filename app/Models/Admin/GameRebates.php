<?php

namespace App\Models\Admin;

use App\Models\Admin\GameList;
use App\Models\ControlBalance;
use App\Models\Transactions;
use App\Models\ActionType;
use App\Models\PromotionDiscount;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GameRebates extends Model
{
    /**
     * The database connection
     *
     * @var string
     */
    protected $connection = 'db29betadmin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_rebate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_provider_id','game_category_id', 'member_level_id', 'rebate'];

    public function payRebate($uid, $game_id, $game_provider, $member_level_id, $bet) {
        $Game = GameList::where('game_id', $game_id)
            ->where('game_provider', $game_provider)
            ->get()
            ->first();

        if ($Game) {
            $GameRebate = $this::where('game_provider_id', $Game->game_provider)
                ->where('game_category_id', $Game->game_category_id)
                ->where('member_level_id', $member_level_id);

            if ($GameRebate->first()) {
                $ControlBalance = new ControlBalance();
                $action_type = new ActionType();
                $action_description = $action_type->getActionDescription(48);
                $rebate = $GameRebate->first()->rebate;

                if ($rebate >= 1) {
                    $amount = $bet * ($rebate / 100);
                } else $amount = $bet * $rebate;

                $before_balance = $ControlBalance->getBalance($uid)->control_balance;

                $ControlBalance->addDiscountBalance($amount, $uid);

                $User = User::find($uid);

                $data = [
                    "uid" => $uid,
                    "transaction_id" => $this->generateTransactionId(),
                    "order_id" => $this->generateOrderNumber(),
                    "transaction_type" => $action_description,
                    "transaction_description" => "User has received a rebate",
                    "date_transacted" => now(),
                    "before_balance" => $before_balance,
                    "action_id" => 48,
                    "amount" => $amount,
                    "new_balance" => $before_balance + $amount,
                    "admin_remarks" => '',
                    "system_remarks" => '',
                    "game_id" => $game_id,
                    "game_provider" => $game_provider,
                    "promotion_name" => "Game Rebate",
                    "claim_ip" => $User->registration_ip,
                    "created_at" => now()
                ];

                if ($this->saveTransactionAndPromotion($data)) return true;
                else return false;
            } else return false;
        }
    }

    private function saveTransactionAndPromotion($data) {
        $Transactions = new Transactions();

        $Transactions->uid = $data['uid'];
        $Transactions->transaction_id = 'transaction_id';
        $Transactions->order_id = $data['order_id'];
        $Transactions->transaction_type = $data['transaction_type'];
        $Transactions->transaction_description = $data['transaction_description'];
        $Transactions->date_transacted = $data['date_transacted'];
        $Transactions->before_balance = $data['before_balance'];
        $Transactions->action_id = $data['action_id'];
        $Transactions->amount = $data['amount'];
        $Transactions->new_balance = $data['new_balance'];
        $Transactions->admin_remarks = $data['admin_remarks'];
        $Transactions->system_remarks = $data['system_remarks'];

        if ($Transactions->save()) {
            $PromotionDiscount = new PromotionDiscount();

            $PromotionDiscount->uid = $data['uid'];
            $PromotionDiscount->transaction_id = $data['transaction_id'];
            $PromotionDiscount->order_id = $data['order_id'];
            $PromotionDiscount->game_id = $data['game_id'];
            $PromotionDiscount->game_provider = $data['game_provider'];
            $PromotionDiscount->promotion_name = $data['promotion_name'];
            $PromotionDiscount->before_balance = $data['before_balance'];
            $PromotionDiscount->amount = $data['amount'];
            $PromotionDiscount->new_amount = $data['new_balance'];
            $PromotionDiscount->action_id = $data['action_id'];
            $PromotionDiscount->transaction_type = $data['transaction_type'];
            $PromotionDiscount->claim_ip = $data['claim_ip'];
            $PromotionDiscount->created_at = $data['created_at'];

            if ($PromotionDiscount->save()) return true;
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

    private function generateOrderNumber() {
        return chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(0, 9) . rand(0, 9);
    }
}

?>