<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoulettePrizeCodes extends Model
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
    protected $table = 'roulette_prize_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prize_name', 'prize_amount', 'prize_code'];
    
    public function RouletteMain() {
        return $this->belongsTo(RouletteMain::class);
    }
}