<?php 

namespace App\Libraries;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\LockableFile;
use App\Services\GoogleTranslateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;

class Notification
{
    protected $s3Client;

    public function __construct()
    {
        
        $this->s3Client = new S3Client([
            'credentials' => [
                'key' => config('filesystems.disks.s3_second.key'),
                'secret' => config('filesystems.disks.s3_second.secret'),
            ],
            'region' => config('filesystems.disks.s3_second.region'),
            'version' => 'latest',
        ]);
        
    }

    public function getNotification($uid)
    {

        $bucketName = '29betbucket-api';

        $filePath = 'notifications/notif_' . $uid . '.json';
        $checkFiles = self::pullFile($filePath, $bucketName);

        if ($checkFiles) {
            $getData = array();
            $fileData = self::readFile($filePath, $bucketName);

            if (!is_null($fileData)) {

                $getData = json_decode($fileData, true);
                $filterTranslate = new GoogleTranslateService();
                $getData = $filterTranslate->filterCustomTranslate2($getData, 'notification_message_' . $uid . '-', ['title', 'sub_title', 'message', 'sub_message']);

            }

            return collect($getData)->where('read', 0)->sortByDesc('datetime')->values()->all();
        } else {

            return false;

        }

    }

    public function pullFile($filePath, $bucketName)
    {

        try {

            $this->s3Client->headObject([
                'Bucket' => $bucketName,
                'Key' => $filePath,
            ]);

            return true;

        } catch (\Aws\S3\Exception\S3Exception $e) {

            return false;

        }

    }

    protected function readFile($filePath, $bucketName)
    {

        try {

            $result = $this->s3Client->getObject([
                'Bucket' => $bucketName,
                'Key' => $filePath,
            ]);

            return $result['Body']->getContents();

        } catch (\Aws\S3\Exception\S3Exception $e) {

            return null;

        }

    }

    public function saveFile($filePath, $bucketName, $data){

        try {

            $this->s3Client->putObject([
                'Bucket' => $bucketName,
                'Key' => $filePath,
                'Body' => $data,
            ]);
    
            return true;

        } catch (\Aws\S3\Exception\S3Exception $e) {

            return false;

        }

    }

    public function ClearNotification($uid, $id){


        $bucketName = '29betbucket-api';
        $filePath = 'notifications/notif_' . $uid . '.json';

        sleep(2);

        $checkFiles = self::pullFile($filePath, $bucketName);

        if ($checkFiles) {

            $getData = array();
            $fileData = self::readFile($filePath, $bucketName);

            if (!empty($fileData)) {

                $getData = json_decode($fileData, true);

                foreach ($getData as $key => $item) {

                    if ($item['id'] == $id) {
                        unset($getData[$key]);
                    }

                }
                
                $data = array_values($getData);
                $jsonData = json_encode($data, JSON_PRETTY_PRINT);
                $save = self::saveFile($filePath, $bucketName, $jsonData);

                if ($save) {

                    return true;

                }else {

                    return false;

                }
        
            }else {

                return false;

            }

        } else {

            return false;

        }

    }

    public function ClearAllNotificationPlatform($uid){
        
        $bucketName = '29betbucket-api';
        $filePath = 'notifications/notif_' . $uid . '.json';

        sleep(2);

        $checkFiles = self::pullFile($filePath, $bucketName);

        if ($checkFiles) {

            $save = self::saveFile($filePath, $bucketName, "");

            if ($save) {

                return true;

            }else {

                return false;

            }

        }else {

            return false;

        }

    }

}

?>