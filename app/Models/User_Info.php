<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User_Info extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'users_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'birthday',
        'number_type_id',
        'number_id',
        'contact_address',
        'area_code',
        'mobile_number',
        'email',
        'facebook',
        'google',
        'twitter',
        'line',
        'qq',
        'wechat',
        'date_modified'
    ];
    protected $primaryKey = 'uid';

    public function getDetails($uid){
        $query = $this->select('number_id', 'mobile_number', 'email')
            ->where('uid', $uid)
            ->first();

        return $query;
    }

    public function getUserDetails($id) {
        return User_Info::find($id);
    }
   
    public function updateDetails($request) {
        return User_Info::updateOrCreate(['uid' => Auth::user()->uid],
        [
            'uid' => Auth::user()->uid,
            'number_type_id' => "PIX",
            'number_id' => $request->input('cpf'),
            'mobile_number' => $request->input('phone'),
            'email' => $request->input('email'),
            'date_modified' => now()
        ]);
    }

    public function updateUserDetails($request) {
        $saveFullname = User::updateOrCreate(['uid' => Auth::user()->uid],[
            'name' => $request['fullname'],
        ]);

        if($saveFullname){
            return User_Info::updateOrCreate(['uid' => Auth::user()->uid],
        [
            'uid' => Auth::user()->uid,
            'number_type_id' => "PIX",
            'number_id' => $request['cpf'],
            'email' => $request['email'],
            // 'number_id' => ($request['account-type'] = '1') ? $request['account-type-details'] : null,
            // 'email' => ($request['account-type'] = '2') ? $request['account-type-details'] : null,
            // 'mobile_number' => ($request['account-type'] = '3') ? $request['account-type-details'] : null,
            'date_modified' => now(),
        ]);
        }
    }
}
