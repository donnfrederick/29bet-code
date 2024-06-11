<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromoCode extends Model
{
    use HasFactory;

    protected $connection = 'db29betadmin';

    public $timestamps = false;

    protected $table = 'promo_rule_config';

    protected $fillable = [
        'promo_rule_id',
        'promotion_id',
        'condition_field_id',
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

    public function getPromoDetails($uid, $promo_code, $promo_rule_id){
        
        DB::statement('SET sql_mode=(SELECT REPLACE(@@sql_mode, "ONLY_FULL_GROUP_BY", ""))');

        $query = DB::table('db29betadmin.promo_rule_config')->select()
        ->leftJoin('db29betadmin.promo_code', 'promo_rule_config.promo_rule_id', '=', 'promo_code.promo_rule_id')
        ->where('promo_code.agent', $uid)
        ->where('promo_code.promo_code', $promo_code)
        ->where('promo_rule_config.promo_rule_id', $promo_rule_id)
        ->whereNotIn('promo_rule_config.condition_field_id', [13])
        ->groupBy('promo_rule_config.promo_rule_id')
        ->orderByDesc('promo_code.date_created')
        ->first();
  
        return $query;

    }

    public function getAllPromo($uid){
        
        DB::statement('SET sql_mode=(SELECT REPLACE(@@sql_mode, "ONLY_FULL_GROUP_BY", ""))');

        $query = DB::table('db29betadmin.promo_rule_config')->select()
        ->leftJoin('db29betadmin.promo_code', 'promo_rule_config.promo_rule_id', '=', 'promo_code.promo_rule_id')
        ->where('promo_code.agent', $uid)
        ->where('promo_code.status', '<' , 1)
        ->where('promo_code.available_times_to_claim', '>' , 0)
        ->where(function ($query){
            $query->where('promo_code.available_times_to_claim', '>=', DB::raw('(SELECT times_received FROM db29betadmin.promo_code AS pc Where promo_code.promo_code = pc.promo_code)'));
        })
        ->groupBy('promo_rule_config.promo_rule_id')
        ->orderByDesc('promo_code.date_created')
        ->get();

        return $query;

    }

    public function checkPromo($uid, $promo_code, $promo_rule_id){

        $query = DB::table('db29betadmin.promo_code')->select()
        ->leftJoin('db29betadmin.promo_rule_config', 'promo_code.promo_rule_id', '=', 'promo_rule_config.promo_rule_id')
        ->where('promo_code.agent', $uid)
        ->where('promo_code.promo_code', $promo_code)
        ->where('promo_rule_config.promo_rule_id', $promo_rule_id)
        ->get()
        ->count();

        return $query;

    }

    public function DetailsPromoCode($uid, $promo_code){
        
        $query = DB::table('db29betadmin.promo_code')->select()
        ->where('promo_code.agent', $uid)
        ->where('promo_code.promo_code', $promo_code)
        ->first();
  
        return $query;

    }
    
    public function updateStatus($data){

        $query = DB::table('db29betadmin.promo_code')
        ->where('promo_code', $data['promo_code'])
        ->where('agent', $data['uid'])
        ->update([
            'status' => $data['status'], 
            'times_received' => $data['times_received']
        ]);

        if ($query) 
        {
            return true;

        } else {

            return false;

        }

    }

    public function getPromoCodeAndSettings($promo_code){

        $query = DB::table('db29betadmin.promo_code')
        ->leftJoin('db29betadmin.promotion_settings', 'promo_code.promotion_id', '=', 'promotion_settings.promo_code_id')
        ->where('promo_code.promo_code', $promo_code)
        ->first();

        return $query;
        
    }

}
