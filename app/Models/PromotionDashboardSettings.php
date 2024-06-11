<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Aws\Exception\AwsException;
use Illuminate\Database\QueryException;

class PromotionDashboardSettings extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promotion_dashboard_settings';
    protected $connection = 'db29betadmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile_icon',
        'mobile_icon_path',
        'computers_icon',
        'compurters_icon_path',
        'status',
        'display_to',
        'date_created',
    ];


    public function pullAllBannersForDashboard(){
       


        // $image_list = PromotionDashboardSettings::where('display_to', '=', 'Banner')->where('status', '=', '1')->get();

        $image_list = Events::where('display_to','=','Banner')
        ->where('display_status','=','Yes')
        ->get();

        $promotions_list = [];

        foreach($image_list as $promo){

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

            if(!empty($promo->picture_of_event)){
                $mobile_icon_path = "https://cdn.29bet.com/uat-images/events/".$promo->picture_of_event;    
                // $result = $s3->getObject([
                //     'Bucket' => $bucketName,
                //     'Key' => $objectKey_mobile,
                // ]);
                    
                // $mobile_icon_path = $result['@metadata']['effectiveUri'];   
            }
            else{
                $mobile_icon_path = '';
            }

            if(!empty($promo->picture_of_event)){
                $computers_icon_path = "https://cdn.29bet.com/uat-images/events/".$promo->picture_of_event;    
                // $result = $s3->getObject([
                //     'Bucket' => $bucketName,
                //     'Key' => $objectKey_computers,
                // ]);
                    
                // $computers_icon_path = $result['@metadata']['effectiveUri'];   
            }
            else{
                $computers_icon_path = '';
            }

            $promotions_list[] = [
                'id' => $promo->id,
                'mobile_icon' => $mobile_icon_path,
                'computers_icon' => $computers_icon_path,
                'status' => $promo->display_status,
                'display_to' => $promo->display_to,
                'date_created' => $promo->date_created,
    
            ];

            // dd($promotions_list);
        }
        return $promotions_list;
    }
}
