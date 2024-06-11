<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ActivityLog;
use App\Models\User_Status;
use Carbon\Carbon;

class CheckSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() == true && in_array('auth', $request->route()->middleware())) {

            $sessionTimeoutInMinutes = 10;
            $lastActivity = Session::get('lastActivity');
            $currentTime = Carbon::now();

            if ($currentTime->diffInMinutes($lastActivity) > $sessionTimeoutInMinutes) {

                $insertLogs = new ActivityLog();
                $insertLogs->logout($request);
        
                $User_Status = new User_Status();
                $User_Status->logout();
        
                $this->revokeGoogleToken();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                Auth::logout();
                return response()->view('errors.419', [], 419);

            }

            Session::put('lastActivity', Carbon::now());

        }
        
        return $next($request);

    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function revokeGoogleToken()
    {
        if (session()->has('google_token')) {

            // $googleClient = new Client();
            // $googleClient->setAccessToken(session('google_token'));

            // $accessToken = $googleClient->getAccessToken();
            // session()->revokeToken(session('google_token'));

            // session()->forget('google_token');
            Session::flush();
        }
        Session::flush();
    }
}
