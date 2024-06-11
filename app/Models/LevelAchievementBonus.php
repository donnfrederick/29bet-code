<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LevelAchievementBonus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'level_achievement_bonus_claimed';
    protected $fillable = [
        'uid',
        'transactionID',
        'description',
        'amount',
        'date_claimed',
        'status'
    ];
  
    public function saveClaimedAchievementBonus($request)
    {
        return LevelAchievementBonus::updateOrCreate(
            ['transactionID'   => $request->input('transaction_id')],
            [
                'uid' => Auth::user()->uid,
                'description' => $request->input('description'),
                'amount' => $request->input('amount'),
                'date_claimed' =>$request->input('date_transacted'),
                'status' => 1
            ]
        );
    }

    public function generateLvlAchievenCode() {
        $prefix = "TRXLVL";
        $maxdigits = '19';
        $randnum = '';
        while (strlen($randnum) < $maxdigits) {
            $randnum .= mt_rand(0, 9);
        }
        return $prefix."-".$randnum;
   
       // return sprintf('%s-%d-%d', $prefix, $timestamp, $randomNumber);
    }
}
