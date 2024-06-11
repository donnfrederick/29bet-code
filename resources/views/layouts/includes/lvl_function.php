@php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Ranks;
        use App\Models\Transactions;
        use App\Models\GameHistory;
        use Aws\S3\S3Client;
        use Aws\S3\Exception\S3Exception;
        use Dotenv\Dotenv;
        use Aws\Exception\AwsException;

    @endphp
    @php
        if (Auth::check()) {
            $uid = Auth::user()->uid;

            $rankss = Ranks::get();

            $ranks = [];

            foreach($rankss  as $rank){
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
<!--                     $result = $s3->getObject([
                        'Bucket' => $bucketName,
                        'Key' => $objectKey,
                    ]);

                    $badge = $result['@metadata']['effectiveUri']; -->
                }
                else{
                    $badge = '';
                }

                $ranks[] = [
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


            $totaldeposit = Transactions::where('uid', '=', $uid)->whereIn('action_id', [7, 26])->sum('amount');
            $totalbet = GameHistory::where('uid', '=', $uid)->sum('bet');

            $new_arry = [
                'total_deposit' => $totaldeposit,
                'total_bet' => $totalbet,
            ];

            $cnt = 0;

            foreach ($ranks as $rank) {
                // ($totalbet != 0) ? ($totaldeposit / $totalbet) * 100 : 0;
                if ($rank['total_deposits'] <= (int) $new_arry['total_deposit'] && (int) $rank['total_bets'] <= (int) $new_arry['total_bet']) {
                    if ($rank['total_deposits'] <= (int) $new_arry['total_deposit']) {
                        $percD = $rank['total_deposits'] != 0 ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        //$percD = 100;
                    } elseif ($rank['total_deposits'] >= (int) $new_arry['total_deposit']) {
                        //$p = (int)((int)$new_arry['total_deposit'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_deposit'] / 100 * 100);
                        $percB = $rank['total_deposits'] != 0 ? ((int) $new_arry['total_deposit'] / (int) $rank['total_deposits']) * 100 : 0;
                    } else {
                        $percD = 'sad';
                    }

                    if ($rank['total_bets'] <= (int) $new_arry['total_bet']) {
                        $percB = $rank['total_bets'] != 0 ? ((int) $rank['total_bets'] / (int) $new_arry['total_bet']) * 100 : 0;
                        // $percB = 100;
                    } elseif ($rank['total_bets'] >= (int) $new_arry['total_bet']) {
                        // $p = (int)((int)$new_arry['total_bet'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_bet'] / 100 * 100);
                        $percB = $rank['total_bets'] != 0 ? ((int) $new_arry['total_bet'] / (int) $rank['total_bets']) * 100 : 0;
                    } else {
                        $percB = 'sad';
                    }

                    $matchedRank[$cnt] = [
                        'level' => $rank['level'],
                        'bet' => $rank['total_bets'],
                        'deposit' => $rank['total_deposits'],
                        'current_bet' => (int) $new_arry['total_bet'],
                        'current_deposit' => (int) $new_arry['total_deposit'],
                        // "percentage_deposit" =>  ($rank['total_deposits'] != 0) ? ((int)$new_arry['total_deposit'] / $rank['total_deposits']) * 100 : 0,
                        // "percentage_bet" => ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / $rank['total_bets']) * 100 : 0,
                        'percentage_deposit' => number_format($percD, 2),
                        'percentage_bet' => number_format($percB, 2),
                        'rank_percentage' => round(((int) $rank['level'] / 10) * 100),
                        'image_lvl' => $rank['vip_level_badge'],
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
                    if ($rank['total_deposits'] <= (int) $new_arry['total_deposit']) {
                        $percD = $rank['total_deposits'] != 0 ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                        // $percD = 100;
                    } elseif ($rank['total_deposits'] >= (int) $new_arry['total_deposit']) {
                        // $p = (int)((int)$new_arry['total_deposit'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_deposit'] / 100 * 100);
                        // $percB = (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] *100;
                        $percD = $rank['total_deposits'] != 0 ? ((int) $new_arry['total_deposit'] / (int) $rank['total_deposits']) * 100 : 0;
                    } else {
                        $percD = 'sad';
                    }

                    if ($rank['total_bets'] <= (int) $new_arry['total_bet']) {
                        $percB = $rank['total_bets'] != 0 ? ((int) $rank['total_bets'] / (int) $new_arry['total_bet']) * 100 : 0;
                        // $percB = 100;
                    } elseif ($rank['total_bets'] >= (int) $new_arry['total_bet']) {
                        // $p = (int)((int)$new_arry['total_bet'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_bet'] / 100 * 100);
                        // $percB = (int)$new_arry['total_bet'] / (int)$rank['total_bets'] *100;
                        $percB = $rank['total_bets'] != 0 ? ((int) $new_arry['total_bet'] / (int) $rank['total_bets']) * 100 : 0;
                    } else {
                        $percB = 'sad';
                    }

                    $matchedRank[$cnt] = [
                        'level' => $rank['level'],
                        'bet' => $rank['total_bets'],
                        'deposit' => $rank['total_deposits'],
                        'current_bet' => (int) $new_arry['total_bet'],
                        'current_deposit' => (int) $new_arry['total_deposit'],
                        // "percentage_deposit" =>  ($rank['total_deposits'] != 0) ? ((int)$new_arry['total_deposit'] / $rank['total_deposits']) * 100 : 0,
                        // "percentage_bet" => ($rank['total_bets'] != 0) ? ((int)$new_arry['total_bet'] / $rank['total_bets']) * 100 : 0,
                        'percentage_deposit' => number_format($percD, 2),
                        'percentage_bet' => number_format($percB, 2),
                        'rank_percentage' => round(((int) $rank['level'] / 10) * 100),
                        'image_lvl' => $rank['vip_level_badge'],
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
        }
    @endphp
