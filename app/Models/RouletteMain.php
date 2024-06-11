<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouletteMain extends Model
{
    public $timestamps = false;

    /**
     * The database connection
     *
     * @var string
     */


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roulette_main';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['roulette_config_id', 'prize_code', 'probabilty_rate', 'sorting', 'status', 'date_created'];

    public function RoulettePrizeCodes() {
        return $this->hasOne(RoulettePrizeCodes::class, 'prize_code', 'prize_code');
    }

    public function RouletteConfigurations() {
        return $this->belongsTo(RouletteConfigurations::class);
    }
}