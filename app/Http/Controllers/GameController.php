<?php

namespace App\Http\Controllers;

use App\Models\Admin\GameConfiguration;
use App\Models\Admin\GameList;
use App\Models\Admin\GameProvider;
use App\Models\User;
use App\Models\SlotegratorGamesAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Aws\Exception\AwsException;
use Exception;
use Illuminate\Database\QueryException;

class GameController extends Controller {
    private $gameList;
    private $gameConfiguration;
    private $SlotegratorGamesAccess;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->gameList = new GameList();
        $this->gameConfiguration = new GameConfiguration();
        $this->SlotegratorGamesAccess = new SlotegratorGamesAccess();
    }

    public function getFooterSocialLogos(){ 
        // Load environment variables from .env file
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();

        $bucketName = '29betbucket';
        $pathPrefix = 'uat-images/footer/';

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


        $objects = $s3->listObjectsV2([
            'Bucket' => $bucketName,
            'Prefix' => $pathPrefix,
        ]);

        $filteredObjects = array_slice($objects['Contents'], 1);

        
        return $filteredObjects;
    }

    public function double(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        $wheel_config = $this->gameConfiguration
            ->getBy('game_id', 1)
            ->game_parameter;

        $config = explode(',', trim($wheel_config, '{}'));
        $speed_conf = explode(':', $config[2]);
        $waiting_conf = explode(':', $config[3]);

        $speed = trim($speed_conf[1], '"');
        $waiting = trim($waiting_conf[1], '"');

        if (Auth::user()) {
            return view('pages.double', [
                'speed' => $speed,
                'waiting' => $waiting,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function crash(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        $game_id = $this->gameList
            ->getGameId('crash')
            ->game_id;
        $crash_config = $this->gameConfiguration
            ->getBy('game_id', $game_id)
            ->game_parameter;

        $config = explode(',', trim($crash_config, '{}'));
        $zeroes_conf = explode(':', $config[0]);
        $ones_conf = explode(':', $config[1]);
        $twos_conf = explode(':', $config[2]);


        $zeroes = trim($zeroes_conf[1], '"');
        $ones = trim($ones_conf[1], '"');
        $twos = trim($twos_conf[1], '"');

        if (Auth::user()) {
            return view('pages.crash', [
                'zeroes' => $zeroes,
                'ones' => $ones,
                'twos' => $twos,
                'game_id' => $game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function mines(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.mines', [
                'game_id' => $this->gameList
                    ->getGameId('mines')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4)
            ]);
        } else return redirect('/');
    }

    public function dice(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.dice', [
                'game_id' => $this->gameList
                    ->getGameId('dice')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function tower(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            $game_id = $this->gameList->getGameId('tower');
            return view('pages.tower', [
                'game_id' => $this->gameList
                    ->getGameId('tower')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function roulette(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.roulette', [
                'game_id' => $this->gameList
                    ->getGameId('roulette')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function stairs(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.stairs', [
                'game_id' => $this->gameList
                    ->getGameId('stairs')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function coinflip(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.coinflip', [
                'game_id' => $this->gameList
                    ->getGameId('coinflip')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function hilo(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.hilo', [
                'game_id' => $this->gameList
                    ->getGameId('hilo')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function blackjack(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.blackjack', [
                'game_id' => $this->gameList
                    ->getGameId('blackjack')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function plinko(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.plinko', [
                'game_id' => $this->gameList
                    ->getGameId('plinko')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    public function keno(Request $request) {
        TokenController::VerifyToken($request, Auth::user()->api_token);

        if (Auth::user()) {
            return view('pages.keno', [
                'game_id' => $this->gameList
                    ->getGameId('keno')
                    ->game_id,
                'uid' => substr(Auth::user()->uid, 0, 4),
                // 'footer_socials' => $this->getFooterSocialLogos(),
            ]);
        } else return redirect('/');
    }

    //PG Games
    public function PGSoftGames(Request $request, $game_id) {
        return $this->getPGContent($game_id, $request->getHost(), true);
    }

    public function PGGames(Request $request, $game_id) {
        return $this->getPGContent($game_id, $request->getHost());
    }

    private function getPGContent($game_id, $host, $isSafari = null) {
        $GameProvider = new GameProvider();

        if ($game_provider = $GameProvider->getProviderByName("PGSoft")->first()) {
            $game_list = GameList::where('game_id', $game_id)->where('game_provider', $game_provider->id)->get();
            if ($game_list->isNotEmpty()) {

                $PGSoftController = new PGSoftController();
                $ops = csrf_token();
                $PGSoftController->PGCreds($host);
                $pgOT = $PGSoftController->pgOT;
                $pgHost = $PGSoftController->pgHost;

                $lang = app()->getLocale();
                $trace_id = Str::random(12);
                $user = User::select('guid')->where('uid', Auth::user()->uid)->first();

                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $clientIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $clientIp = $_SERVER['HTTP_CLIENT_IP'];
                } else {
                    $clientIp = $_SERVER['REMOTE_ADDR'];
                }

                $APIBody = "operator_token=" . $pgOT . "&path=%2F" . $game_id . "%2Findex.html&extra_args=btt%3D1%26ops%3D" . $user->guid . "%26l%3D" . $lang . "&url_type=game-entry&client_ip=". $clientIp;
                $reqUrl = $pgHost . 'external-game-launcher/api/v1/GetLaunchURLHTML?trace_id='.$trace_id;

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => $reqUrl,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>$APIBody,
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/x-www-form-urlencoded',
                        'Cache-Control: no-cache, no-store, must-revalidate'
                    ],
                ]);
                
                $htmlContent = curl_exec($curl);

                $PGGamesAccess = new \App\Models\PGGamesAccess();
                $PGGamesAccess->saveNew($reqUrl, $APIBody, now(), $htmlContent);
                
                curl_close($curl);

                // return view('pages.pgview', [
                //     'pg_url' => "https://m.pg-redirect.net/" . $game_id . "/index.html?btt=1&ot=" . $ot . "&ops=" . $ops . "&l=" . $lang . "&iwk=1"
                // ]);

                if ($isSafari) {
                    return view('pages.pgview_safari', compact('htmlContent'));
                } else return view('pages.pgview', compact('htmlContent'));
            } else return redirect('/404');
        } else return redirect('/404');
    }

    public function SlotegratorGames($game_id, $mobile = false) {
    
    
        $game_list = GameList::where('game_id', $game_id)->get();
        
        if ($game_list->isNotEmpty()) {
            $merchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
            $headers1 = [
            'X-Merchant-Id' => 'e15e95d35bba81a98d6f53a6f55c9b87',
            // 'X-Merchant-Id' => '2eaa671be518a6a51d6209bf2acaf88d',
            'X-Timestamp' => time(),
            'X-Nonce' => md5(uniqid(mt_rand(), true)),
            ];
            $requestParams = [
                'game_uuid' => $game_id,
                'player_id' => Auth::user()->uid,
                'player_name' => Auth::user()->username,
                'currency' => 'EUR',
                'session_id' => Auth::user()->guid,
                'return_url' => 'https://29bet.com',
                'language' => app()->getLocale()
            ];
            $mergedParams = array_merge($requestParams, $headers1);
            ksort($mergedParams);
            $hashString = http_build_query($mergedParams);
            $BodyParameters = http_build_query($requestParams);
            $XSign = hash_hmac('sha1', $hashString, $merchantKey);

            $ch = curl_init();
            
            // Set custom headers
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
                'X-Merchant-Id:'. $headers1["X-Merchant-Id"],
                'X-Timestamp:'.$headers1["X-Timestamp"],
                'X-Nonce:'.$headers1["X-Nonce"],
                'X-Sign:'.$XSign
            );

            $url = 'https://staging.slotegrator.com/api/index.php/v1/games/init?'. $BodyParameters;

            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$BodyParameters,
                CURLOPT_HTTPHEADER => $headers,
            ]);

            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            
            curl_close($ch);
            
            $response = json_decode($response, true);

            $this->SlotegratorGamesAccess->SaveRequestGameAccess(json_encode($requestParams), json_encode($headers), json_encode($response), $url);

            if ($mobile) {

                if (isset($response['url'])) {
                    return redirect($response['url']);
                }else {
                    return redirect()->route('index');
                }
                
                
            }else {
                
                if (isset($response['url'])) {
                    return view('pages.slotegrator')->with('url', $response['url']);
                }else {
                    return redirect()->route('index');
                }
                
            }

        } else {
            
            return redirect('/404');
            
        } 

    }

}
