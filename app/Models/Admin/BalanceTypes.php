<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BalanceTypes extends Model
{
    protected $primaryKey = 'balance_type';

    protected $keyType = 'string';

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'balance_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'balance_type'
    ];

    public static function getBalanceID($balance_type) {
        return self::find($balance_type)->id;
    }
}