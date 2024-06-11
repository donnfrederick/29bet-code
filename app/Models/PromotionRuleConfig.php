<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionRuleConfig extends Model
{
    use HasFactory;
    protected $connection = 'db29betadmin';
    protected $table = 'promo_rule_config';
    public $timestamps = false;
    protected $fillable = [
        'promo_rule_id',
        'promotion_id',
        'condition_field',
        'calculation_way_id',
        'promo_code_id',
        'member_level_id',
        'calculation_result',
        'calculation_result_timeinterval',
        'discount_amount_value',
        'date_created',
        'range_from',
        'range_to',
        'no_of_days'
    ];

    public function getPromorecharge(){

        $query = $this->select()
        ->leftJoin('promotion_settings', 'promo_rule_config.promotion_id', '=', 'promotion_settings.promo_code_id')
        // ->leftJoin('type_of_benefits', 'promotion_settings.type_of_benefits', '=', 'type_of_benefits.id')
        ->leftJoin('benefits_subtype', 'promotion_settings.benefits_subtype', '=', 'benefits_subtype.id')
        ->where('promotion_settings.type_of_benefits', 1)
        ->orderBy('benefits_subtype')
        ->get();

        return $query;
        
    }



}
