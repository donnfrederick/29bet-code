<?php

namespace App\Http\Controllers\Api;

use App\Models\GameClickTracker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameClickTrackerController extends Controller
{
    /**
     * ClickTracker API
    */
    public function Add($game_id) {
        $uid = Auth::user()->uid;
        $GameClickTracker = new GameClickTracker();
        return $GameClickTracker->record($uid, $game_id);
    }
}
