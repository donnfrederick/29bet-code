<?php

namespace App\Http\Controllers\Google;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\GoogleCredentials as GoogleCredentials;
use App\Models\User;
use App\Models\User_Referral;
use App\Models\User_Status;
use App\Models\User_Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use URL;
use Illuminate\Support\Str;


class GoogleController extends Controller
{
    //
    use RegistersUsers;
    protected $redirectTo = '/';

    public $GoogleCredentials;
    public $User_Referral;
    public $User_Status;
    public $User;
    private $User_Info;

    public function __construct(User $User, User_Referral $User_Referral, User_Status $User_Status, GoogleCredentials $GoogleCredentials,User_Info $User_Info)
    {
        $this->User = $User;
        $this->User_Referral = $User_Referral;
        $this->User_Status = $User_Status;
        $this->GoogleCredentials = $GoogleCredentials;
        $this->User_Info = $User_Info;

    }
    public function login()
    {
        
        $url = URL::previous();
        return $this->google($url);
        
    }

    public function google($url)
    {

        $parsedUrl = parse_url($url);
        
        if (isset($parsedUrl['host']) && $parsedUrl['host'] == 'localhost' || $parsedUrl['host'] == 'test.29bet' || $parsedUrl['host'] == '29bet' || $parsedUrl['host'] == 'uat.29bet.com') {

            session(['urlPrevious' => $url]);

        }
       
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();

    }
    public function loginwithGoogle(Request $request)
    {
        try {
          
            $user = Socialite::driver('google')->user();
          
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Google authentication failed.');

        }
        
        $token = csrf_token();
        $guid = $this->generateGUID();

        $existingUser = User::where('email', $user->getEmail())->first();
     
        if ($existingUser) {
          
            Auth::login($existingUser, true);
            
            session()->forget('urlPrevious');
              // refresh token google table


            $refresh_token = User::updateOrCreate(['uid' => $existingUser->uid],['uid' => $existingUser->uid,'api_token' => $token, 'guid' => $guid]);
            return redirect('/');
            // if($refresh_token){
            //     $log = $this->ActivityLog->login($request);
            //     if($log){
                    
            //     }
            //     else{
            //         return false;
            //     }
            // }
            // else{
            //     return false;
            // }

            // insert activity log login and also add checking of session when idling then redirect to login



            // return redirect('/');

        } else {
            
            $token = csrf_token();
            $uid = uniqid() . mt_rand(313, 1815);
            $this_user = $this->GoogleCredentials->createGoogleCredentials($user, $uid, $token, session('urlPrevious'), $guid);
            $User = User::find($this_user);
            
            if( Auth::login($User,true) ){  
                     return redirect('/');
                // $log = $this->ActivityLog->login($request);
                // if($log){
                //     return redirect('/');
                //     session()->forget('urlPrevious');
                // }
                // else{
                //     return false;
                // }
                
                // return redirect('/');

            }else{

                return redirect('/');

            }

            // if ($this->guard()->login($User, true)) {
            //     return redirect('/');
            // } else {
            //     dd("may mali");
            // }
        }
        return back();
    }
    
    public function saveInformation(Request $request)
    {
        if( $request->has('btn-save-info') ) {

            $validator = Validator::make($request->all(), [ 
                'cpf' => 'required|min:11|max:11|unique:users_info,number_id',
                'phone' => 'required|unique:users_info,mobile_number|max:11|min:11',
                'email' => 'required|email',
                'referral_code' => 'nullable',
            ]);

            if ($validator->fails()) {

                return redirect('/')
                    ->withErrors($validator, 'error_google_reg')
                    ->with('session_google_reg', 'session_google_reg')
                    ->withInput();
            } else {
             
                 if( $this->User_Info->updateDetails($request) ){

                    $UserReferral = $this->User_Referral->getUserReferral(Auth::user()->uid);

                    if ($UserReferral['referral_id'] == null) {

                        if( $this->User_Referral->saveReferral($request) ) {
                            $msg = 'Successfully saved';
                            session()->forget('session_google_reg');
                            return redirect()->back()->with('session_notification', $msg);
                        }

                    }else {

                        $msg = 'Successfully saved';
                        session()->forget('session_google_reg');
                        return redirect()->back()->with('session_notification', $msg);

                    }
                 }else{

                 }
            }
        }
    }


    public function completeRegistration(Request $request){
        if($request->has('btn-save-info-normal-reg')){
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'cpf' => 'required|min:11|max:11',
                'email' => 'required|email',
            ]);

            // // Add custom validation rules
            // $validator->sometimes('account-type-details', 'numeric', function ($input) {
            //     return $input->get('account-type') == '1';
            // });

            // $validator->sometimes('account-type-details', 'email', function ($input) {
            //     return $input->get('account-type') == '2';
            // });

            // $validator->sometimes('account-type-details', 'numeric', function ($input) {
            //     return $input->get('account-type') == '3';
            // });

            if ($validator->fails()){
                return redirect('/')
                ->withErrors($validator, 'error_normal_reg')
                ->with('error_normal_reg', 'error_normal_reg')
                ->withInput();
            }
            else{
                if($this->User_Info->updateUserDetails($request)){
                    $msg = 'Successfully saved';
                    session()->forget('error_normal_reg');
                    return redirect()->back()->with('session_notification', $msg);
                }
                else{
                    $msg = 'Something went wrong! Please try again later.';
                    session()->forget('error_normal_reg');
                    return redirect()->back()->with('session_notification', $msg);
                }
            }
        } 
    }

    
    public function generateGUID(){

        
        $guid_unique = false;

        while (!$guid_unique) {

            $guid = Str::uuid();

            $exist = User::where('guid', $guid)->first();

            if (!$exist) {
                $guid_unique = true;
            }

        }

        return $guid;

    }

}
