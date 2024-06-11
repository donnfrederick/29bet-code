<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Aws\Exception\AwsException;

class Ranks extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'member_levels_params';

    protected $fillable = [
        'level_name',
        'level',
        'total_deposits',
        'total_bets',
        'max_withdraw_amount',
        'max_withdraw_amount_period_cover',
        'withdrawal_rate',
        'betting_cashback_ratio',
        'remark',
        'date_created'
    ];

    public function getDetails($level){
        
        $query = $this->select('withdrawal_rate', 'monthly_free_withdrawal', 'max_withdraw_amount', 'max_withdraw_amount_period_cover', 'max_withdraw_amount')
            ->where('level', $level)
            ->first();

        return $query;

    }

    public function getIDDetails($id){
        
        $query = $this->select('level')
            ->where('id', $id)
            ->first();

        return $query;

    }

    public function ranks(){
        $ranks = $this->get();

        $rankss = [];

        foreach($ranks  as $rank){
            // Load environment variables from .env file
            $dotenv = Dotenv::createImmutable(base_path());
            $dotenv->load();

            $bucketName = '29betbucket';

            // Set your AWS credentials and region
            $credentials = [
                'key'    => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ];

            $region = config('filesystems.disks.s3.region');

            $s3 = new S3Client([
                'version'     => 'latest',
                'region'      => $region,
                // 'profile' => 'default',
                'credentials' => [
                    'key'    => $credentials['key'],
                    'secret' => $credentials['secret'],
                ],
            ]);

            if($rank->vip_level_badge){
                $badge = "https://cdn.29bet.com/uat-images/memberlevels/".$rank->vip_level_badge;    
                // $result = $s3->getObject([
                //     'Bucket' => $bucketName,
                //     'Key' => $objectKey,
                // ]);

                // $badge = $result['@metadata']['effectiveUri'];
            }
            else{
                $badge = '';
            }

            $rankss[] = [
                'id' => $rank->id,
                'level_name' => $rank->level_name,
                'level' => $rank->level,
                'total_deposits' => $rank->total_deposits,
                'total_bets'=> $rank->total_bets,
                'max_withdraw_amount' => $rank->max_withdraw_amount,
                'max_withdraw_amount_period_cover' => $rank->max_withdraw_amount_period_cover,
                'withdrawal_rate' => $rank->withdrawal_rate,
                'monthly_free_withdrawal' => $rank->monthly_free_withdrawal,
                'betting_cashback_ratio' => $rank->betting_cashback_ratio,
                'remark' => $rank->remark,
                'vip_level_badge' => $badge,
                'date_created' => $rank->date_created,
            ];  
        }
        return $rankss;
    }

}
