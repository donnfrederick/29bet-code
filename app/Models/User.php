<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ControlBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'username',
        'email',
        'password',
        'member_type',
        'agent_group',
        'referral_no',
        'registration_ip',
        'referral_link',
        'remember_token',
        'api_token',
        'guid',
        'status_lock',
        'name',
        'avatar',
        'is_google_acct',
        'login_attempt_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $primaryKey = 'uid';
    protected $keyType = 'string';
    public function getCurrentUser() {
        return Auth::user();
    }

    // -- Control Balance

    public function balance() {
        $uid = Auth::user()->uid;
        $ControlBalance = new ControlBalance();
        return $ControlBalance->getBalance($uid);
    }

    public function showBalance() {
        return sprintf("%.2f", $this->balance()->control_balance);
    }

    public function getControlBalance() {
        $ControlBalance = new ControlBalance();
        return $ControlBalance->getBalance($this->uid);
    }

    // -- End of Control Balance

    public function refreshToken() {

        $csrfToken = csrf_token();
        $guid = $this->generateGUID();
        $uid = Auth::user()->uid;

       if( $this::updateOrCreate(['uid'=>$uid ],['api_token'=>$csrfToken, 'guid'=>$guid]) ){
        return true;
       }else{
        return false;
       }
        // $this::where('uid', $uid)->update([
        //     'api_token' => $csrfToken
        // ]);
    }

    public function updateIMG($request,$id){

        $save = User::find($id);
        $save->avatar = $request;

        if($save->save()){
            return true;
        }else{
            return false;
        }

    }

    public function checkOldPassword($request,$id) {
        $current_user = Auth::user()->password;
        return Hash::check($request->input('current_password'), $current_user);
    }

    public function saveNewPassword($request) {
       return User::updateOrCreate(['uid' => Auth::user()->uid],
       ['password' => Hash::make($request->input('new_password'))]);
    }

    public function pullApiToken() {
        return Auth::user()->api_token;
    }

    public function checkIsGoogle() {
        $user = User::where('uid','=',Auth::user()->uid)->first();
        $user = $user->is_google_acct;

        if($user == 1){
            return true;
        }else{
            return false;
        }
    }

    public function findUserPlayer($uid){

        $query = $this->where('uid', $uid)->first();

        return $query;

    }

    public function generateGUID(){

        
        $guid_unique = false;

        while (!$guid_unique) {

            $guid = Str::uuid();

            $exist = $this->where('guid', $guid)->first();

            if (!$exist) {
                $guid_unique = true;
            }

        }

        return $guid;

    }

}
