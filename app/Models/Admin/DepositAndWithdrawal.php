<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepositAndWithdrawal extends Model
{
    use HasFactory;
    protected $connection = 'db29betadmin';
    protected $table = 'deposit_and_withdrawal';
    public $timestamps = false;
    protected $fillable = [
        'uid',
        'transaction_id',
        'order_id',
        'account_name',
        'account_number',
        'transaction_type',
        'date_transacted',
        'before_balance',
        'amount',
        'new_balance',
        'withdraw_fee',
        'front_users_remarks',
        'admin_remarks',
        'action_id',
        'transaction_type',
        'operator_uid',
        'promotion'
    ];

    public function saveTransactions($request)
    {
        return DepositAndWithdrawal::updateOrCreate(
            ['uid'   => Auth::user()->uid,'transaction_id' => $request->input('transaction_id')],
            [
                'uid'   => Auth::user()->uid,
                'transaction_id' =>  $request->input('transaction_id'),
                'date_transacted' => $request->input('date_transacted'),
                'action_id' => $request->input('action_id'),
                'transaction_type' =>  $request->input('transaction_type'),
                'before_balance' => $request->input('before_balance'),
                'amount' => $request->input('amount'),
                'new_balance' => $request->input('new_balance'),
                'front_users_remarks' => $request->input('front_users_remarks'),
                'admin_remarks' => $request->input('admin_remarks')
            ] 
        );
    }

}
