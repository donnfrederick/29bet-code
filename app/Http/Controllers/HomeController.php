<?php

namespace App\Http\Controllers;

use App\Models\Admin\GameProvider;
use App\Models\Admin\GameList;
use App\Models\User;
use App\Models\User_Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\GameHistory as GameHistory;
use App\Models\Transactions as Transactions;
use App\Models\Ranks as Rank;
use App\Models\AgentReferralParams;
use App\Models\PromoCode as PromoCode;
use App\Models\LevelBonusAchievement as LevelBonusAchievement;
use App\Models\ActivityLog as ActivityLog;
use App\Models\ControlBalance as ControlBalance;
use App\Models\LevelAchievementBonus as LevelAchievementBonus;
use App\Models\User_Referral as User_Referral;
use App\Models\LevelVIPBonusClaimed as LevelVIPBonusClaimed;
use App\Models\PromotionDashboardSettings;
use App\Models\PromotionSettings;
use App\Models\Events;
use App\Models\EventsType;
use App\Models\PromotionDiscount;
use App\Models\ActionType;
use App\Models\Admin\DepositAndWithdrawalConfig;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Wallet\WalletController;
use App\Models\Ranks;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Aws\Exception\AwsException;
use Exception;
use Illuminate\Database\QueryException;

use App\Libraries\UserCountry;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    private $LevelAchievementBonus;
    private $User;
    private $User_Info;
    private $ActivityLog;
    private $PromotionSettings;
    private $LevelBonusAchievement;
    private $Events;
    private $EventsType;
    private $WithdrawalManagement;
    private $User_Referral;
    private $PromotionDiscount;
    private $WalletController;
    private $PromoCode;
    private $ActionType;
    private $PromotionDashboardSettings;
    private $Ranks;
    private $GameProvider;

    public function __construct(LevelAchievementBonus $LevelAchievementBonus, User $User, User_Info $User_Info, Events $Events, EventsType $EventsType, PromotionDashboardSettings $PromotionDashboardSettings, Ranks $Ranks)
    {

        $this->LevelBonusAchievement = $LevelAchievementBonus;
        $this->User = $User;
        $this->User_Info = $User_Info;
        $this->ActivityLog = new ActivityLog();
        $this->PromotionSettings = new PromotionSettings();
        $this->Events = $Events;
        $this->EventsType = $EventsType;
        $this->WithdrawalManagement = new DepositAndWithdrawalConfig();
        $this->User_Referral = new User_Referral();
        $this->PromotionDiscount = new PromotionDiscount();
        $this->WalletController = new WalletController();
        $this->PromoCode = new PromoCode();
        $this->ActionType = new ActionType();
        $this->PromotionDashboardSettings = $PromotionDashboardSettings;
        $this->Ranks = $Ranks;
        $this->GameProvider = new GameProvider();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function index(Request $request, $isLogin = false) {

        if (empty(Session::get('UserIPCountry'))) {
            $UserCountry = new UserCountry;
            $UserCountry->saveUserCountry($request);
        }

        $ip = $request->ip();
        $showLoader = !Session::has('page_loader_shown');
        if ($showLoader) {
            Session::put('page_loader_shown', true);
        }   
        $image_list = $this->PromotionDashboardSettings->pullAllBannersForDashboard();

        // $random_number = mt_rand(1000, 9999);
        // $hash = hash('sha256', (string) $random_number);
        // dd(json_decode($this->SlotegratorGameListPerPage(2), true));
        
        return view('layouts.pages.games', [
            'showLoader' => $showLoader,
            'isLogin' => $isLogin,
            'navs' => $this->getNavs(),
            'contents' => $this->getContents(), 
            'games_count' => count(GameList::select('id')->get()),
        ])->with('image_list', $image_list);
    }

    // public function getFooterSocialLogos(){ 
    //     // Load environment variables from .env file
    //     $dotenv = Dotenv::createImmutable(base_path());
    //     $dotenv->load();

    //     $bucketName = '29betbucket';
    //     $pathPrefix = 'uat-images/footer/';

    //     // Set your AWS credentials and region
    //     $credentials = [
    //         'key'    => config('filesystems.disks.s3.key'),
    //         'secret' => config('filesystems.disks.s3.secret'),
    //     ];

    //     $region = config('filesystems.disks.s3.region');

    //     $s3 = new S3Client([
    //         'version'     => 'latest',
    //         'region'      => $region,
    //         // 'profile' => 'default',
    //         'credentials' => [
    //             'key'    => $credentials['key'],
    //             'secret' => $credentials['secret'],
    //         ],
    //     ]);


    //     $objects = $s3->listObjectsV2([
    //         'Bucket' => $bucketName,
    //         'Prefix' => $pathPrefix,
    //     ]);

    //     $filteredObjects = array_slice($objects['Contents'], 1);

        
    //     return $filteredObjects;
    // }

    public function sports()
    {
        return view('pages.sports');
    }

    public function error404()
    {
       // return view('errors.404')->with('footer_socials', $this->getFooterSocialLogos());
        return view('errors.404');
    }

    public function allgames($game_provider)
    {   
        $GameList = new GameList();

        $games = [];

        if ($game_provider == "slots") {
            $games = $GameList->getGameByCategory(2)->get();
        } elseif ($game_provider == "fishing") {
            $games = $GameList->getGameByCategory(3)->get();
        } elseif ($game_provider == "live") {
            $games = $GameList->getGameByCategory(1)->get();
        }elseif ($game_provider == "51" || $game_provider == "4") {
            $games = $GameList->whereIn('game_provider', [51, 4])->orderBy('game_name')->get();
        }else {
            $games = $GameList->getGameByProvider($game_provider);
        }

        // foreach($games as $game){
        //     dd($game);
        // }
        return view('pages.allgames', [
            'game_provider' => $game_provider,
            'games' => $games,
        ]);
    }

    public function terms()
    {
       // return view('pages.terms')->with('footer_socials',  $this->getFooterSocialLogos());
        return view('pages.terms');
    }

    public function faq()
    {
       //return view('pages.faq')->with('footer_socials',  $this->getFooterSocialLogos());
        return view('pages.faq');
    }

    public function privacyPolicy()
    {
      //  return view('pages.policy')->with('footer_socials',  $this->getFooterSocialLogos());
        return view('pages.policy');
    }

    // public function Sample(Request $request)
    // {

        // $merchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
        // $headers1 = [
        // 'X-Merchant-Id' => 'e15e95d35bba81a98d6f53a6f55c9b87',
        // 'X-Timestamp' => time(),
        // 'X-Nonce' => md5(uniqid(mt_rand(), true)),
        // ];
        // $requestParams = [];
        // $mergedParams = array_merge($requestParams, $headers1);
        // ksort($mergedParams);
        // $hashString = http_build_query($mergedParams);
        // $XSign = hash_hmac('sha1', $hashString, $merchantKey);
        // $ch = curl_init();

        // $headers = array(
        //     'Content-Type: application/x-www-form-urlencoded',
        //     'X-Merchant-Id:'. $headers1["X-Merchant-Id"],
        //     'X-Timestamp:'.$headers1["X-Timestamp"],
        //     'X-Nonce:'.$headers1["X-Nonce"],
        //     'X-Sign:'.$XSign
        // );
        
        // curl_setopt_array($ch, [
        //     CURLOPT_URL => 'https://staging.slotegrator.com/api/index.php/v1/self-validate',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_HTTPHEADER => $headers,
        // ]);

        // // Execute cURL session and get the response
        // $response = curl_exec($ch);
        
        // // Check for cURL errors
        // if (curl_errno($ch)) {
        //     return 'Curl error: ' . curl_error($ch);
        // }
        
        // // Close cURL session
        // curl_close($ch);
        
        
        // dd(json_decode($response, true));

        // $result = $this->SlotegratorGameList();
        // dd($result);

        // $GameList = new GameList();
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $row = 2;
        // $arr_provider = [];

        // for ($i=80; $i <= 100; $i++) {

        //     $data = $this->SlotegratorGameListPerPage($i);
        //     $data = json_decode($data, true);
        //     $data = $data['items'];
        //     $not_exist = [];
        //     foreach ($data as $item) {
        //         if ($item['provider'] == "PragmaticPlayLive" && $item['type'] != "slots") {
        //             $not_exist[] = $item;
        //         }
                // $arr_provider = array_merge($arr_provider, $item['provider']);
            //     $game_provider = $this->GameProvider->getProviderByName($item['provider'])->first();
            //     if (($game_provider != null || $game_provider != "" ) && empty($not_exist)) {
            //         // if ($game_provider == null || $game_provider == "") {
            //         // array_push($arr_provider, $item['provider']);
            //         $GameList::updateOrCreate(
            //             ['game_id' => $item['uuid']],
            //             [
            //                 'game_name' => $item['name'],
            //                 'game_id' => $item['uuid'],
            //                 'game_origin' => 'API GAME',
            //                 'api_url' => 'https://uat.29bet.com/slotegrator/'.$item['uuid'],
            //                 'game_category_id' => 2,
            //                 'enable' => 1,
            //                 'game_provider' => $game_provider['id'],
            //                 'app_icon' => $item['image'],
            //                 'mobile_icon' => $item['image'],
            //                 'computers_icon' => $item['image'],
            //                 'sort' => 0
            //             ]
            //         );

            //     }elseif ($game_provider == null || $game_provider == "") {

            //         array_push($not_exist, $item['provider']);

            //     }

            //     // $sheet->setCellValue('B' . $row, $item['name']);
            //     // $sheet->setCellValue('C' . $row, $item['uuid']);
            //     // $sheet->setCellValue('D' . $row, 'API GAME');
            //     // $sheet->setCellValue('E' . $row, 'https://uat.29bet.com/'. strtolower($item['provider']). '/'.$item['uuid']);
            //     // $sheet->setCellValue('F' . $row, 2);
            //     // $sheet->setCellValue('G' . $row, 1);
            //     // $sheet->setCellValue('H' . $row, 000);
            //     // $sheet->setCellValue('I' . $row, $item['image']);
            //     // $sheet->setCellValue('J' . $row, $item['image']);
            //     // $sheet->setCellValue('K' . $row, $item['image']);
            //     // $sheet->setCellValue('L' . $row, 0);

            //     // $row++;

            // }

            // if (!empty($not_exist)) {

            //     dd($not_exist);

            // }

            // $arr_provider = array_unique($arr_provider);

        // }

        // dd($arr_provider);
        // Create a writer and save the spreadsheet
        // $writer = new Xlsx($spreadsheet);

        // // Set the appropriate headers for Excel file download
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="export.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer->save('php://output');
        

    // }

    //Counting the level of Agent based in their invites with a concept of pyramid
    //Saved for later if needed to calculate agent level of user
    
    // private function calculateUserLevel($referralData, $referral_id) {

    //     $directReferrals = collect($referralData)->filter(function ($item) use ($referral_id) {
    //         return $item->inviter === $referral_id;
    //     });

    //     $levelCounts = [];

    //     foreach ($directReferrals as $item) {
    //         $invitee = $item->invitee;
    //         $level = $this->calculateUserLevel($referralData, $invitee);

    //         if (!isset($levelCounts[$level])) {
    //             $levelCounts[$level] = 1;
    //         } else {
    //             $levelCounts[$level]++;
    //         }
    //     }

    //     $userLevel = 0;

    //     foreach ($levelCounts as $level => $count) {
    //         if ($count >= 2) {
    //             $userLevel = $level + 1;
    //         }
    //     }

    //     return $userLevel;

    // }

    public function user()
    {
        // return view('pages.user')->with('footer_socials',  $this->getFooterSocialLogos());
        return view('pages.user');
    }

    public function promotions()
    {   
        $id = '';
        $promotions = $this->Events->getEvents($id);
        $types = $this->EventsType->getEventType();
        // $footer_socials = $this->getFooterSocialLogos();
        return view('pages.promotions')->with('promotions', $promotions)->with('types', $types);
    }

    public function referralcabinet()
    {
        $uid = Auth::user()->uid;
        $user = new User();

        $ref_details = $user->select('referral_link', 'referral_no')
            ->where('uid', '=', $uid)
            ->first();

        $query = DB::table('user_referrals')
            ->select(DB::raw('COUNT(*) as guests'))
            ->join('users', 'user_referrals.users_id', '=', 'users.uid')
            ->join('transactions', 'user_referrals.users_id', '=', 'transactions.uid')
            ->whereIn('transactions.action_id', [7, 26])
            ->where('user_referrals.referral_id', '=', $ref_details['referral_no'])
            ->first();

        $agent_referral_lists = AgentReferralParams::get();
        $query_AchievementBonus = DB::table('agent_referral_params')
            ->select('referral_count','reward_value')
            ->orderBy('reward_value', 'ASC')
            ->get()
            ->take(9);

        $agent_referral_lists = AgentReferralParams::get();
        $level_achievement_bonus_claimed = LevelAchievementBonus::where('uid', Auth::user()->uid)->get();

        $invitation_Bonus = DB::table('transactions')
        ->selectRaw('
            SUM(CASE WHEN transactions.action_id IN (16) THEN transactions.amount ELSE 0 END ) AS total_invite_bonus,
            SUM(CASE WHEN transactions.action_id IN (16) THEN 1 ELSE 0 END ) AS count_invite_bonus
        ')
        ->first();

        if ($level_achievement_bonus_claimed->isEmpty()) {
            foreach ($agent_referral_lists as $lists) {
                $arr[$lists->referral_count] = $lists->reward_value;
            }

            $person =  $query->guests;

            //$person =  11;
            $result = array();

            foreach ($arr as $key => $value) {

                if ($key < $person) {

                    $previousKey = 0;
                    $remaining = $person - $previousKey;
                    $progress = (int)($remaining / $person * 100);
                    $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $key];
                } elseif ($key > $person) {

                    if (empty($result)) {

                        $previousKey = 0;
                        $remaining = $person - $previousKey;
                        $progress = (int)($remaining / $key * 100);
                        $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $remaining];
                    } else {

                        $previousKey = array_keys($result)[count($result) - 1];
                        $remaining = $person - $previousKey;
                        $progress = (int)($remaining / $key  * 100);

                        if ($remaining == 0) {
                            $progress = 100;
                        }

                        $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $remaining];

                        if ($remaining == 0) {
                            unset($result[$key]);
                        }
                    }
                    break;
                } elseif ($key == $person) {

                    $progress = 100;
                    $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $key];
                }
            }

            $invite_array = [];
            $invite_bonus_achievement =  $result;

            foreach ($agent_referral_lists as $invite => $invite_val) {

                foreach ($invite_bonus_achievement as $bonus => $bonus_val) {

                    if ($invite_val['referral_count'] == $bonus) {

                        $invite_array[$bonus] = [
                            "id" => $invite,
                            "reward_value" => $bonus_val['value'],
                            "description" => $invite_val['description'],
                            "person_count" => $bonus_val['label'],
                            "progress" => $bonus_val['progress'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                    }
                }
            }


            $bonus_array = [];

            $mergedArray = [];
            //$collection1 = $invite_array;
             $collection1 = collect($invite_array);


            foreach ($agent_referral_lists as $items) {


                $matchingItem = $collection1->first(function ($value, $key) use ($items) {

                    return $key == $items->referral_count;
                });


                if ($matchingItem) {

                    $items->status = 0;
                    $items->date_claimed = null;
                    $combinedAttributes = array_merge($matchingItem, $items->getAttributes());
                    $mergedArray[] = (object)$combinedAttributes;
                } else {
                    $originalAttributes = $items->getAttributes();
                    $originalAttributes['status'] = 0;
                    $originalAttributes['progress'] = 0;
                    $originalAttributes['link'] = null;
                    $originalAttributes['date_claimed'] = null;
                    $originalAttributes['person_count'] = 0;
                    $items->setRawAttributes($originalAttributes,true);
                    $mergedArray[] = $items;
                }
            }

            $bonus_array = $mergedArray;
            // dd($bonus_array);
            // $bonus_array = [];

            // foreach ($invite_array as $invitee_array => $invite_array_value) {

            //     /**
            //      * if no pulled data here
            //      */

            //     $bonus_array[$invitee_array] = [
            //         key($invite_array_value) => current($invite_array_value),
            //         'reward_value' => $invite_array_value['reward_value'],
            //         'description' => $invite_array_value['description'],
            //         'person_count' => $invite_array_value['person_count'],
            //         "progress" => $invite_array_value['progress'],
            //         "date_claimed" => null,
            //         "link" => $invite_array_value['link'],
            //         "status" => 0
            //     ];
            // }
            
            return view('pages.referralcabinet')->with(['referral_link' => $ref_details->referral_link, 'referral_no' => $ref_details->referral_no, 'agent_referral_lists' => $query_AchievementBonus,'agent_level_commission' => $agent_level_commission])->with('rewards', $bonus_array);
        } else {
            foreach ($agent_referral_lists as $lists) {
                $arr[$lists->referral_count] = $lists->reward_value;
            }
            //dd("asd");
            $person =  $query->guests;
            //$person =  11;
            $result = array();

            foreach ($arr as $key => $value) {

                if ($key < $person) {

                    $previousKey = 0;
                    $remaining = $person - $previousKey;
                    $progress = (int)($remaining / $person * 100);
                    $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $key];
                } elseif ($key > $person) {

                    if (empty($result)) {

                        $previousKey = 0;
                        $remaining = $person - $previousKey;
                        $progress = (int)($remaining / $key * 100);
                        $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $remaining];
                    } else {

                        $previousKey = array_keys($result)[count($result) - 1];
                        $remaining = $person - $previousKey;
                        $progress = (int)($remaining / $key  * 100);

                        if ($remaining == 0) {
                            $progress = 100;
                        }

                        $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $remaining];

                        if ($remaining == 0) {
                            unset($result[$key]);
                        }
                    }
                    break;
                } elseif ($key == $person) {

                    $progress = 100;
                    $result[$key] = ['value' => $value, 'progress' => $progress, 'label' => $key];
                }
            }

            $invite_array = [];
            $invite_bonus_achievement =  $result;

            foreach ($agent_referral_lists as $invite => $invite_val) {

                foreach ($invite_bonus_achievement as $bonus => $bonus_val) {

                    if ($invite_val['referral_count'] == $bonus) {

                        $invite_array[$bonus] = [
                            "id" => $invite,
                            "reward_value" => $bonus_val['value'],
                            "description" => $invite_val['description'],
                            "person_count" => $bonus_val['label'],
                            "progress" => $bonus_val['progress'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                    }
                }
            }

            $bonus_array = [];
            foreach ($invite_array as $invite_array => $invite_array_value) {
                foreach ($level_achievement_bonus_claimed as $bonus_claimed => $bonus_claim) {

                    if ($invite_array_value['reward_value'] == $bonus_claim['amount']) {

                        $bonus_array[$invite_array] = [
                            key($invite_array_value) => current($invite_array_value),
                            'reward_value' => $invite_array_value['reward_value'],
                            'description' => $invite_array_value['description'],
                            'person_count' => $invite_array_value['person_count'],
                            "progress" => $invite_array_value['progress'],
                            "date_claimed" => $bonus_claim['date_claimed'],
                            "link" => $invite_array_value['link'],
                            "status" => $bonus_claim['status']
                        ];
                        continue;
                    }
                    $bonus_array[$invite_array] = [
                        key($invite_array_value) => current($invite_array_value),
                        'reward_value' => $invite_array_value['reward_value'],
                        'description' => $invite_array_value['description'],
                        'person_count' => $invite_array_value['person_count'],
                        "progress" => $invite_array_value['progress'],
                        "date_claimed" => null,
                        "link" => $invite_array_value['link'],
                        "status" => 0
                    ];
                }
            }

            $mergedArray = [];

            $collection1 = collect($bonus_array);
          ;
            foreach ($agent_referral_lists as $items) {


                $matchingItem = $collection1->first(function ($value, $key) use ($items) {

                    return $key == $items->referral_count;
                });


                if ($matchingItem) {
                    $items->date_claimed = null;
                    $combinedAttributes = array_merge($matchingItem, $items->getAttributes());

                    $mergedArray[] = (object)$combinedAttributes;
                } else {

                    $originalAttributes = $items->getAttributes();
                    $originalAttributes['status'] = 0;
                    $originalAttributes['progress'] = 0;
                    $originalAttributes['link'] = null;
                    $originalAttributes['date_claimed'] = null;
                    $originalAttributes['person_count'] = 0;
                    $items->setRawAttributes($originalAttributes,true);
                    $mergedArray[] = $items;
                }
            }

            $bonus_array = $mergedArray;

            return view('pages.referralcabinet')->with(['referral_link' => $ref_details->referral_link, 'referral_no' => $ref_details->referral_no, 'agent_referral_lists' => $query_AchievementBonus, 'agent_level_commission' => $agent_level_commission])->with('rewards', $bonus_array);
        }
    }

    public function ranks()
    {
        if (Auth::check()) {
            $uid = Auth::user()->uid;

            // $ranks = Rank::get();
            $ranks = $this->Ranks->ranks();
            $totaldeposit = Transactions::where('uid', '=', $uid)->whereIn('action_id', [7, 26])->sum('amount');
            $totalbet = GameHistory::where('uid', '=', $uid)->sum('bet');

            $new_arry = [
                'total_deposit' => $totaldeposit,
                'total_bet' => $totalbet
            ];
            $cnt = 0;

            $level_vip_bonus_claimed = LevelVIPBonusClaimed::where('uid', Auth::user()->uid)->get();

            if ($level_vip_bonus_claimed->isEmpty()) {
                $matchedRank = [];
                $matched = [];
                foreach ($ranks as $rank) {
                    if ($rank['total_deposits'] <= (int)$new_arry['total_deposit'] && (int)$rank['total_bets'] <= (int)$new_arry['total_bet']) {
                        if ($rank['total_deposits'] <= (int)$new_arry['total_deposit']) {
                            $percD = ($rank['total_deposits'] != 0) ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        } elseif ($rank['total_deposits'] >= (int)$new_arry['total_deposit']) {

                            $percB = ($rank['total_deposits'] != 0) ? (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] * 100 : 0;
                        } else {
                            $percD = "sad";
                        }

                        if ($rank['total_bets'] <= (int)$new_arry['total_bet']) {
                            $percB = ($rank['total_bets'] != 0) ? ((int)$rank['total_bets'] / (int)$new_arry['total_bet']) * 100 : 0;
                        } elseif ($rank['total_bets'] >= (int)$new_arry['total_bet']) {

                            $percB = ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / (int)$rank['total_bets']) * 100 : 0;
                        } else {
                            $percB  = "sad";
                        }

                        $matchedRank[$cnt] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        $matched[] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        
                        continue;
                    } else {
                        if ($rank['total_deposits'] <= (int)$new_arry['total_deposit']) {

                            $percD = ($rank['total_deposits'] != 0) ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        } elseif ($rank['total_deposits'] >= (int)$new_arry['total_deposit']) {

                            $percB = ($rank['total_deposits'] != 0) ? (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] * 100 : 0;
                        } else {
                            $percD = "sad";
                        }

                        if ($rank['total_bets'] <= (int)$new_arry['total_bet']) {

                            $percB = ($rank['total_bets'] != 0) ? ((int)$rank['total_bets'] / (int)$new_arry['total_bet']) * 100 : 0;
                        } elseif ($rank['total_bets'] >= (int)$new_arry['total_bet']) {

                            $percB = ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / (int)$rank['total_bets']) * 100 : 0;
                        } else {
                            $percB  = "sad";
                        }

                        $matchedRank[$cnt] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        $matched[] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        break;
                    }
                    $cnt++;
                }

                $matchedRank = $matchedRank[0];

                if (count($matched) == 2) {
                    $matchedRank = $matched[0];
                } else {
                    $matchedRank;
                }
                $level_achievement = LevelBonusAchievement::where('level_requirement', '=', $matchedRank['level'])->first();
                $level_vip_list = LevelBonusAchievement::get();
                $bonus_array = [];
                // match the parameter data

                // Convert the arrays into objects
                // Initialize an empty array to store the merged result
                $mergedArray = [];
                // .

                // Convert the $level_vip_bonus_claimed array into a collection to make it easier to work with
                $collection1 = collect($level_vip_bonus_claimed);

                // Loop through the $level_vip_list

                foreach ($level_vip_list as $item) {
                    // Find the corresponding $level_vip_bonus_claimed item based on the 'level' and 'level_requirement' properties
                    $matchingItem = $collection1->first(function ($value) use ($item) {
                        return $value->level === $item->level_requirement;
                    });
                    // If a matching item is found, combine the attributes
                    if ($matchingItem) {
                        $item->claimable = true;
                        $combinedAttributes = array_merge($matchingItem->getAttributes(), $item->getAttributes());
                        $mergedArray[] = (object) $combinedAttributes;
                    } else {

                        // If no match is found, just add the $level_vip_list item as it is
                        $originalAttributes = $item->getOriginal();

                        $originalAttributes['status'] = 0;
                        $originalAttributes['claimable'] = false;

                        $item->setRawAttributes($originalAttributes, true);
                        $mergedArray[] = $item;
                    }
                }

                $bonus_array = $mergedArray;

                //dd($bonus_array);
                return view('pages.ranks')
                    ->with('rank_list', $matchedRank)
                    ->with('ranks', $ranks)
                    ->with('achievement', $level_achievement)
                    ->with('level_vip_list', $level_vip_list)
                    ->with('new_level_list', $bonus_array);
                    // ->with('footer_socials', $this->getFooterSocialLogos());
            } else {
                $matchedRank = [];
                $matched = [];

                foreach ($ranks as $rank) {
                    if ($rank['total_deposits'] <= (int)$new_arry['total_deposit'] && (int)$rank['total_bets'] <= (int)$new_arry['total_bet']) {
                        if ($rank['total_deposits'] <= (int)$new_arry['total_deposit']) {
                            $percD = ($rank['total_deposits'] != 0) ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        } elseif ($rank['total_deposits'] >= (int)$new_arry['total_deposit']) {

                            $percD = ($rank['total_deposits'] != 0) ? (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] * 100 : 0;
                        } else {
                            $percD = "sad";
                        }

                        if ($rank['total_bets'] <= (int)$new_arry['total_bet']) {
                            $percB = ($rank['total_bets'] != 0) ? ((int)$rank['total_bets'] / (int)$new_arry['total_bet']) * 100 : 0;
                        } elseif ($rank['total_bets'] >= (int)$new_arry['total_bet']) {
                            $percB = ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / (int)$rank['total_bets']) * 100 : 0;
                        } else {
                            $percB  = "sad";
                        }   
                
                        $matchedRank[$cnt] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        $matched[] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        continue;
                    } else {
                        if ($rank['total_deposits'] <= (int)$new_arry['total_deposit']) {
                            $percD = ($rank['total_deposits'] != 0) ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        } elseif ($rank['total_deposits'] >= (int)$new_arry['total_deposit']) {
                            $percD = ($rank['total_deposits'] != 0) ? (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] * 100 : 0;
                        } else {
                            $percD = "sad";
                        }

                        if ($rank['total_bets'] <= (int)$new_arry['total_bet']) {
                            $percB = ($rank['total_bets'] != 0) ? ((int)$rank['total_bets'] / (int)$new_arry['total_bet']) * 100 : 0;
                        } elseif ($rank['total_bets'] >= (int)$new_arry['total_bet']) {
                            $percB = ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / (int)$rank['total_bets']) * 100 : 0;
                        } else {
                            $percB  = "sad";
                        }


                        $matchedRank[$cnt] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        $matched[] = [
                            "level" => $rank['level'],
                            "bet" => $rank['total_bets'],
                            "deposit" => $rank['total_deposits'],
                            "current_bet" => (int)$new_arry['total_bet'],
                            "current_deposit" => (int)$new_arry['total_deposit'],
                            "percentage_deposit" => number_format($percD, 2),
                            "percentage_bet" => number_format($percB, 2),
                            "rank_percentage" => round((int)$rank['level'] / 10 * 100),
                            "image_lvl" => $rank['vip_level_badge'],
                            "link" =>  $_SERVER['HTTP_HOST'] . "/claim-code="
                        ];
                        break;
                    }
                    $cnt++;
                }

                $matchedRank = $matchedRank[0];
     
                if (count($matched) == 2) {
                    $matchedRank = $matched[0];
                } else {
                    $matchedRank;
                }
                

                // $level_vip_bonus_claimed

                $level_achievement = LevelBonusAchievement::where('level_requirement', '=', $matchedRank['level'])->first();
                $level_vip_list = LevelBonusAchievement::get();

                $bonus_array = [];
                // match the parameter data

                // Convert the arrays into objects
                // Initialize an empty array to store the merged result
                $mergedArray = [];

                // Convert the $level_vip_bonus_claimed array into a collection to make it easier to work with
                $collection1 = collect($level_vip_bonus_claimed);

                // Loop through the $level_vip_list

                foreach ($level_vip_list as $item) {
                    // Find the corresponding $level_vip_bonus_claimed item based on the 'level' and 'level_requirement' properties
                    $matchingItem = $collection1->first(function ($value) use ($item) {
                        return $value->level === $item->level_requirement;
                    });

                    // If a matching item is found, combine the attributes
                    if ($matchingItem) {
                        $item->claimable = true;
                        $combinedAttributes = array_merge($matchingItem->getAttributes(), $item->getAttributes());
                        $mergedArray[] = (object) $combinedAttributes;
                    } else {

                        // If no match is found, just add the $level_vip_list item as it is
                        $originalAttributes = $item->getOriginal();

                        $originalAttributes['status'] = 0;
                        $originalAttributes['claimable'] = false;

                        $item->setRawAttributes($originalAttributes, true);
                        $mergedArray[] = $item;
                    }
                }
                $bonus_array = $mergedArray;
            }

            return view('pages.ranks')
                ->with('rank_list', $matchedRank)
                ->with('ranks', $ranks)
                ->with('achievement', $level_achievement)
                ->with('level_vip_list', $level_vip_list)
                ->with('new_level_list', $bonus_array);
                // ->with('footer_socials', $this->getFooterSocialLogos());
        } else {
            $ranks = Rank::get();
            return view('pages.ranks')
                ->with('ranks', $ranks);
                // ->with('footer_socials', $this->getFooterSocialLogos());
        }
    }

    public function referral_code(Request $request, $referral_no, $isLogin = false)
    {

        $showLoader = !Session::has('page_loader_shown');
        if ($showLoader) {
            Session::put('page_loader_shown', true);
        }

        $GameProvider = new GameProvider();

        $User = new User();
        $rows = $User->where('referral_no', $referral_no)->count();
        $GameList = new GameList();

        // $image_list = PromotionDashboardSettings::where('display_to', '=', 'Banner')->where('status', '=', '1')->get();
        $image_list = Events::where('display_to','=','Banner')
        ->where('display_status','=','Yes')
        ->get();
        // dd($image_list);

        if ($rows > 0) {

            return view('layouts.pages.games', [
                'showLoader' => $showLoader,
                'isLogin' => $isLogin,
                'navs' => $this->getNavs(),
                'contents' => $this->getContents(),
                'games_count' => count(GameList::select('id')->get()),
                // 'footer_socials' => $this->getFooterSocialLogos()
            ])->with('referral_code', $referral_no ?? '')->with('games', $GameList->getOGGames());
        } else {

            return redirect()
                ->route('index')
                // ->with('footer_socials', $this->getFooterSocialLogos())
                ->withErrors([
                    'error_header' => 'Link de referência não encontrado',
                    'error_message' => 'O Link de Referência que você deseja usar não foi encontrado ou não existe'
                ]);
        }
    }




    // public function referral_failed() {
    // }

    public function promo_bonus()
    {

        // return view('pages.bonus')->with('footer_socials',  $this->getFooterSocialLogos());
        return view('pages.bonus');
    }

    public function getAllPromo(Request $request)
    {

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->bearerToken()) {

                $uid = Auth::user()->uid;
                $PromoCode = new PromoCode();
                $promo = $PromoCode->getAllPromo($uid);

                return response()->json($promo);
            } else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);
            }
        }
    }

    public function claim_bonus(Request $request)
    {
        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {

                $uid = Auth::user()->uid;
                $promo_rule_id = $request->input('promo_rule_id');
                $promo_code = $request->input('promo_code');
                $PromoCode = new PromoCode();
                $promo_details = $PromoCode->getPromoDetails($uid, $promo_code, $promo_rule_id);
                $withdrawal_mangement = $this->WithdrawalManagement->getWithdrawalManagement();
                $rollover_multiplier = $withdrawal_mangement['rollover_multiplier'];

                if ($promo_details) {

                    if ($promo_details->status < 1 && $promo_details->available_times_to_claim > 0) {

                        if ($promo_details->times_received >= $promo_details->available_times_to_claim) {

                            return response()
                                ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is already Max out!')]);
                        }

                        $times_received = $promo_details->times_received + 1;

                        if ($times_received == $promo_details->available_times_to_claim) {

                            $status = 1;
                        } else {

                            $status = 0;
                        }

                        $updateData = [
                            'uid' => $uid,
                            'promo_code' => $promo_code,
                            'times_received' => $times_received,
                            'status' => $status
                        ];

                        $promo = $PromoCode->updateStatus($updateData);

                        if ($promo) {

                            $ControlBalance = new ControlBalance();
                            $query = $ControlBalance->getBalance($uid);
                            $new_balance = $query['control_balance'] + $promo_details->amount;
                            $Transaction = new PromotionDiscount();
                            $trans_id = $this->WalletController->TransactionID();
                            $PromotionDescription = $this->PromoCode->getPromoCodeAndSettings($promo_code);

                            $Transaction::updateOrCreate(
                                ['uid' => $uid, 'transaction_id' => $trans_id, 'promo_code' => $promo_code],
                                [
                                    'uid' => $uid,
                                    'transaction_id' => $trans_id,
                                    'promo_code_id' => $PromotionDescription->promotion_id,
                                    'promotion_name' => $PromotionDescription->name,
                                    'promo_code' => $promo_code,
                                    'event_start' => $PromotionDescription->event_start_time,
                                    'event_end' => $PromotionDescription->event_end_time,
                                    'before_balance' => $query->control_balance,
                                    'amount' => $promo_details->amount,
                                    'new_amount' => $new_balance,
                                    'balance_type_id' => 3,
                                    'description' => "User claim promo code: " . $promo_code,
                                    'for_user_remarks' => "User claim promo code: " . $promo_code,
                                    'system_remarks' => "Successful Claim Promo Code",
                                    'action_id' => 15,
                                    'transaction_type' => $this->ActionType->getActionDescription(15),
                                    'claim_ip' => Auth::user()->registration_ip,
                                    'created_at' => now(),
                                ]
                            );

                            $new_rollover = ($promo_details->amount * $rollover_multiplier) + $query['rollover_balance'];
                            $ControlBalance->updateDiscountBalance($uid, $query['discount_balance'] + $promo_details->amount, $new_rollover);

                            $desc = "User Claim Promotion with Promo Code of " . $promo_code;
                            $this->ActivityLog->saveLogs($desc, $request->ip(), $uid, now(), 15, $request->getHost(), $request->header('User-Agent'));

                            return response()->json(['status' => true, 'error' => '', 'success_message' => __("You successfully claim the bonus."), 'new_balance' => $new_balance]);
                        } else {

                            return response()->json(['status' => false, 'error' => 'Fail', 'error_message' => __("Error Claiming The Reward")]);
                        }
                    } else {

                        return response()
                            ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is already Claimed!')]);
                    }
                } else {

                    $check_promo = $PromoCode->checkPromo($uid, $promo_code, $promo_rule_id);

                    if ($check_promo > 0) {

                        //No Condition Promo Code Only Update Discount Balance
                        $promo_details = $PromoCode->DetailsPromoCode($uid, $promo_code, $promo_rule_id);

                        if ($promo_details) {

                            if ($promo_details->times_received >= $promo_details->available_times_to_claim) {

                                return response()
                                    ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is already Max out!')]);
                            }

                            if ($promo_details->status < 1 && $promo_details->available_times_to_claim > 0) {

                                $times_received = $promo_details->times_received + 1;

                                if ($times_received == $promo_details->available_times_to_claim) {

                                    $status = 1;
                                } else {

                                    $status = 0;
                                }

                                $updateData = [
                                    'uid' => $uid,
                                    'promo_code' => $promo_code,
                                    'times_received' => $times_received,
                                    'status' => $status
                                ];

                                $promo = $PromoCode->updateStatus($updateData);

                                if ($promo) {

                                    $ControlBalance = new ControlBalance();
                                    $query = $ControlBalance->getBalance($uid);

                                    $Transaction = new PromotionDiscount();
                                    $trans_id = $this->WalletController->TransactionID();
                                    $PromotionDescription = $this->PromoCode->getPromoCodeAndSettings($promo_code);
                                    
                                    $Transaction::updateOrCreate(
                                        ['uid' => $uid, 'transaction_id' => $trans_id, 'promo_code' => $promo_code],
                                        [
                                            'uid' => $uid,
                                            'transaction_id' => $trans_id,
                                            'promo_code_id' => $PromotionDescription->promotion_id,
                                            'promotion_name' => $PromotionDescription->name,
                                            'promo_code' => $promo_code,
                                            'event_start' => $PromotionDescription->event_start_time,
                                            'event_end' => $PromotionDescription->event_end_time,
                                            'before_balance' => $query->control_balance,
                                            'amount' => $promo_details->amount,
                                            'new_amount' => $query->control_balance + $promo_details->amount,
                                            'balance_type_id' => 3,
                                            'description' => "User claim promo code: " . $promo_code,
                                            'for_user_remarks' => "User claim promo code: " . $promo_code,
                                            'system_remarks' => "Successful Claim Promo Code",
                                            'action_id' => 15,
                                            'transaction_type' => $this->ActionType->getActionDescription(15),
                                            'claim_ip' => Auth::user()->registration_ip,
                                            'created_at' => now()
                                        ]
                                    );

                                    $new_rollover = ($promo_details->amount * $rollover_multiplier) + $query['rollover_balance'];
                                    $ControlBalance->updateDiscountBalance($uid, $query['discount_balance'] + $promo_details->amount, $new_rollover);

                                    $desc = "User Claim Promotion with Promo Code of " . $promo_code;
                                    $this->ActivityLog->saveLogs($desc, $request->ip(), $uid, now(), 15, $request->getHost(), $request->header('User-Agent'));

                                    return response()->json(['status' => true, 'error' => '', 'success_message' => __("You successfully claim the bonus."), 'new_balance' => $query->control_balance + $promo_details->amount]);
                                } else {

                                    return response()->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Error Claiming The Reward')]);
                                }
                            } else {

                                return response()
                                    ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is already Claimed!')]);
                            }
                        } else {

                            //UID, PROMO CODE, PROMO RULE ID is not exist
                            return response()
                                ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is not longer Existed or Available!')]);
                        }
                    } else {

                        //UID, PROMO CODE, PROMO RULE ID is not exist
                        return response()
                            ->json(['status' => false, 'error' => 'Fail', 'error_message' => __('Promo Code is not longer Available or Existed!')]);
                    }

                }

            } else {

                return response()->json(['status' => false, 'error' => __('Unauthenticated')]);
                
            }

        }

    }

    public function checkIfCompleteInfo(Request $request){
        $userDetails = $this->User_Info->getUserDetails(Auth::user()->uid);
        if(empty($userDetails->number_id) || empty($userDetails->email)){
            return '1';
        }
        else{
            return '0';
        }
    }

    public function postgoogleregistration(Request $request)
    {
        if ($request->ajax()) {

            if ($this->User->pullApiToken() == $request->input('_token')) {

                if ($this->User->checkIsGoogle()) {

                    $userDetails = $this->User_Info->getUserDetails(Auth::user()->uid);
                    $UserReferral = $this->User_Referral->getUserReferral(Auth::user()->uid);
                    
                    $data = [
                        "number_type_id" => $userDetails->number_type_id,
                        "number_id" => $userDetails->number_id,
                        "contact_address" => $userDetails->contact_address,
                        "area_code" => $userDetails->area_code,
                        "mobile_number" => $userDetails->mobile_number,
                        "email" => $userDetails->email,
                        "facebook" => $userDetails->facebook,
                        "google" => $userDetails->google,
                        "twitter" => $userDetails->twitter,
                        "line" => $userDetails->line,
                        "qq" => $userDetails->qq,
                        "wechat" => $userDetails->wechat
                    ];

                    if (is_null($userDetails->number_id) || is_null($userDetails->mobile_number)) {

                        return response()->json([
                            'code' => '1',
                            'message' => __('Continue Register'),
                            'contents' => json_encode($data),
                            'referral_id' => $UserReferral['referral_id']
                        ], 200);
                    } else {
                        return response()->json([
                            'error' => 'OK',
                            'message' => __('Connection Success')
                        ], 200);
                    }
                } else {

                    return response()->json([
                        'error' => 'OK',
                        'message' => __('Connection Success')
                    ], 200);
                }
            } else {
                return response()->json([
                    'error' => __('Bad Request'),
                    'message' => __('Unauthorized')
                ], 401);
            }
        }
    }

    private function getNavs() {
        $GameList = new GameList();
        $GameProvider = new GameProvider();

        // Static nav (OG)
        $og_games = $GameList->getGameByOrigin("Original Game");
        $collect_og = collect($og_games);
        $game_provider = $GameProvider::find($collect_og->first()['game_provider']);

        $navs = [
            [
                $game_provider->id,
                "Internal",
                str_replace(' ', '_', strtolower($game_provider->game_provider_name)),
                "https://cdn.29bet.com/assets/img/all/pages/games/interno.webp"
            ]
        ];

        // $providernavs = [
        //     [
        //         null,
        //         "Providers",
        //         "providers",
        //         "https://cdn.29bet.com/assets/img/all/pages/games/provider.webp"
        //     ]
        // ];
       
        // $navs = array_merge($navs , $providernavs);
       
        $navs[] = [
            null,
            "Slots",
            "slots",
            "https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"
        ];

        $navs[] = [
            null,
            "Pescaria",
            "fishing",
            "https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"
        ];

        $navs[] = [
            null,
            "Live",
            "live",
            "https://cdn.29bet.com/assets/img/all/pages/games/slots.webp"
        ];

        return $navs;
    }

    private function getContents() {
        $GameList = new GameList();
        $GameProvider = new GameProvider();
        
        // Static nav (OG)
        $og_games = $GameList->getGameByOrigin("Original Game");
        $collect_og = collect($og_games);

        $game_provider = $GameProvider::find($collect_og->first()['game_provider']);

        $contents = [
            "internal" => [
                $game_provider->id,
                "Internal",
                str_replace(' ', '_', strtolower($game_provider->game_provider_name)),
                $game_provider->games(),
                $collect_og
            ],
            "providers" => [],
            "slots" => [
                null,
                "Slots",
                "slots",
                $GameList->getGameByCategory(2)
            ],
            "fishing" => [
                null,
                "Pescaria",
                "fishing",
                $GameList->getGameByCategory(3)
            ],
            "live" => [
                null,
                "Live",
                "live",
                $GameList->getGameByCategory(1)
            ],
        ];

        foreach ($GameProvider->getAll() as $provider) {
            if ($provider->id !== 4 && $provider->id !== 51) {

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

                if(!empty($provider->provider_icon)){
                    // $objectKey = "uat-images/providers/".$provider->provider_icon;    
                    // $result = $s3->getObject([
                    //     'Bucket' => $bucketName,
                    //     'Key' => $objectKey,
                    // ]);
    
                    // $icon = $result['@metadata']['effectiveUri'];

                    $icon = "https://cdn.29bet.com/uat-images/providers/".$provider->provider_icon;    
                }
                else{
                    $icon = '';
                }

                if(!empty($provider->provider_small_icon)){
                    // $objectKey_app = "uat-images/providers/".$provider->provider_small_icon;    
    
                    // $result = $s3->getObject([
                    //     'Bucket' => $bucketName,
                    //     'Key' => $objectKey_app,
                    // ]);
    
                    // $icon_small = $result['@metadata']['effectiveUri'];

                    $icon_small = "https://cdn.29bet.com/uat-images/providers/".$provider->provider_small_icon;   
                }
                else{
                    $icon_small = '';
                }


                array_push($contents['providers'], [
                    $provider->id,
                    $provider->game_provider_name,
                    str_replace(' ', '_', strtolower($provider->game_provider_name)),
                    $provider->games(),
                    $icon
                    
                ]);
            }
        }
        
        return $contents;
    }

    private function SlotegratorGameList(){

        $merchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
        $headers1 = [
        'X-Merchant-Id' => 'e15e95d35bba81a98d6f53a6f55c9b87',
        'X-Timestamp' => time(),
        'X-Nonce' => md5(uniqid(mt_rand(), true)),
        ];
        $requestParams = [];
        $mergedParams = array_merge($requestParams, $headers1);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);
        $BodyParameters = http_build_query($requestParams);
        $XSign = hash_hmac('sha1', $hashString, $merchantKey);

        $ch = curl_init();
        
        // Set cURL options
        // curl_setopt($ch, CURLOPT_URL, 'https://staging.slotegrator.com/api/index.php/v1/games?'. $BodyParameters); // Set the URL
        curl_setopt($ch, CURLOPT_URL, 'https://staging.slotegrator.com/api/index.php/v1/limits'); // Set the URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Set to true if the server's SSL certificate should be verified

        // Set custom headers
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'X-Merchant-Id:'. $headers1["X-Merchant-Id"],
            'X-Timestamp:'.$headers1["X-Timestamp"],
            'X-Nonce:'.$headers1["X-Nonce"],
            'X-Sign:'.$XSign
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Execute cURL session and get the response
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        
        // Close cURL session
        curl_close($ch);
        
        // Process the response
        return $response;

    }

    private function SlotegratorGameListPerPage($page){
        try { 
            $merchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
            $headers1 = [
            'X-Merchant-Id' => 'e15e95d35bba81a98d6f53a6f55c9b87',
            'X-Timestamp' => time(),
            'X-Nonce' => md5(uniqid(mt_rand(), true)),
            ];
            $requestParams = [
            'expand' => 'images,tags HTTP/1.1',
            'page' => $page,
            ];
            $mergedParams = array_merge($requestParams, $headers1);
            ksort($mergedParams);
            $hashString = http_build_query($mergedParams);
            $BodyParameters = http_build_query($requestParams);
            $XSign = hash_hmac('sha1', $hashString, $merchantKey);
    
            $ch = curl_init();
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, 'https://staging.slotegrator.com/api/index.php/v1/games/index?'.$BodyParameters); // Set the URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response instead of outputting it
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Set to true if the server's SSL certificate should be verified
    
            // Set custom headers
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
                'X-Merchant-Id:'. $headers1["X-Merchant-Id"],
                'X-Timestamp:'.$headers1["X-Timestamp"],
                'X-Nonce:'.$headers1["X-Nonce"],
                'X-Sign:'.$XSign
            );
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            // Execute cURL session and get the response
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            
            // Close cURL session
            curl_close($ch);
            // Process the response
            return $response;
    
        } catch (Exception $e) {
            dd($e, $page);
        }

    }

    private function SelfValidation(){

        
        $merchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
        $headers1 = [
        'X-Merchant-Id' => 'e15e95d35bba81a98d6f53a6f55c9b87',
        'X-Timestamp' => time(),
        'X-Nonce' => md5(uniqid(mt_rand(), true)),
        ];
        $requestParams = [];
        $mergedParams = array_merge($requestParams, $headers1);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);
        $XSign = hash_hmac('sha1', $hashString, $merchantKey);
        
        $ch = curl_init();

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'X-Merchant-Id:'. $headers1["X-Merchant-Id"],
            'X-Timestamp:'.$headers1["X-Timestamp"],
            'X-Nonce:'.$headers1["X-Nonce"],
            'X-Sign:'.$XSign
        );
        
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://staging.slotegrator.com/api/index.php/v1/self-validate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headers,
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            return 'Curl error: ' . curl_error($ch);
        }
        
        // Close cURL session
        curl_close($ch);
        // Process the response
        return $response;
        
    }
    public function even_details ($id){
        $promotions = $this->Events->getEvents($id);
        $types = $this->EventsType->getEventType();

        return view('pages.promotions')->with('types', $types)->with('promotions',$promotions)->with('id', $id);
    }

    public function event_details_page($id){
        $promotions = $this->Events->getEvents($id);

        return view('pages.promotionsdetails')->with('promotion_details', $promotions[0]);
    }
}

