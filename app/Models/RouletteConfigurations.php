<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouletteConfigurations extends Model
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
    protected $table = 'roulette_configuration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['roulette_config_id', 'roulette_name', 'minimum_amount', 'spin', 'minimum_requirement', 'total_bonus', 'status', 'rule_description', 'icon'];

    public function RouletteMain() {
        return $this->hasMany(RouletteMain::class, 'roulette_config_id', 'roulette_config_id');
    }

    public static function mininumRequirement() {
        $config = self::where('status', 1)
            ->get()
            ->first();

        if ($config) return $config->minimum_requirement;
        else return 0;
    }
}