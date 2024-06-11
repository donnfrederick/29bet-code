<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PromoCode;
use App\Models\PromotionRuleConfig;
use App\Models\TypeOfBenefits;
use App\Models\ConditionField;
use Auth;


class PromotionSettings extends Model
{
    use HasFactory;
    protected $connection = 'db29betadmin';
    protected $table = 'promotion_settings';
    public $timestamps = false;
    protected $fillable = [
        'event_cycle',
        'type_of_benefits',
        'name',
        'amount_calculation_method',
        'single_max_discount',
        'withdrawal_code_multiplier',
        'apply',
        'automatically_approved',
        'enable',
        'event_start_time',
        'event_date_time'
    ];

    // public function getPromorecharge(){

    //     $query = $this->select()
    //     ->leftJoin('promo_rule_config', 'promotion_settings.promo_code_id', '=', 'promo_rule_config.promotion_id')
    //     ->where('promotion_settings.type_of_benefits', 1)
    //     ->get()
    //     ->toArray();

    //     return $query;
    // }

    public function getPromoSettings($promo_code_id){

        $query = $this->select('discount_amount_value', 'calculation_result', 'amount_calculation_method')
        ->leftJoin('promo_rule_config', 'promo_rule_config.promotion_id', '=', 'promotion_settings.promo_code_id')
        ->where('promotion_settings.promo_code_id', $promo_code_id)
        ->get()
        ->toArray();

        return $query;

    }

    public function getAmountCalculationMethod($promo_code_id){

        $query = $this->select('amount_calculation_method')
        ->where('promo_code_id', $promo_code_id)
        ->first();

        return $query;

    }

}
