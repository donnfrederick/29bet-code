<?php

namespace App\Models\Admin;

use App\Models\ControlBalance;
use App\Models\Transactions;
use App\Models\ActionType;
use App\Models\PromotionDiscount;
use Illuminate\Database\Eloquent\Model;

class RebateSettings extends Model
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
    protected $table = 'rebate_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'every_ten_thousand_rebates', 'proportion', 'rebate_type_id', 'display', 'date_set', 'agent_level'];

    public function checkGame($game, $agent_level) {
        $RebateType = new RebateType();
        $settings = null;

        foreach ($this::where('agent_level', $agent_level)->get() as $setting) {
            if ($RebateType->checkType($setting->rebate_type_id, $game->game_category_id) && $settings == null) {
                $settings = $setting;
            }
        }

        return $settings;
    }

    public function payAgent($game_id, $game_provider, $agent_uid, $agent_level, $amount, $order_number) {
        $Transactions = new Transactions();
        $PromotionDiscount = new PromotionDiscount();
        
        if (Transactions::where('uid', '=', $agent_uid)->whereIn('action_id', [7, 26])->get()->isNotEmpty()) {
            $ControlBalance = new ControlBalance();
            $action_type = new ActionType();
            $action_description = $action_type->getActionDescription(44);

            $before_balance = $ControlBalance->where('uid', $agent_uid)->first()->agency_balance;

            // $ControlBalance->getBalance($agent_uid)->control_balance;
            $ControlBalance->addAgencyBalance($amount, $agent_uid);

            // CONTINUE LATER - SAVING IN PROMOTION_DISCOUNT

            $remark = "Agent level " . $agent_level . " received a rebate";

            $PromotionDiscount->uid = $agent_uid;
            $PromotionDiscount->transaction_id = $Transactions->generateTransactionId();
            $PromotionDiscount->order_id = $order_number;
            $PromotionDiscount->game_id = $game_id;
            $PromotionDiscount->game_provider = $game_provider;
            $PromotionDiscount->agent_level = $agent_level;
            $PromotionDiscount->promo_code_id = '';
            $PromotionDiscount->promotion_name = '';
            $PromotionDiscount->promo_code = '';
            $PromotionDiscount->event_start = null;
            $PromotionDiscount->event_end = null;
            $PromotionDiscount->before_balance = $before_balance;
            $PromotionDiscount->amount = $amount;
            $PromotionDiscount->new_amount = $before_balance + $amount;
            $PromotionDiscount->balance_type_id = 7;
            $PromotionDiscount->description = $remark;
            $PromotionDiscount->for_user_remarks = $action_description;
            $PromotionDiscount->admin_remarks = '';
            $PromotionDiscount->system_remarks = '';
            $PromotionDiscount->action_id = 44;
            $PromotionDiscount->transaction_type = $action_description;
            $PromotionDiscount->operator_uid = '';
            $PromotionDiscount->claim_ip = '';
            $PromotionDiscount->created_at = now();
            $PromotionDiscount->updated_at = now();


            // $Transactions->uid = $agent_uid;
            // $Transactions->transaction_id = $Transactions->generateTransactionId();
            // $Transactions->order_id = $game_id;
            // $Transactions->transaction_type = $action_description;
            // $Transactions->transaction_description = "Agent level " . $agent_level . " received a rebate";
            // $Transactions->date_transacted = now();
            // $Transactions->before_balance = $before_balance;
            // $Transactions->action_id = 44;
            // $Transactions->amount = $amount;
            // $Transactions->new_balance = $ControlBalance->getBalance($agent_uid)->control_balance;
            // $Transactions->admin_remarks = '';
            // $Transactions->system_remarks = '';
            

            if ($PromotionDiscount->save()) return true;
            else return false;
        } else {
            $remark = "Agent level " . $agent_level . " don't have recharge";
            $ControlBalance = new ControlBalance();
            $action_type = new ActionType();
            $action_description = $action_type->getActionDescription(45);

            $before_balance = $ControlBalance->where('uid',$agent_uid)->first()->control_balance;
            
            // $ControlBalance->getBalance($agent_uid)->control_balance;
            $ControlBalance->addAgencyBalance(0, $agent_uid);

            $PromotionDiscount->uid = $agent_uid;
            $PromotionDiscount->transaction_id = $Transactions->generateTransactionId();
            $PromotionDiscount->order_id = $order_number;
            $PromotionDiscount->game_id = $game_id;
            $PromotionDiscount->game_provider = $game_provider;
            $PromotionDiscount->agent_level = $agent_level;
            $PromotionDiscount->promo_code_id = '';
            $PromotionDiscount->promotion_name = '';
            $PromotionDiscount->promo_code = '';
            $PromotionDiscount->event_start = null;
            $PromotionDiscount->event_end = null;
            $PromotionDiscount->before_balance = $before_balance;
            $PromotionDiscount->amount = 0;
            $PromotionDiscount->new_amount = $before_balance;
            $PromotionDiscount->balance_type_id = 3;
            $PromotionDiscount->description = $remark;
            $PromotionDiscount->for_user_remarks = $action_description;
            $PromotionDiscount->admin_remarks = '';
            $PromotionDiscount->system_remarks = '';
            $PromotionDiscount->action_id = 45;
            $PromotionDiscount->transaction_type = $action_description;
            $PromotionDiscount->operator_uid = '';
            $PromotionDiscount->claim_ip = '';
            $PromotionDiscount->created_at = now();
            $PromotionDiscount->updated_at = now();
            
            // $Transactions->uid = $agent_uid;
            // $Transactions->transaction_id = $Transactions->generateTransactionId();
            // $Transactions->order_id = $game_id;
            // $Transactions->transaction_type = $action_description;
            // $Transactions->transaction_description = "Agent level " . $agent_level . " don't have recharge";
            // $Transactions->date_transacted = now();
            // $Transactions->before_balance = $before_balance;
            // $Transactions->action_id = 45;
            // $Transactions->amount = $amount;
            // $Transactions->new_balance = $ControlBalance->getBalance($agent_uid)->control_balance;
            // $Transactions->admin_remarks = '';
            // $Transactions->system_remarks = '';

            if ($PromotionDiscount->save()) return false;
            else return false;
        }
    }
}
