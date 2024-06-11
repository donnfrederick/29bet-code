<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class ActivityLog extends Model
{
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


    static function getIP($request)
    {
        $userIpAddress = $request->server('HTTP_CF_CONNECTING_IP')
        ?? $request->server('HTTP_X_FORWARDED_FOR')
        ?? $request->ip()
        ?? $request->server('HTTP_CLIENT_IP')
        ?? $request->server('REMOTE_ADDR')
        ?? $request->header('CF-Connecting-IP')
        ?? $request->header('X-Real-IP')
        ?? $request->header('X-Real-IP');
    }
    
    static function deviceDetected($device)
    {

        if ($device->isMobile()) {
            return 'isMobile';
        } else {
            if ($device->isDesktop()) {
                return 'isDesktop';
            } else {
                if ($device->isTablet()) {
                    return 'isTablet';
                } else {
                    if ($device->isPhone()) {
                        return 'isPhone';
                    } else {
                        if ($device->isRobot()) {
                            return 'isRobot';
                        } else {
                            return 'unknown';
                        }
                    }
                }
            }
        }
    }

    static function browserDetected($device)
    {
        if ($device->isChrome()) {
            return 'isChrome';
        } else {
            if ($device->isFirefox()) {
                return 'isFirefox';
            } else {
                if ($device->isSafari()) {
                    return 'isSafari';
                } else {
                    if ($device->isOpera()) {
                        return 'isOpera';
                    } else {
                        if ($device->isIE()) {
                            return 'isIE';
                        } else {
                            return browser();
                        }
                    }
                }
            }
        }
    }
    
    public function login(Request $request)
    {
        $device = new Agent();
        $ActivityLog = new ActivityLog();
        $ActivityLog->description = "Successfully Logged-In";
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 1;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function logout(Request $request)
    {
        $device = new Agent();
        $ActivityLog = new ActivityLog();
        $ActivityLog->description = "Successfully Logged-Out";
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 5;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function deposit(Request $request)
    {
        $device = new Agent();
        $ActivityLog = new ActivityLog();
        $ActivityLog->description = "User Deposited";
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 7;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function withdraw(Request $request)
    {
        $device = new Agent();
        $ActivityLog = new ActivityLog();
        $ActivityLog->description = "User Requested a Withdrawal";
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 8;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function saveTransaction(Request $request)
    {
        $device = new Agent();

        $ActivityLog = new ActivityLog();
        $ActivityLog->description = $request->input('description');
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 4;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function saveTransactionParam(Request $request)
    {
        $device = new Agent();

        $ActivityLog = new ActivityLog();
        $ActivityLog->description = $request->input('description');
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = $request->input('action_id');
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function saveClaimPromoCode(Request $request)
    {
        $device = new Agent();

        $ActivityLog = new ActivityLog();
        $ActivityLog->description = $request->input('description');
        $ActivityLog->ip_address = $request->ip();
        $ActivityLog->date_created = now();
        $ActivityLog->uid = Auth::user()->uid;
        $ActivityLog->action_id = 15;
        $ActivityLog->display_type = self::deviceDetected($device);
        $ActivityLog->browser = self::browserDetected($device);
        $ActivityLog->domain = $request->getHost();
        $ActivityLog->client = $request->header('User-Agent');

        if ($ActivityLog->save()) {
            return true;
        } else {
            return false;
        }
    }


    public function saveLogs($description, $ipaddress, $user, $date, $actionID, $domain, $client)
    {

        $device = new Agent();

        $logs = new ActivityLog;
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
