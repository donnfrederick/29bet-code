<?php

namespace App\Models;

use App\Models\Admin\GameList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GameClickTracker extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_click_tracker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uid','game_id'];

    public function record($uid, $game_id) {
        $GameClickTracker = new GameClickTracker();
        $GameClickTracker->uid = $uid;
        $GameClickTracker->game_id = $game_id;
        $GameClickTracker->create_date = now();
        $GameClickTracker->save();

        return response()->json(['status' => 200, 'api_url' => $this->route($game_id)]);
    }

    public function route($game_id) {
        $GameList = new GameList();
        $game_list = $GameList->getGameBy('game_id', $game_id);

        return $game_list->api_url;
    }
}
