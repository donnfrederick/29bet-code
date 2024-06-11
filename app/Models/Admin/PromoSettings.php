<?php

namespace App\Models\Admin;

use App\Models\PromotionDiscount;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PromoSettings extends Model
{
    
    protected $primaryKey = 'promo_code_id';

    protected $keyType = 'string';

    public $timestamps = false;

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
    protected $table = 'promotion_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promo_code_id',
        'event_cycle',
        'type_of_benefits',
        'benefits_subtype',
        'same_ip_claimed_once',
        'name',
        'amount_calculation_method',
        'single_max_discount',
        'withdrawal_code_multiplier',
        'apply',
        'automatically_approved',
        'event_start_time',
        'event_end_time',
        'game_type',
        'game_platform',
        'game',
        'condition_field',
        'customer_number'
    ];

    public function rules() {
        return PromoRuleConfig::where('promotion_id', $this->promo_code_id)->get();
    }

    public function isBlacklisted($uid) {
        return PromoBlacklistedUsers::where('promo_code', $this->promo_code_id)
            ->where('uid', $uid)
            ->first();
    }

    public function getGameTypes() {
        return $this->game_type;
    }

    public function validate($uid) {
        $User = User::find($uid);
        
        if ($this->validateIP($uid, $User->registration_ip)) {
            if ($this->event_cycle == 1) return $this->validateOnce($uid);
            elseif ($this->event_cycle) return true;
            elseif ($this->event_cycle) return $this->validateOnceADay($uid);
            elseif ($this->event_cycle) return $this->validateOnceAWeek($uid);
            elseif ($this->event_cycle) return $this->validateOnceAMonth($uid);
            elseif ($this->event_cycle) return $this->validateCustom($uid);
            else return $this->validateMulti($uid);
        } else return true;
    }

    private function validateIP($uid, $registration_ip) {
        if ($this->same_ip_claimed_once == "Yes") {
            if (PromotionDiscount::where('promo_code_id', $this->promo_code_id)
                ->where('claim_ip', $registration_ip)
                ->where('uid', '!=', $uid)
                ->first()
            ) {
                return false;
            } else return true;
        } else return true;
    }

    private function validateOnce($uid) {
        if (PromotionDiscount::where('uid', $uid)
        ->where('promo_code_id', $this->promo_code_id)
        ->first()) {
            return false;
        } else return true;
    }

    private function validateOnceADay($uid) {
        date_default_timezone_set('America/Sao_Paulo');
        $start_date = date('Y-m-d 00:00:00', strtotime(now()->format('Y-m-d H:i:s')));
        $end_date = date('Y-m-d 23:59:59', strtotime(now()->format('Y-m-d H:i:s')));
        
        if (PromotionDiscount::where('uid', $uid)
        ->where('promo_code_id', $this->promo_code_id)
        ->where('created_at', '>=', $start_date)
        ->where('created_at', '<=', $end_date)
        ->first()) {
            return false;
        } else return true;
    }

    private function validateOnceAWeek($uid) {
        date_default_timezone_set('America/Sao_Paulo');
        $start_date = date('Y-m-d 00:00:00', strtotime('last sunday'));
        $end_date = date('Y-m-d 23:59:59', strtotime('next sat'));
        
        if (PromotionDiscount::where('uid', $uid)
        ->where('promo_code_id', $this->promo_code_id)
        ->where('created_at', '>=', $start_date)
        ->where('created_at', '<=', $end_date)
        ->first()) {
            return false;
        } else return true;
    }

    private function validateOnceAMonth($uid) {
        date_default_timezone_set('America/Sao_Paulo');
        $start_date = date('Y-m-01 00:00:00', strtotime(now()->format('Y-m-d H:i:s')));
        $end_date = date('Y-m-t 23:59:59', strtotime(now()->format('Y-m-d H:i:s')));
        
        if (PromotionDiscount::where('uid', $uid)
        ->where('promo_code_id', $this->promo_code_id)
        ->where('created_at', '>=', $start_date)
        ->where('created_at', '<=', $end_date)
        ->first()) {
            return false;
        } else return true;
    }

    private function validateCustom($uid) {
        date_default_timezone_set('America/Sao_Paulo');
        $days = $this->customer_number;
        $start_date = date('Y-m-d 00:00:00', strtotime($this->event_start_time));
        $end_date = date('Y-m-d 23:59:59', strtotime($this->event_start_time." +$days days"));

        if (PromotionDiscount::where('uid', $uid)
        ->where('promo_code_id', $this->promo_code_id)
        ->where('created_at', '>=', $start_date)
        ->where('created_at', '<=', $end_date)
        ->first()) {
            return false;
        } else return true;
    }

    private function validateMulti($uid) {
        date_default_timezone_set('America/Sao_Paulo');
        $start_date = date('Y-m-d 00:00:00', strtotime(now()->format('Y-m-d H:i:s')));
        $end_date = date('Y-m-d 23:59:59', strtotime(now()->format('Y-m-d H:i:s')));
        
        $count = PromotionDiscount::where('uid', $uid)
            ->where('promo_code_id', $this->promo_code_id)
            ->where('created_at', '>=', $start_date)
            ->where('created_at', '<=', $end_date)
            ->count();

        if ($this->customer_number > $count) {
            return true;
        } else return false;
    }
}
