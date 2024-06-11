<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionDiscount extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotion_discount';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'transaction_id',
        'order_id',
        'game_id',
        'game_provider',
        'promo_code_id',
        'promotion_name',
        'promo_code',
        'event_start',
        'event_end',
        'before_balance',
        'amount',
        'new_amount',
        'balance_type_id',
        'description',
        'for_user_remarks',
        'admin_remarks',
        'system_remarks',
        'action_id',
        'transaction_type',
        'operator_uid',
        'claim_ip',
        'created_at',
        'updated_at'
    ];

    public function savePromotionDiscount($request) {

        $PromotionDiscount = new PromotionDiscount();
        $PromotionDiscount->uid = $request['uid'];
        $PromotionDiscount->transaction_id = $request['transaction_id'];
        $PromotionDiscount->order_id = date('YmdU');
        $PromotionDiscount->game_id = $request['game_id'];
        $PromotionDiscount->game_provider = $request['game_provider'];
        $PromotionDiscount->agent_level = $request['agent_level'];
        $PromotionDiscount->promo_code_id = $request['promo_code_id'];
        $PromotionDiscount->promotion_name = $request['promotion_name'];
        $PromotionDiscount->event_start = $request['event_start'];
        $PromotionDiscount->event_end = $request['event_end'];
        $PromotionDiscount->before_balance = $request['before_balance'];
        $PromotionDiscount->amount = $request['amount'];
        $PromotionDiscount->new_amount = $request['new_amount'];
        $PromotionDiscount->balance_type_id = $request['balance_type_id'];
        $PromotionDiscount->description = $request['description'];
        $PromotionDiscount->for_user_remarks = $request['for_user_remarks'];
        $PromotionDiscount->admin_remarks = $request['admin_remarks'];
        $PromotionDiscount->system_remarks = $request['system_remarks'];
        $PromotionDiscount->action_id = $request['action_id'];
        $PromotionDiscount->transaction_type = $request['transaction_type'];
        $PromotionDiscount->operator_uid = $request['operator_uid'];
        $PromotionDiscount->claim_ip = $request['claim_ip'];
        $PromotionDiscount->created_at = now();

        if ($PromotionDiscount->save()) return true;
        else return false;

    }
    
    public function addPromoDiscount($uid, $game_id, $game_provider, $promo, $discount, $before_balance, $new_amount) {
        $User = User::find($uid);

        $PromotionDiscount = new PromotionDiscount();
        $PromotionDiscount->uid = $uid;
        $PromotionDiscount->transaction_id = "";
        $PromotionDiscount->order_id = date('YmdU');
        $PromotionDiscount->game_id = $game_id;
        $PromotionDiscount->game_provider = $game_provider;
        $PromotionDiscount->promo_code_id = $promo->promo_code_id;
        $PromotionDiscount->promotion_name = $promo->name;
        $PromotionDiscount->event_start = $promo->event_start_time;
        $PromotionDiscount->event_end = $promo->event_end_time;
        $PromotionDiscount->before_balance = $before_balance;
        $PromotionDiscount->amount = $discount;
        $PromotionDiscount->new_amount = $new_amount;
        $PromotionDiscount->for_user_remarks = "";
        $PromotionDiscount->admin_remarks = "";
        $PromotionDiscount->system_remarks = "";
        $PromotionDiscount->action_id = 48;
        $PromotionDiscount->transaction_type = "User Received Rebate";
        $PromotionDiscount->operator_uid = "";
        $PromotionDiscount->claim_ip = $User->registration_ip;
        $PromotionDiscount->created_at = now();

        if ($PromotionDiscount->save()) return true;
        else return false;
    }
    
    public function CommissionTable($uid, $action_id, $date){

        $query = $this->select()
        ->where('uid', $uid)
        ->whereIn('action_id', $action_id);
        
        switch ($date){

            case '1':
                $query->whereBetween('created_at', [now()->subDays(7), now()]);
                break;
            case '2':
                $query->whereDate('created_at', now());
                break;
            case '3':
                $query->whereDate('created_at', now()->subDays(1));
                break;
            case '4':
                $query->whereMonth('created_at', now()->month);
                break;
            case '5':
                $query->whereYear('created_at', now()->year);
                break;

        }

        $query->orderBy('created_at', 'desc')->get();

        return $query;

    }

    public function checkAgencyReferralReward($uid, $id){

        $query = $this->where('uid', $uid)
        ->where('promo_code_id', 'AgencyReferral-'.$id)
        ->count('*');

        return $query;

    }
    
}