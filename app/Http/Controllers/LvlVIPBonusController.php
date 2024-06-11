<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelVIPBonusClaimed;
class LvlVIPBonusController extends Controller
{
    private $levelvipbonusclaimed;

    public function __construct(LevelVIPBonusClaimed $levelvipbonusclaimed)
    {
        $this->levelvipbonusclaimed = $levelvipbonusclaimed;
    }

    public function claimVIPBonus(Response $response) {
        if( $request->ajax() ){

        }else{
            
        }
    }
}
