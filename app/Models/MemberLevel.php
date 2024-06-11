<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberLevel extends Model
{
    protected $primaryKey = 'level';

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_levels_params';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level_name', 'level', 'total_deposits', 'total_bets', 'max_withdraw_amount', 'max_withdraw_amount_period_cover', 'withdrawal_rate', 'monthly_free_withdrawal', 'betting_cashback_ratio', 'remark', 'vip_level_badge', 'vip_level_badge_path', 'date_created'];
}
