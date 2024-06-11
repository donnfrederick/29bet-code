<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentReferralParams extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agent_referral_params';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'referral_count',
        'reward_value',
    ];


    public function getReferralDetails($id) {
        return AgentReferralParams::where('id','=',$id)->first();
    }
}
