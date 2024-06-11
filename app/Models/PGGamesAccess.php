<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PGGamesAccess extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pg_games_access';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['trace_id','request', 'unix', 'response', 'created_at', 'updated_at'];

    public function saveNew($trace_id, $request, $unix, $response) {
        $PGGamesAccess = new PGGamesAccess();
        $PGGamesAccess->trace_id = $trace_id;
        $PGGamesAccess->request = $request;
        $PGGamesAccess->unix = $unix;
        $PGGamesAccess->response = $response;
        $PGGamesAccess->created_at = now();
        
        
        if ($PGGamesAccess->save()) {
            return $PGGamesAccess->getKey();
        } else return false;
    }

    public function saveResponse($access_id, $response) {
        $PGGamesAccess = $this::find($access_id);
        $PGGamesAccess->response = $response;
        $PGGamesAccess->updated_at = now();
        
        if ($PGGamesAccess->save()) return true;
        else return false;
    }
}