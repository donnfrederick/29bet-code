<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ControlBalance;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\User_Referral;
use App\Models\User_Status;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use URL;
use App\Models\User_Info;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'username' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8'],
            // 'fullname' => ['required', 'string', 'max:255'],
            // 'cpf' => ['required', 'string', 'max:255'],
            // 'phone' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $referral_unique = false;
        while (!$referral_unique) {

            $refferal = substr(str_shuffle(MD5(microtime())), 0, 12);
            $exist = User::where('referral_no', $refferal)->first();

            if (!$exist) {
                $referral_unique = true;
            }
        }

        /**
         * validate if the username email phone cpf exists
         */

        // $this->checkExistUsername($data['username']);

        // $this->checkExistEmail($data['email']);

        // $this->checkExistNumber($data['phone']);

        // $this->checkExistCPF($data['cpf']);

        $baseUrl = url('/');
        $baseUrl = URL::to('/');
        $referral_link = $baseUrl . '/code=' . $refferal;
        $uid = uniqid() . mt_rand(313, 1815);
        $member_type = empty($data['invitation_code']) ? '3' : '3';
        $agent_group = empty($data['invitation_code']) ? '1' : '2';
        $guid = $this->generateGUID();

        if (!empty($data['invitation_code'])) {

            $data['generated_referral_code'] = $refferal;
            $this->user_referral($data, $uid);
        } else {

            $data['invitation_code'] = NULL;
            $data['generated_referral_code'] = $refferal;
        }

        if ($this->user_referral($data, $uid)) {

            if ($this->user_status($uid)) {

                if ($this->setBalance($uid)) {

                    if ($this->user_info($uid, $data)) {

                        $save = User::updateOrCreate(
                            ['uid' => $uid],
                            [
                                'uid' => $uid,
                                'username' => $data['username'],
                                'email' => "",
                                'password' => Hash::make($data['password']),
                                'member_type' => $member_type,
                                'agent_group' => $agent_group,
                                'registration_ip' => $_SERVER['REMOTE_ADDR'],
                                'referral_no' => $data['generated_referral_code'],
                                'referral_link' => $referral_link,
                                'status_lock' => 0,
                                'name' => "",
                                'api_token' => $data['_token'],
                                'remember_token' => $data['_token'],
                                'guid' => $guid,
                                'avatar' => '/images/user-profile/image_user3.png',
                                'is_google_acct' => 0
                            ]
                        );

                        if ($save) {
                            return $uid;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }


    public function user_referral(array $data, $uid)
    {
        //$User = User::where('referral_no', $data['code'])->find($uid);
        $User = User::where('referral_no', $data['invitation_code'])->first();

        // $User = new User();
        // $referral_id = $User->select('uid')
        //     ->where('referral_no', $data['code'])
        //     ->first();
        $referral_id = is_null($User) ? NULL : $User->referral_no;

        return User_Referral::updateOrCreate(['users_id' => $uid], [
            'users_id' => $uid,
            'referral_id' => $referral_id,
            'referral_no' => $data['generated_referral_code'],
            'date_registered' => now()
        ]);
    }

    public function setBalance($uid)
    {
        $ControlBalance = new ControlBalance();
        return $ControlBalance->init($uid);
    }

    public function user_status($uid)
    {

        return User_Status::updateOrCreate(['uid' => $uid], [
            'uid' => $uid,
            'is_online' => '1',
            'date_modified' => now()
        ]);

    }

    public function user_info($uid, $data)
    {

        return User_Info::updateOrCreate(['uid' => $uid], [
            'uid' => $uid,
            'number_type_id' => 'PIX',
            'number_id' => "",
            'mobile_number' => $data['phone'],
            'email'  => "",
            'google'  => "",
            'date_modified' => now()
        ]);
    }

    public function checkExistUsername($data)
    {
        $col_name = 'username';

        $tosearchdata = $data;
        if (User::where($col_name, $tosearchdata)->exists()) {
            throw ValidationException::withMessages([
                'fields' => [trans('auth.field_exists', [
                    'field' => $col_name

                ])]
            ]);
        }


    }

    public function checkIfMaxLength15($data){
        $max_length = 15;
        if(strlen($data) > $max_length){
            throw ValidationException::withMessages([
                'fields' => [__("O nome de usuário deve ter 15 caracteres ou menos.", ['max_length' => $max_length])],
                'old_input' => $data
            ]);
        }
    }

    public function checkExistEmail($data)
    {
        $col_name = 'email';
        $tosearchdata = $data;


        if (User::where($col_name, $tosearchdata)->exists()) {
            throw ValidationException::withMessages([
                'fields' => [trans('auth.field_exists', [
                    'field' => $col_name

                ])]
            ]);
        }   

        // Check if the inputted email is a valid email format
        if (!filter_var($tosearchdata, FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages([
                // 'fields' => [trans('auth.Invalid Email')]
                'fields' => [__('E-mail inválido')]
            ]);
        }

    }

    public function checkExistNumber($data)
    {
        $col_name = 'mobile_number';
        $tosearchdata = $data;
        if (User_Info::where($col_name, $tosearchdata)->exists()) {
            throw ValidationException::withMessages([
                'fields' => [trans('auth.field_exists', [
                    'field' => $col_name

                ])]
            ]);
        }
    }

    public function checkExistCPF($data)
    {
        $col_name = 'number_id';
        $tosearchdata = $data;
        if (User_Info::where($col_name, $tosearchdata)->exists()) {
            throw ValidationException::withMessages([
                'fields' => [trans('auth.field_exists', [
                    'field' => $col_name

                ])]
            ]);
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