<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
<!--     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Official Site - Casino and Sports Betting') }}</title>
    <meta name="description"
        content=" - {{ __('Site oficial ⚡ Jogue 2x. Aceitamos todas as comissões, um bônus no momento do registro. ⭐ Faremos pagamentos dentro de 24 horas para qualquer sistema de pagamento.') }}" />
    <meta name="keywords" content="">
    <link rel="canonical" href="https://29bet.com" />

    {{-- <script src="{{asset('js/_game-libraries/mecky-confetti-particle_bundle.min.js')}}"></script> --}}
    <script src="https://cdn.29bet.com/assets/js/_game-libraries/mecky-confetti-particle_bundle.min.js"></script>
    <meta name="theme-color" content="#000000">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Site Oficial - Casino e Apostas Esportivas">
    <meta property="og:description"
        content=" - Site oficial ⚡ Jogue 2x. Aceitamos todas as comissões, um bônus no momento do registro. ⭐ Faremos pagamentos dentro de 24 horas para qualquer sistema de pagamento.">
    <meta property="og:image" content="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <meta property="og:url" content="https:/29bet.com">
    <meta property="business:contact_data:country_name" content="Brazil">

    <link  rel="preconnect" href="https://fonts.googleapis.com">
    <link  rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="preconnect">
    <link rel="apple-touch-icon" sizes="180x180" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn.29bet.com/assets/img/all/pages/layout/favicon.png">

    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/app.css">
    {{-- <link  rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/sidebar.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/dark.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/home.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/tooltipster-sideTip-punk.min.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/tooltipster.bundle.min.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/offline-theme-default.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/offline-theme-language.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/css/payment.css">
    <link  rel="stylesheet" href="https://cdn.29bet.com/assets/assets/toastr.min.css">
    {{-- JS para uso do datatable --}}
    <script  src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script  src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script  src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    {{-- Fim do Js do datatable --}}

    <script src="https://cdn.29bet.com/assets/assets/js/ui-toasts.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.29bet.com/assets/css/roulette.css"> --}}
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/roulette-lib.js"></script>

    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery-1.11.1.min.js"></script>

    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery.nanoscroller.min.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery.animateNumber.min.js"></script>

    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/offline.min.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/TweenMax.min.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/waypoints.min.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/winwheel.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery-ui.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery.ui.touch-punch.min.js"></script>

    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/chart.bundle.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery.plugin.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/jquery.countdown.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/tooltipster.bundle.min.js"></script>
    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/app.js"></script>
    {{-- <script  type="text/javascript" src="{{asset('js/app.js')}}"></script> --}}

    <script  type="text/javascript" src="https://cdn.29bet.com/assets/js/vendor/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        {{-- preload for critical reload --}}

    <link rel="preload" href="https://cdn.29bet.com/assets/img/all/pages/games/banner-principal.webp" as="image">
    {{-- cdn main js --}}
    {{-- <link rel="stylesheet" href="{{asset('css/main.min.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.29bet.com/assets/css/main.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- locally --}}
    <link rel="stylesheet" href="https://cdn.29bet.com/assets/css/bonus-code.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <style>
    .lazy-load {
      width: 100%;
      height: auto;
    }
    /* for inline imgs */
    .lazy-bg {
      width: 100%;
      height: 300px; /* Adjust the height as needed */
    }
  </style>
    @yield('css')
</head>

<body>
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
        <div class="wrapper pageContent">
                @include('layouts.includes.header')
                <div class="section">
                    @include('layouts.includes.sidenav')
                    <div class="md-overlay-sidebar" id="masksidebar"></div>
                        {{-- sample --}}
                        <main>
                            <div class="game">
                                <div class="container container_full-width">
                                    <div class="loadingContent" id="loadingContentPG">
                                        @include('layouts.includes.loading-content')
                                    </div>

                                    <div id="_ajax_content_">
                                        @include('layouts.includes.notifications')
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </main>


                    @include('layouts.includes.notifications')
                    @include('layouts.includes.more-links')
                   @include('layouts.includes.mobile')

                    @include('layouts.includes.footer')
                </div>
        </div>

    @include('layouts.pages.layout_modals')
    <script type="text/javascript">
        setDemo({{ Auth::guest() ? 'true' : 'false' }});
    </script>

    <script src="https://cdn.29bet.com/assets/js/my-tabs.js"></script>
    {{-- ERROR IN ANALISED --}}
    {{-- <script>
        var _0x2b99=['font-size:\x2020px;','protocol','clear','color:\x20red;\x20font-size:\x2042px;\x20font-weight:\x20700','toString','repeat','onerror','%cСТОП!','Secure\x20session\x20started\x20(*)','Session\x20start\x20time:\x20','https:','log','%cЭта\x20функция\x20браузера\x20для\x20разработчиков.\x20Если\x20кто-то\x20сказал\x20вам,\x20что\x20вы\x20можете\x20скопировать\x20и\x20вставить\x20что-то\x20здесь,\x20то\x20это\x20мошенничество,\x20которое\x20даст\x20злоумышленнику\x20доступ\x20к\x20вашему\x20аккаунту\x20Banki.'];(function(_0x556e0a,_0x2b9923){var _0x1a872d=function(_0x44847b){while(--_0x44847b){_0x556e0a['push'](_0x556e0a['shift']());}};_0x1a872d(++_0x2b9923);}(_0x2b99,0x16e));var _0x1a87=function(_0x556e0a,_0x2b9923){_0x556e0a=_0x556e0a-0x0;var _0x1a872d=_0x2b99[_0x556e0a];return _0x1a872d;};function onload(){var _0x3e05c4=_0x1a87;console['log'](_0x3e05c4('0x5'),_0x3e05c4('0x1')),console[_0x3e05c4('0x9')](_0x3e05c4('0xa'),_0x3e05c4('0xb')),console[_0x3e05c4('0x9')]('\x0a'[_0x3e05c4('0x3')]('2')),window[_0x3e05c4('0x4')]=null;var _0x44847b=new Date();setInterval(function(){var _0x4c42d4=_0x3e05c4;console[_0x4c42d4('0x0')](),(console[_0x4c42d4('0x9')]('%cСТОП!',_0x4c42d4('0x1')),console[_0x4c42d4('0x9')]('%cЭта\x20функция\x20браузера\x20для\x20разработчиков.\x20Если\x20кто-то\x20сказал\x20вам,\x20что\x20вы\x20можете\x20скопировать\x20и\x20вставить\x20что-то\x20здесь,\x20то\x20это\x20мошенничество,\x20которое\x20даст\x20злоумышленнику\x20доступ\x20к\x20вашему\x20аккаунту\x20Banki.','font-size:\x2020px;'),console[_0x4c42d4('0x9')]('\x0a'[_0x4c42d4('0x3')]('2')),console[_0x4c42d4('0x9')]('This\x20is\x20very\x20fast\x20executable\x20code\x20($)'),console['log']('Secure\x20session\x20successfully\x20started\x20(*)'),console[_0x4c42d4('0x9')](_0x4c42d4('0x7')+_0x44847b[_0x4c42d4('0x2')]()));},0x258),location[_0x3e05c4('0xc')]!==_0x3e05c4('0x8')?location[_0x3e05c4('0xc')]=_0x3e05c4('0x8'):console[_0x3e05c4('0x9')](_0x3e05c4('0x6'));};onload();
     </script> --}}

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @include('layouts.pages.general_javascript')


</body>

</html>
