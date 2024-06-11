<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class Vault extends Model
{
    use HasFactory;
    protected $table = 'vault_detail';
    public $timestamps = false;
    protected $fillable = [
        'uid',
        'password',
        'date_modified',
        'date_created',
    ];

    protected $primaryKey = 'uid';

    public function checkIfExistsUid($uid) {
        return Vault::find($uid);
    }
    public function setPasswordVault($request) {

        return Vault::updateOrCreate(
            ['uid'   => Auth::user()->uid],
            [
                'password' => Hash::make($request->input('password')),
                'date_created' => now(),
            ] 
        );
    }
    public function matchPassword($request,$password){
       
        return Hash::check($request->input('password'), $password->password);
    }
    public function checkOldPasswordVault($request,$id) {

        $old_pass = Vault::find($id);
        return Hash::check($request->input('transfer_current_password'), $old_pass->password);  
    }
    public function saveNewPassword($request) {
        return Vault::updateOrCreate(['uid' => Auth::user()->uid],
        ['password' => Hash::make($request->input('transfer_new_password')), 'date_modified' => now()]);
    }
}

