<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelBonusAchievement extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'level_vip_bonus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discount_amount',
        'level_requirement'
    ];

    public function getDetailslevel_vip_bonus($id) {

        return LevelBonusAchievement::where('level_requirement','=',$id)->first();
    }
}
