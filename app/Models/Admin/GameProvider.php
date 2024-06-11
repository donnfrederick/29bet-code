<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Dotenv\Dotenv;
class GameProvider extends Model
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
    protected $table = 'game_provider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_provider_name', 'date_created', 'img_icon', 'img_detail'];

    public function games() {
        // $games = GameList::where('game_provider', $this->id)
        // ->where('enable', 1)->get();

        // $orig_games = [];

        // foreach($games as $game){
        //     // Load environment variables from .env file
        //     $dotenv = Dotenv::createImmutable(base_path());
        //     $dotenv->load();

        //     $bucketName = '29betbucket';

        //     // $objectKey_app = "uat-images/games/".$game->app_icon;    
        //     // $objectKey_mobile = "uat-images/games/".$game->mobile_icon;   
        //     $objectKey_computer = "uat-images/providers/".$game->computers_icon;

        //     // Set your AWS credentials and region
        //     $credentials = [
        //         'key'    => config('filesystems.disks.s3.key'),
        //         'secret' => config('filesystems.disks.s3.secret'),
        //     ];

        //     $region = config('filesystems.disks.s3.region');

        //         $s3 = new S3Client([
        //             'version'     => 'latest',
        //             'region'      => $region,
        //             // 'profile' => 'default',
        //             'credentials' => [
        //                 'key'    => $credentials['key'],
        //                 'secret' => $credentials['secret'],
        //             ],
        //         ]);
        //     if(!empty($game->computers_icon)){
        //         $result = $s3->getObject([
        //             'Bucket' => $bucketName,
        //             'Key' => $objectKey_computer,
        //         ]);

        //         dd($result);

        //         $computers_icon_path = $result['@metadata']['effectiveUri'];
        //     }
        //     else{
        //         $computers_icon_path = '';
        //     }

        //     $orig_games[] = [
        //         'g_id' => $game->id,
        //         'game_name' => $game->game_name,
        //         'game_id' => $game->game_id,
        //         'game_origin' => $game->game_origin,
        //         'api_url' => $game->api_url,
        //         'game_category_id' => $game->game_category_id,
        //         'enable' => $game->enable,
        //         'game_provider' => $game->game_provider,
        //         'sort' => $game->sort,
        //         'category_name' => $game->category_name,
        //         'game_provider_name' => $game->game_provider_name,
        //         // 'app_icon' => $app_icon_path,
        //         // 'mobile_icon' => $mobile_icon_path,
        //         'computers_icon' => $computers_icon_path,
        //     ];
        // }
        
        // return $orig_games;
        // return $orig_games;
        return GameList::where('game_provider', $this->id)
            ->where('enable', 1)
            ->orderBy("sort", "asc");
    }

    public function getAll() {
        return $this->select()
            ->where('enable', "1")
            ->get();
    }
    public function getNavSlick() {
        return $this->select()
        ->where('enable', "1")
        ->whereIn('id', [8, 49])
        ->get();
    }

    public function getProviders() {
        $GameList = new GameList();
        $og_games = $GameList->getGameByOrigin("Original Game");
        $collect_og = collect($og_games);
        $game_provider_id = $this::find($collect_og->first()['game_provider'])->id;

        $providers = [];

        foreach ($this->getAll() as $provider) {
            if ($provider->id !== $game_provider_id) {
                $providers[] = $provider;
            }
        }

        return $providers;
    }

    public function getProviderByName($game_provider_name) {
        return $this::where('game_provider_name', $game_provider_name);
    }
}
