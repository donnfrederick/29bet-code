<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class RebateConfig extends Model
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
    protected $table = 'rebate_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amount_to_reach'];
}