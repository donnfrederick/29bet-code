<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User_Referral extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $levels = 3;

    public $timestamps = false;

    protected $table = 'user_referrals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'referral_id',
        'referral_no',
        'date_registered'
    ];

    public function saveReferral($request) {
        return User_Referral::updateOrCreate(['users_id' => Auth::user()->uid],
        [
            'referral_id' => $request->input('referral_code'),

        ]);
    }

    public function ReferralPyramid($referral_id, $max_level){

        $rawSQL = "WITH RECURSIVE ReferralTree AS (
        SELECT
            referral_id AS inviter,
            referral_no AS invitee,
            1 AS level
        FROM
            user_referrals
        WHERE
            referral_id = ?
        UNION ALL
        SELECT
            ur.referral_id AS inviter,
            ur.referral_no AS invitee,
            rt.level + 1 AS level
        FROM
            user_referrals ur
        INNER JOIN
            ReferralTree rt ON ur.referral_id = rt.invitee
        WHERE rt.level < ?
        )
        SELECT
            inviter,
            invitee,
            level
        FROM
            ReferralTree
        ORDER BY
            level, inviter, invitee;";

        $query = DB::select($rawSQL, [$referral_id, $max_level]);

        return $query;

    }

    public function UpwardsReferralPyramid($referral_id, $max_level){

        $rawSQL = "WITH RECURSIVE ReferralTree AS (
            SELECT
                referral_id AS inviter,
                referral_no AS invitee,
                0 AS level
            FROM
                user_referrals
            WHERE
                referral_no = ?
            UNION ALL
            SELECT
                ur.referral_id AS inviter,
                ur.referral_no AS invitee,
                rt.level + 1 AS level
            FROM
                user_referrals ur
            INNER JOIN
                ReferralTree rt ON ur.referral_no = rt.inviter
            WHERE rt.level < ?
        )
        SELECT
            invitee,
            level
        FROM
            ReferralTree
        ORDER BY
            level;";

        $query = DB::select($rawSQL, [$referral_id, $max_level]);

        return $query;

    }

    // public function GetAllUID($referral_id){

    //     $query = $this->select('user_referrals.referral_id AS referral_id', 'user_referrals.referral_no AS referral_no', 'user_referrals.users_id AS uid');
    //     $query->leftJoin('users', 'user_referrals.users_id', '=', 'users.uid');
    //     $query->leftJoin('user_status', 'user_referrals.users_id', '=', 'user_status.uid');
    //     $query->where('user_referrals.referral_id', $referral_id);
    //     $query->groupBy('user_referrals.referral_id', 'user_referrals.referral_no', 'user_referrals.users_id');
    //     $query->orderBy('user_referrals.id', 'desc');

    //     return $query->get()->toArray();

    // }

    public function AccountRegistrationTable($referral_id, $date){

        $query = $this->select('user_referrals.referral_id AS referral_id',
        'users.username AS username', 'users.name AS name',
        'user_referrals.date_registered AS date_registered',
        'user_referrals.referral_no AS referral_no',
        'user_status.date_modified AS date_modified',
        'user_referrals.id AS id');
        $query->leftJoin('users', 'user_referrals.users_id', '=', 'users.uid');
        $query->leftJoin('user_status', 'user_referrals.users_id', '=', 'user_status.uid');
        $query->where('user_referrals.referral_id', $referral_id);
        // $query->whereIn('user_referrals.referral_id', $referral_id);

        switch ($date){

            case '1':
                $query->whereRaw('DATE(user_referrals.date_registered) BETWEEN ? AND ?', [
                    now()->subDays(7)->toDateString(),
                    now()->toDateString()
                ]);
                break;
            case '2':
                $query->whereDate('user_referrals.date_registered', now());
                break;
            case '3':
                $query->whereDate('user_referrals.date_registered', now()->subDays(1));
                break;
            case '4':
                $query->whereMonth('user_referrals.date_registered', now()->month);
                break;
            case '5':
                $query->whereYear('user_referrals.date_registered', now()->year);
                break;

        }

        $query->orderBy('user_referrals.id', 'desc');

        return $query->get()->toArray();

    }

    public function hasAgent($uid) {
        if ($this::where('users_id', $uid)->first()->referral_id != NULL) return true;
        else return false;
    }

    public function directAgent($uid) {
        $referral = $this::where('users_id', $uid)->first();
        return User::where('referral_no', $referral->referral_id)->first();
    }

    public function getAgents($uid) {
        $agents = [];

        $current_uid = $uid;
        for ($i = 1; $i <= $this->levels; $i++) {
            if ($player  = $this::where('users_id', $current_uid)->first()) {
                if ($player->referral_id != null) {
                    $agent = $this::where('referral_no', $player->referral_id)->first();
                    if($agent != null){
    
                        $current_uid = $agent->users_id;
                        $agents[] = [
                            'uid' => $current_uid,
                            'level' => $i
                        ];
    
                    }
                }
            } else {
                $agents[] = [
                    'uid' => null,
                    'level' => $i
                ];
            }
        }
        return $agents;
    }

    public function getUserReferral($uid){

        $query = $this->where('users_id', $uid)
        ->first();

        return $query;

    }

}
