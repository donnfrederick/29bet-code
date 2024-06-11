<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GameConfiguration extends Model
{
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
    protected $table = 'game_configuration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_id', 'game_parameter', 'game_button'];

    public function getBy($param, $val) {
        return $this->select()
            ->where($param, $val)
            ->get()
            ->first();
    }
}
