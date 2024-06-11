<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use URL;
use App\Models\User_Info;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\ControlBalance;

class GoogleCredentials extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'google_details';
    protected $table2 = 'users_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gmail_id',
        'uid',
        'gmail_name',
        'gmail_email',
        'gmail_token',
        'gmail_refresh_token',
        'email_verified',
        'locale',
        'avatar',
        'expiresIn',
        'api_token'
    ];

    public function createGoogleCredentials($socialUser, $uid, $token, $urlPrevious, $guid)
    {
       

        $create = GoogleCredentials::updateOrCreate([
            'gmail_id' => $socialUser->id,
        ], [
            'uid' => $uid,
            'gmail_name' => $socialUser->name,
            'gmail_email' => $socialUser->email,
            'gmail_token' => $socialUser->token,
            'gmail_refresh_token' => $socialUser->refreshToken,
            'email_verified' => $socialUser->user['email_verified'],
            'locale' => $socialUser->user['locale'],
            'avatar' => $socialUser->avatar,
            'expiresIn' => $socialUser->expiresIn
        ]);

        if (strpos($urlPrevious, '/code=') !== false) {
            $codeValue = substr($urlPrevious, strpos($urlPrevious, '/code=') + strlen('/code='));
        } else {
            $codeValue = "";
        }

        $data = [
            "username" => "User-" . rand(100, 1000),
            "password" => $socialUser->id,
            "code" => $codeValue,
            "email" => $socialUser->email,
            "api_token" => $token,
            "status_lock" => 0,
            "name" => $socialUser->name,
            "is_google_acct" => 1,
            "remember_token" => $token,
            "avatar" => 'https://cdn.29bet.com/assets/images/user-profile/image_user2.png', 
            'guid' => $guid
        ];
        
        if ($create) {

            session()->put('google_token', $socialUser->token);
            return $this->UserDetails($uid, $data);

        } else {

            return false;

        }
        
    }

    // public function UserDetails($uid, $data)
    // {
    //     $referral_unique = false;

    //     while (!$referral_unique) {

    //         $refferal = substr(str_shuffle(MD5(microtime())), 0, 12);
    //         $exist = User::where('referral_no', $refferal)->first();

    //         if (!$exist) {
    //             $referral_unique = true;
    //         }
    //     }

    //     $baseUrl = url('/');
    //     $baseUrl = URL::to('/');
    //     $referral_link = $baseUrl . '/code=' . $refferal;
    //     $uid = uniqid() . mt_rand(313, 1815);
    //     $member_type = empty($data['code']) ? '3' : '3';
    //     $agent_group = empty($data['code']) ? '1' : '2';

    //     if (!empty($data['code'])) {
    //         $this->user_referral($data, $uid);
    //     }
    //     $this->user_status($uid);

    //     $createUser = User::updateOrCreate(
    //         ['uid' => $uid],[
    //         'uid' => $uid,
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'member_type' => $member_type,
    //         'agent_group' => $agent_group,
    //         'registration_ip' => $_SERVER['REMOTE_ADDR'],
    //         'referral_no' => $refferal,
    //         'referral_link' => $referral_link,
    //         'status_lock' => 0,
    //         'name' => $data['fullname'],
    //         'api_token' => $data['_token'],
    //         'remember_token' => $data['_token'],
    //         'avatar' => '/images/user-profile/image_user2.png',
    //         'is_google_acct' => 1
    //     ]);    

    //     // $createUser = User::create([
    //     //     'uid' => $uid,
    //     //     'username' => $data['username'],
    //     //     'email' => $data['email'],
    //     //     'password' => Hash::make($data['password']),
    //     //     'member_type' => "2",
    //     //     'agent_group' => "2",
    //     //     'registration_ip' => $_SERVER['REMOTE_ADDR'],
    //     //     'referral_no' => $refferal,
    //     //     'referral_link' => $referral_link,
    //     // ]);

    //     if ($createUser) {
    //         //create account balance
    //         $ControlBalance = new ControlBalance();
    //         $ControlBalance->init($uid);

    //         $createUserInfo = User_Info::create([
    //             'uid' => $uid,
    //         ]);

    //         if($createUserInfo){

    //             $pullUser = User::find($createUser->id); 
                
    //             Auth::login($pullUser,true);    
        
    //             return true;

    //         }else{

    //         }
    //     }

    // }

    public function UserDetails($uid, $data){

        $referral_unique = false;
        $refferal = substr(str_shuffle(MD5(microtime())), 0, 12);
        while (!$referral_unique) {

            $exist = User::where('referral_no', $refferal)->first();

            if (!$exist) {
                $referral_unique = true;
            }
        }
       
        $baseUrl = url('/');
        $baseUrl = URL::to('/');
        $referral_link = $baseUrl . '/code=' . $refferal;
        $member_type = empty($data['code']) ? '3' : '3';
        $agent_group = empty($data['code']) ? '1' : '2';

        if (!empty($data['code'])) {

            $data['generated_referral_code'] = $refferal;
            $this->user_referral($data, $uid);

        } else {

            $data['code'] = NULL;
            $data['generated_referral_code'] = $refferal;
        }


        if ($this->user_referral($data, $uid)) {
            
            if ($this->user_status($uid)) {
              
                if($this->setBalance($uid)){
                 
                    if($this->user_info($uid)){
                        
                        $create =  User::updateOrCreate(
                            ['uid' => $uid],[
                            'uid' => $uid,
                            'username' => $data['username'],
                            'email' => $data['email'],
                            'password' => Hash::make($data['password']),
                            'member_type' => $member_type,
                            'agent_group' => $agent_group,
                            'registration_ip' => $_SERVER['REMOTE_ADDR'],
                            'referral_no' => $data['generated_referral_code'],
                            'referral_link' => $referral_link,
                            'status_lock' => $data['status_lock'],
                            'name' => $data['name'],
                            'api_token' => $data['api_token'],
                            'remember_token' => $data['remember_token'],
                            'avatar' => '/images/user-profile/image_user3.png',
                            'is_google_acct' => $data['is_google_acct'],
                            'guid' => $data['guid']
                        ]);  
                        
                        if($create){
                            return $uid;
                        }else{
                            return false;
                        }
                          
                    }     
                }     
            }
        }
    }

    public function setBalance($uid) {
        $ControlBalance = new ControlBalance();
        return $ControlBalance->init($uid);
    }

    public function user_referral(array $data, $uid)
    {

        $User = User::where('referral_no', $data['code'])->first();
        $referral_id = is_null($User) ? NULL : $User->referral_no;

        return User_Referral::updateOrCreate(['users_id' => $uid], [
            'users_id' => $uid,
            'referral_id' => $referral_id,
            'referral_no' => $data['generated_referral_code'],
            'date_registered' => now()
        ]);
        
    }

    public function user_status($uid)
    {

        $date = now();
        return User_Status::updateOrCreate(['uid' => $uid],[
            'uid' => $uid,
            'is_online' => '1',
            'date_modified' => $date
        ]);
    }

    public function user_info($uid)
    {
        return User_Info::updateOrCreate(['uid' => $uid],[
            'uid' => $uid
        ]);
    }
}
