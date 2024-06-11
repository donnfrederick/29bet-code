<?php

namespace App\Models\Admin;

use App\Http\Controllers\PGSoftController;
use App\Models\GameCategories;
use Illuminate\Database\Eloquent\Model;
use Aws\S3\Exception\S3Exception;
use App\Providers\AWSS3ServiceProvider;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Dotenv\Dotenv;
use Illuminate\Support\Facades\DB;

class GameList extends Model
{

    public $timestamps = false;
    /**
     * The database connection
     *
     * @var string
     */
    protected $connection = 'db29betadmin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_name','game_id', 'game_origin', 'api_url', 'game_category_id', 'enable','game_provider', 'app_icon', 'mobile_icon', 'computers_icon', 'sort'];

    public function isOriginal() {
        if ($this::find($this->id)->game_origin == "Original Game") {
            return true;
        } else return false;
    }

    public function category() {
        return GameCategories::find($this->game_category_id);
    }

    public function provider() {
        return GameProvider::find($this->game_provider);
    }

    public function getPGUrl() {
        $PGSoftController = new PGSoftController();
        $ot = $PGSoftController->pgOT;
        $ops = csrf_token();
        $lang = app()->getLocale();
        return "/pgsoft/$this->game_id";
    }

    public function getGame($game_id) {
        return $this::find($game_id);
    }

    // External functions

    public function getGameAll() {
        return $this->select()
            ->where('enable', 1)
            ->get();
    }

    public function getGameBy($param, $val) {
        return $this->select()
            ->where('enable', 1)
            ->where($param, $val)
            ->get()
            ->first();
    }

    public function getPGGames() {
        return $this->select()
            ->where('enable', 1)
            ->where('game_provider', 8)
            ->orderBy("sort", "asc")
            ->get();
    }

    public function getOGGames() {
        return $this->select()
            ->where('enable', 1)
            ->where('game_provider', 4)
            ->get();
    }

    public function getGameId($game_name) {
        return $this->getGameBy('game_name', $game_name);
    }

    public function getGameByProvider($game_provider) {
        $games = $this->select()->where('game_list.enable', 1)
        ->where('game_provider', $game_provider)
        ->leftJoin('db29betadmin.game_provider', 'db29betadmin.game_list.game_provider','=','db29betadmin.game_provider.id')
        ->leftJoin('db29bet.game_category','db29betadmin.game_list.game_category_id','=','game_category.game_category_id')
        ->orderBy('sort', 'asc')
        ->get();

        $games_p = [];

        foreach($games as $game){
             // Load environment variables from .env file
             $dotenv = Dotenv::createImmutable(base_path());
             $dotenv->load();
 
             $bucketName = '29betbucket';

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
            
            if(!empty($game->computers_icon)){
                if($game->game_origin == 'Original Game'){
                    $computers_icon_path = $game->computers_icon;
                    // $result = $s3->getObject([
                    //     'Bucket' => $bucketName,
                    //     'Key' => $objectKey_computer,
                    // ]);
                    // $computers_icon_path = $result['@metadata']['effectiveUri'];
                }
                else{
                    $computers_icon_path = $game->computers_icon;
                }
            }
            else{
                $computers_icon_path = '';
            }

            $games_p[] = [
                'id' => $game->id,
                'game_name' => $game->game_name,
                'game_id' => $game->game_id,
                'game_origin' => $game->game_origin,
                'api_url' => $game->api_url,
                'game_category_id' => $game->game_category_id,
                'enable' => $game->enable,
                'game_provider' => $game->game_provider,
                'sort' => $game->sort,
                'category_name' => $game->category_name,
                'game_provider_name' => $game->game_provider_name,
                // 'app_icon' => $app_icon_path,
                // 'mobile_icon' => $mobile_icon_path,
                'computers_icon' => $computers_icon_path,
            ];
        }
        return $games_p;
    }

    public function getGameByOrigin($game_origin) {
        $games = DB::connection('db29betadmin')->table('game_provider')
        ->select(
            'game_list.id AS id', 
            'game_list.game_name AS game_name', 
            'game_list.game_id AS game_id', 
            'game_list.game_origin AS game_origin', 
            'game_list.api_url AS api_url', 
            'game_list.game_category_id AS game_category_id', 
            'game_list.enable AS enable', 
            'game_list.game_provider AS game_provider', 
            'game_list.app_icon AS app_icon', 
            'game_list.mobile_icon AS mobile_icon', 
            'game_list.computers_icon AS computers_icon', 
            'game_list.sort AS sort',
            'game_category.category_name AS category_name',
            'game_provider.game_provider_name AS game_provider_name'
        )
        ->leftJoin('game_list', 'game_provider.id', '=', 'game_list.game_provider')
        ->leftJoin('db29bet.game_category', 'game_list.game_category_id', '=', 'game_category.game_category_id')
        ->whereIn('game_provider', [4, 51])
        ->where('game_provider.enable', '1')
        ->where('game_list.enable', 1)
        ->orderBy('game_list.sort', 'desc')
        ->get();

        $orig_games = [];

        foreach($games as $game){
            // Load environment variables from .env file
            $dotenv = Dotenv::createImmutable(base_path());
            $dotenv->load();

            $bucketName = '29betbucket';
            

            // $objectKey_app = "uat-images/games/".$game->app_icon;    
            // $objectKey_mobile = "uat-images/games/".$game->mobile_icon;   
            

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


            if(!empty($game->computers_icon)){
                if($game->game_origin == 'Original Game'){
                    $computers_icon_path = $game->computers_icon;
                    // $result = $s3->getObject([
                    //     'Bucket' => $bucketName,
                    //     'Key' => $objectKey_computer,
                    // ]);
                    // $computers_icon_path = $result['@metadata']['effectiveUri'];
                }
                else{
                    $computers_icon_path = $game->computers_icon;
                }
            }
            else{
                $computers_icon_path = '';
            }

    
            $orig_games[] = [
                'g_id' => $game->id,
                'game_name' => $game->game_name,
                'game_id' => $game->game_id,
                'game_origin' => $game->game_origin,
                'api_url' => $game->api_url,
                'game_category_id' => $game->game_category_id,
                'enable' => $game->enable,
                'game_provider' => $game->game_provider,
                'sort' => $game->sort,
                'category_name' => $game->category_name,
                'game_provider_name' => $game->game_provider_name,
                // 'app_icon' => $app_icon_path,
                // 'mobile_icon' => $mobile_icon_path,
                'computers_icon' => $computers_icon_path,
            ];
        }

        return $orig_games;

        
        // return $this::where('game_origin', $game_origin)
        //     ->where('enable', 1)
        //     ->orderBy('sort', 'asc')
        //     ->get();
    }

    public function getGameByCategory($game_category_id) {
        return $this::where('game_category_id', $game_category_id)
            ->where('enable', 1);
    }

    public function checkGamesID($game_id){

        $query = $this->where('game_id', $game_id)->first();

        return $query;

    }

}
