<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LevelVIPBonusClaimed extends Model
{
    use HasFactory;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'level_vip_bonus_claimed';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'transactionID',
        'description',
        'amount',
        'date_claimed',
        'status',
        'level'
    ];

    public function saveClaimedVIPBonus($request)
    {
        return $this::updateOrCreate(
            ['transactionID'   => $request->input('transaction_id')],
            [
                'uid' => Auth::user()->uid,
                'description' => $request->input('description'),
                'amount' => $request->input('amount'),
                'date_claimed' =>$request->input('date_transacted'),
                'status' => 1,
                'level' => $request->input('level')
            ]
        );
    }

    public function checkClaimedVIPBonus($level){

        $query = $this->where('uid', Auth::user()->uid)
        ->where('level', $level)
        ->where('status', 1)
        ->first();

        return $query;

    }
   
}
