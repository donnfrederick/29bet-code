<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositAndWithdrawalConfig extends Model
{
    use HasFactory;
    protected $connection = 'db29betadmin';
    protected $table = 'deposit_and_withdrawal_config';
    public $timestamps = false;
    protected $fillable = [
        'minimum_withdrawal',
        'withdrawal_percentage',
        'rollover_multiplier',
        'minimum_recharge'
    ];

    public function getWithdrawalManagement(){

        $query = $this->select()
        ->first();

        return $query;

    }

}
