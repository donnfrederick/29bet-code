<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PGGamesDetails extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pg_games_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid','token', 'guiid', 'created_at', 'updated_at'];

    public function saveNew($uid, $token, $guiid) {
        $PGGamesDetails = new PGGamesDetails();
        $PGGamesDetails->uid = $uid;
        $PGGamesDetails->token = $token;
        $PGGamesDetails->guiid = $guiid;
        $PGGamesDetails->created_at = now();
        $PGGamesDetails->updated_at = now();
        
        if ($PGGamesDetails->save()) {
            return true;
        } else return false;
    }

    public function validateToken($ops){

        $details = $this->select()->where('guiid', $ops)->first();
        
        $user = User::where('uid', $details['uid'])->get();

        if (!$user->isEmpty()) {
            $user = $user->first();

            if (!$this->isLocked($user)) {
                return $user;
            } else return false;
        } else return false;

    }
    
    private function isLocked($user) {
        if ($user->status_lock == 0) {
            return false;
        } else {
            return true;
        }
    }

}