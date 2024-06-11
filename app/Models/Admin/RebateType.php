<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RebateType extends Model
{
    protected $primaryKey = 'rebate_type_id';

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
    protected $table = 'rebate_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_category', 'date_created'];

    public function checkType($rebate_type_id, $game_category) {
        $matched = false;
        $type = $this::find($rebate_type_id);
        
        foreach (json_decode($type->game_category) as $category) {
            if (array_key_first(get_object_vars($category)) == $game_category) return true;
        }

        return $matched;
    }
}