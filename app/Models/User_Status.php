<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User_Status extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'user_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'is_online',
        'date_modified',
    ];
    protected $primaryKey = 'uid';
  

    public function login() {
        $uid = Auth::user()->uid;

        $this::updateOrCreate(['uid'=>$uid],[
            'is_online' => '1',
            'date_modified'=> now()
        ]);
        // $this::where('uid', $uid)->update([
        //     'is_online' => '1',
        //     'date_modified'=> $date
        // ]);

    }

    public function logout() {
        $uid = Auth::user()->uid;
        
        $this::updateOrCreate(['uid'=>$uid],[
            'is_online' => '0',
            'date_modified'=> now()
        ]);
    }

 
}
