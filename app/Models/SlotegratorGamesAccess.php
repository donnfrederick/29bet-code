<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotegratorGamesAccess extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slotegrator_games_access';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id', 'round_id', 'request_body', 'request_header', 'response', 'self_validation_response'];

    public function SaveRequest($body, $header, $response) {

        $data = json_decode($body, true);
        $arr = array();
        parse_str($data, $arr);

        $SlotegratorGamesAccess = new SlotegratorGamesAccess();
        
        if (isset($arr['transaction_id'])) {
            $transaction_id = $arr['transaction_id'];
        }else {
            $transaction_id = null;
        }

        if (isset($arr['round_id'])) {
            $round_id = $arr['round_id'];
        }else {
            $round_id = null;
        }

        $create = $SlotegratorGamesAccess->create([
            'transaction_id' => $transaction_id,
            'round_id' => $round_id,
            'request_body' => $body,
            'request_header' => $header,
            'response' => $response
        ]);
        
        if ($create) {
            return true;
        } else return false;


    }
    public function SaveRequestGameAccess($body, $header, $response, $url) {

        $SlotegratorGamesAccess = new SlotegratorGamesAccess();
        
        $create = $SlotegratorGamesAccess->create([
            'request_body' => $body,
            'request_header' => $header,
            'response' => $response,
            'self_validation_response' => $url
        ]);
        
        if ($create) {
            return true;
        } else return false;

    }


    public function checkDuplicate($data){

        if (isset($data['round_id'])) {
            $query = $this->where('round_id', $data['round_id']);
        }

        if (isset($data['transaction_id'])) {
            $query = $this->where('transaction_id', $data['transaction_id']);
        }


        return $query->first();

    }

    public function checkRoundID($round_id){

        $query = $this->where('round_id', $round_id);


        return $query->first();

    }

    public function FindTransaction ($round_id, $transaction){

        $query = $this->where('round_id', $round_id)
        ->where('transaction_id', $transaction)
        ->first();

        return $query;

    }

    public function FindProviderTransactionID($data){

        $query = $this->where('transaction_id', $data['transaction_id'])
        ->latest('id')
        ->first();

        return $query;
        
    }

    public function FindRoundID($data){

        $query = $this->where('round_id', $data['round_id'])
        ->first();

        return $query;

    }

    public function FindTransactionID($data){

        $query = $this->where('transaction_id', $data['bet_transaction_id'])
        ->first();

        return $query;

    }

    public function FindRollbackTransaction ($transaction){

        $query = $this->where('transaction_id', $transaction)
        ->first();

        return $query;

    }

}