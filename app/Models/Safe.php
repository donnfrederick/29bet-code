<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    use HasFactory;
    protected $table = 'safe_details';
    public $timestamps = false;
    protected $fillable = [
        'uid',
        'password',
        'date_modified',
        'date_created',
    ];

    protected $primaryKey = 'uid';
}
