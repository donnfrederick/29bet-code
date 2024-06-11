<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryBalance extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'history_balance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'operation',
        'uid',
        'game_id',
        'created_at',
        'updated_at'
    ];

    public function create($value, $operation, $uid, $game_id, $balance_type, $game_history_id) {
        $HistoryBalance = new HistoryBalance();

        $HistoryBalance->value = $value;
        $HistoryBalance->operation = $operation;
        $HistoryBalance->uid = $uid;
        $HistoryBalance->game_id = $game_id;
        $HistoryBalance->balance_type = $balance_type;
        $HistoryBalance->game_history_id = $game_history_id;
        $HistoryBalance->created_at = now();
        $HistoryBalance->updated_at = now();

        if ($HistoryBalance->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function Bets($operation, $uid){

        return $this->where('operation', $operation)
            ->where('uid', $uid)
            ->sum('value');
    }


}
