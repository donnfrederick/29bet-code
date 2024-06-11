<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AdminActivityLog extends Model
{
    protected $connection = 'db29betadmin';

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'ip_address',
        'date_created',
        'uid',
        'action_id',
        'display_type',
        'browser',
        'domain',
        'client'
    ];

    public function approved_withdrawal(Request $request, $uid) {
        
        $AdminActivityLog = new AdminActivityLog();
        $AdminActivityLog->description = $request->input('admin_description');
        $AdminActivityLog->ip_address = $request->input('ip_address');
        $AdminActivityLog->date_created = now();
        $AdminActivityLog->uid = $uid;
        $AdminActivityLog->action_id = 28;
        $AdminActivityLog->display_type = $request->input('display_type');
        $AdminActivityLog->browser = $request->input('browser');
        $AdminActivityLog->domain = $request->input('domain');
        $AdminActivityLog->client = $request->input('client');

        $AdminActivityLog->save();
        
    }

    public function request_withdrawal(Request $request, $uid) {
        
        $AdminActivityLog = new AdminActivityLog();
        $AdminActivityLog->description = $request->input('description');
        $AdminActivityLog->ip_address = $request->input('ip_address');
        $AdminActivityLog->date_created = now();
        $AdminActivityLog->uid = $uid;
        $AdminActivityLog->action_id = 12;
        $AdminActivityLog->display_type = $request->input('display_type');
        $AdminActivityLog->browser = $request->input('browser');
        $AdminActivityLog->domain = $request->input('domain');
        $AdminActivityLog->client = $request->input('client');

        $AdminActivityLog->save();
        
    }
    
    static function deviceDetected($device){

        if($device->isMobile()){
            return 'isMobile';
        }else{
            if($device->isDesktop()){
                return 'isDesktop';
            }else{
                if($device->isTablet()){
                    return 'isTablet';
                }else{
                    if($device->isPhone()){
                        return 'isPhone';
                    }else{
                        if($device->isRobot()){
                            return 'isRobot';
                        }else{
                            return 'unknown';
                        }
                    }
                }
            }
        }
    }

    static function browserDetected($device) {
        if( $device->isChrome() ){
            return 'isChrome';
        }else{
            if( $device->isFirefox() ){
                return 'isFirefox';
            }else{
                if( $device->isSafari() ){
                    return 'isSafari';
                }else{
                    if( $device->isOpera() ){
                        return 'isOpera';
                    }else{
                        if( $device->isIE() ){
                            return 'isIE';
                        }else{
                            return browser();
                        }
                    }
                }
            }
        }
    }



    public function saveLogs($description,$ipaddress,$user,$date,$actionID,$domain,$client) {

        $device = new Agent();
        $logs = new AdminActivityLog;
        $logs->description = $description;
        $logs->ip_address = $ipaddress;
        $logs->uid = $user;
        $logs->date_created = $date;
        $logs->action_id = $actionID;
        $logs->display_type = self::deviceDetected($device);
        $logs->browser = self::browserDetected($device);
        $logs->domain = $domain;
        $logs->client = $client;
        
        return $logs->save();

    }

}