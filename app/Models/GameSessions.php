<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSessions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_session';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function saveNew($trace_id, $request, $unix, $response) {
        $PGGamesAccess = new PGGamesAccess();
        $PGGamesAccess->trace_id = $trace_id;
        $PGGamesAccess->request = $request;
        $PGGamesAccess->unix = $unix;
        $PGGamesAccess->response = $response;
        
        if ($PGGamesAccess->save()) return true;
        else return false;
    }
}