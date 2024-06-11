<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\LockableFile;
use App\Libraries\Notification;

class ClearNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function __construct()
    {
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function FetchNotification(){

        $system_notif_count = 0;
        $system_notif = '';
        
        if (Auth::user()) {
            
            $Notification = new Notification;
            $system_notif = $Notification->getNotification(Auth::user()->uid);
            
            if ($system_notif) {

                $system_notif_count = count($system_notif);
                $system_notif = collect($system_notif)->map(function ($item){

                    $item['date'] = date('Y/m/d', strtotime($item['datetime']));
                    $item['time'] = date('h:i A', strtotime($item['datetime']));

                    return $item;

                });


            }
            
        }

        return response()->json(["system_notification" => $system_notif, 'system_notif_count' => $system_notif_count]);

    }

    public function ClearNotification(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {
                
                $id = $request->input('id');
                $Notification = new Notification;
                $return = $Notification->ClearNotification(Auth::user()->uid, $id);

                return response()->json(["status" => 200, "error" => "", "msg" => $return]);

            }else {
                
                return response()->json(['status' => 500, 'error' => 'Unauthenticated', "msg" => ""]);

            }

        }else {

            return response()->json(['status' => 500, 'error' => 'Request Not Match', "msg" => ""]);

        }

    
    }

    public function ClearAllNotification(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {
                
                $uid = Auth::user()->uid;   

                if ($request->input('activeTab') == 'notificationPlatform') {

                    $Notification = new Notification;
                    $return = $Notification->ClearAllNotificationPlatform($uid);
                    
                }
                // elseif ($request->input('activeTab') == 'notificationUser') {

                //     $notificationPlatform_Path = resource_path('data\notif.json');
                //     if (File::exists($notificationPlatform_Path)) {

                //         $jsonData = file_get_contents($notificationPlatform_Path);
                //         $jsonData = json_decode($jsonData, true);
                        
                //         $count += count($jsonData);
            
                //     }
                    
                // }


                return response()->json(["status" => 200, "msg" => $return, 'count_notif' => 0, 'active_tab' => $request->input('activeTab')]);

            }else {
                
                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }else {

            return response()->json(['status' => 500, 'error' => 'Request Not Match']);

        }

    }

}
