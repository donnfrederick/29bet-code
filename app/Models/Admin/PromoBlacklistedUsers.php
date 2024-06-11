<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PromoBlacklistedUsers extends Model
{
    protected $primaryKey = 'promo_code';

    protected $keyType = 'string';

    public $timestamps = false;

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
    protected $table = 'promotion_blacklisted_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid', 'promo_code', 'date_created', 'status', 'date_modified'];
}
