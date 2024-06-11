<?php 

namespace App\Libraries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCountry
{

    public function saveUserCountry($request){

        $ip_location = $request->server('HTTP_CF_IPCOUNTRY');

        $userCountry = $ip_location ? $ip_location : 'BR';

        Session::put('UserIPCountry', $userCountry);

    }

    public function getUserCountry(){

        $userCountry = Session::get('UserIPCountry');

        $userCountry = $userCountry ? $userCountry : 'BR';

        return $userCountry;

    }

}

?>