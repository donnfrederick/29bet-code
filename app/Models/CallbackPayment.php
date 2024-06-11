<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallbackPayment extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'callback_payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'orderType',
        'bankId',
        'amount',
        'createTime',
        'orderId',
        'payMethod',
        'transIds',
        'orderStatus',
        'mchOrderid',
        'failMessage',
        'alert_message',
        'transaction_id'
    ];

    public function CheckCallback($uid){
        
        $query = $this->select('callback_payment.mchOrderId AS mchOrderId', 'callback_payment.orderStatus AS orderStatus', 'callback_payment.failMessage AS failMessage')
            ->where('callback_payment.uid', $uid)
            ->where('callback_payment.orderType', "PAYMENT")
            ->where('alert_message', 1)
            ->first();

        return $query;
    }

    public function updateCallback($uid, $mchOrderId){

        $account = $this::where('uid', $uid)
        ->where('mchOrderId', $mchOrderId)
        ->get();

        if ($account->first()->update(['alert_message' => 0])) 
        {
            return true;

        } else {

            return false;

        }

    }

}
