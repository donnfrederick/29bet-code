<?php

namespace App\Models;

use Aws\S3\S3Client;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FreeSpin extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'freespin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['roulette_config_id', 'uid','win', 'code', 'created_at', 'updated_at'];

    public function spin($uid) {
        $this->uid = $uid;

        if ($this->validate($uid)) {
            return true;
        } else {
            return false;
        }
    }

    public function win($roulette_config_id, $uid, $win, $code, $transaction_id) {
        $FreeSpin = new FreeSpin();

        $FreeSpin->roulette_config_id = $roulette_config_id;
        $FreeSpin->uid = $uid;
        $FreeSpin->win = $win;
        $FreeSpin->code = $code;
        $FreeSpin->transaction_id = $transaction_id;
        $FreeSpin->created_at = now();
        $FreeSpin->updated_at = now();


        if ($FreeSpin->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getData() {
        $user = optional(Auth::user())->uid;

        $freeSpin_data = self::leftJoin('users','freespin.uid','=','users.uid')->where('freespin.uid','=',$user)->take(4)->get();

        $freeSpin_jackpot = self::where('win', '=', 0)->orWhere('win', '>=', 3000)->select(DB::raw('SUBSTRING(uid, -4) as uid'), 'win', 'created_at')->orderBy('id', 'desc')->take(4)->get();

        return [
            'min_req' => RouletteConfigurations::mininumRequirement(),
            'prizes' => self::getPrizes(),
            'segments' => json_encode(self::Segments()),
            'freeSpin_data' => $freeSpin_data,
            'freeSpin_jackpot' => $freeSpin_jackpot,
            'total' => self::select(DB::raw("SUM(win) as total"))->get()->first()->total
        ];
    }
    public static function Segments() {
        $segments = [];

        $RouletteConfigurations = \App\Models\RouletteConfigurations::where('status', 1)
            ->get()
            ->first();

        if ($RouletteConfigurations) {
            $Configs = $RouletteConfigurations->RouletteMain()
                ->orderBy('sorting', 'asc')
                ->get();
            
            foreach ($Configs as $config) {
                array_push($segments, (object) [
                    "fillStyle" => "#fff0",
                    "text" => $config->RoulettePrizeCodes()->get()->first()->prize_amount,
                    "code" => $config->RoulettePrizeCodes()->get()->first()->prize_code
                ]);
            }
        }

        return $segments;
    }

    public static function getPrizes() {
        $RouletteConfigurations = \App\Models\RouletteConfigurations::where('status', 1)
        ->get()
        ->first();

        if ($RouletteConfigurations) {
            Dotenv::createImmutable(base_path())->load();

            $bucketName = '29betbucket';

            // $objectKey_app = "https://cdn.29bet.com/uat-images/roulette/".$RouletteConfigurations->icon;    
           
            // // Set your AWS credentials and region
            // $credentials = [
            //     'key'    => config('filesystems.disks.s3.key'),
            //     'secret' => config('filesystems.disks.s3.secret'),
            // ];

            // $region = config('filesystems.disks.s3.region');

            // $s3 = new S3Client([
            //     'version'     => 'latest',
            //     'region'      => $region,
            //     // 'profile' => 'default',
            //     'credentials' => [
            //     'key'    => $credentials['key'],
            //     'secret' => $credentials['secret'],
            //     ],
            // ]);

            if($RouletteConfigurations->icon){
                // $result = $s3->getObject([
                //     'Bucket' => $bucketName,
                //     'Key' => $objectKey_app,
                // ]);

                // return $result['@metadata']['effectiveUri'];

                return $result = "https://cdn.29bet.com/uat-images/roulette/".$RouletteConfigurations->icon;
            }else{
                return $result = '';
            }

            
        } else return null;
    }

    public static function hasActive() {
        if (\App\Models\RouletteConfigurations::where('status', 1)
            ->get()
            ->first()) {
            return true;
        } else return false;
    }

    private function validate($uid) {
        $freespin = $this->select('id')
            ->where('uid', $uid)
            ->whereDate('created_at', '>=', date('Y-m-d 00:00:00', strtotime(now())))
            ->whereDate('created_at', '<=', date('Y-m-d 23:59:59', strtotime(now())))
            ->get();

        if ($freespin->isNotEmpty()) {
            return false;
        } else {
            return true;
        }
    }
}
