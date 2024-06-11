<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentResponse extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_response';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'request',
        'response',
        'created_at'
    ];

    public function saveReponse($uid, $request, $response, $created_at) {
        $PaymentResponse = new PaymentResponse();
        $PaymentResponse->uid = $uid;
        $PaymentResponse->request = $request;
        $PaymentResponse->response = $response;
        $PaymentResponse->created_at = $created_at;
        
        if ($PaymentResponse->save()) {

            return true;

        } else {

            return false;

        }

    }

}
