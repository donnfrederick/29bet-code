<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::post('change-language/{locale}', [App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('changelanguage');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');
Route::get('/promotions', [App\Http\Controllers\HomeController::class, 'promotions'])->name('promotions');
Route::get('/promotions.events/id={id}', [App\Http\Controllers\HomeController::class, 'even_details'])->name('event_details');
Route::get('/promotions.event_details_page/id={id}', [App\Http\Controllers\HomeController::class, 'event_details_page'])->name('event_details_page');
Route::get('/code={referral_no}', [App\Http\Controllers\HomeController::class, 'referral_code'])->name('referral_code');

Route::get('/login/google', [App\Http\Controllers\Google\GoogleController::class, 'login'])->name('google-login');
Route::get('/auth/google/callback',[App\Http\Controllers\Google\GoogleController::class, 'loginwithGoogle'])->name('google-callback');

Route::get('/game/list', [App\Http\Controllers\HomeController::class, 'gamelist'])->name('gamelist');

//Route for safety deposit testing
Route::get('/testing/safety_balance/{amount}', [App\Http\Controllers\ControlBalanceController::class, 'transferToSafety'])->name('transferToSafety');

Route::group(['prefix' => '/', 'middleware' => 'throttle:360,1'], function() {
	/* routing games */
    Route::get('/game/crash/{wager}', [App\Http\Controllers\GeneralController::class, 'crash'])->name('game_crash');
    Route::get('/game/crash/tick/{id}', [App\Http\Controllers\GeneralController::class, 'crash_tick'])->name('game_crash_tick');
    Route::get('/game/crash/take/{id}', [App\Http\Controllers\GeneralController::class, 'crash_take'])->name('game_crash_take');
    Route::get('/game/wheel/{wager}/{color}', [App\Http\Controllers\GeneralController::class, 'wheel'])->name('game_wheel_api');
    Route::get('/game/dice/{wager}/{type}/{chance}', [App\Http\Controllers\GeneralController::class, 'dice'])->name('game_dice_api');
    Route::get('/game/hilo/take/{id}', [App\Http\Controllers\GeneralController::class, 'hilo_take'])->name('game_hilo_take');
    Route::get('/game/hilo/{wager}/{starting}', [App\Http\Controllers\GeneralController::class, 'hilo'])->name('game_hilo');
    Route::get('/game/hilo/flip/{id}/{type}', [App\Http\Controllers\GeneralController::class, 'hilo_flip'])->name('game_hilo_flip');
    Route::get('/game/keno/{pickedArray}/{wager}', [App\Http\Controllers\GeneralController::class, 'keno'])->name('game_keno');
    Route::get('/game/mines/mul/{bombs}', [App\Http\Controllers\GeneralController::class, 'mines_multiplier'])->name('game_mines_mul');
    Route::get('/game/mines/mine/{id}/{mine_id}', [App\Http\Controllers\GeneralController::class, 'mines_mine'])->name('game_mines_mine');
    Route::get('/game/mines/take/{id}', [App\Http\Controllers\GeneralController::class, 'mines_take'])->name('game_mines_take');
    Route::post('/game/mines', [App\Http\Controllers\GeneralController::class, 'mines'])->name('game_mines');
    Route::get('/game/plinko/multipliers', [App\Http\Controllers\GeneralController::class, 'plinkomultipliers'])->name('game_plinko_multiplier');
    Route::get('/game/plinko/{risk}/{pins}/{wager}', [App\Http\Controllers\GeneralController::class, 'plinko'])->name('game_plinko');
    Route::get('/game/roulette/{bets}', [App\Http\Controllers\GeneralController::class, 'roulette'])->name('game_roulette');
    Route::get('/game/stairs/mul/{bombs}', [App\Http\Controllers\GeneralController::class, 'stairs_multiplier'])->name('game_stairs_mul');
    Route::get('/game/stairs/open/{id}/{row_cell_id}', [App\Http\Controllers\GeneralController::class, 'stairs_open'])->name('game_stairs_open');
    Route::get('/game/stairs/take/{id}', [App\Http\Controllers\GeneralController::class, 'stairs_take'])->name('game_stairs_take');
    Route::get('/game/stairs/{wager}/{bombs}', [App\Http\Controllers\GeneralController::class, 'stairs'])->name('game_stairs');
    Route::get('/game/tower/mul/{bombs}', [App\Http\Controllers\GeneralController::class, 'tower_multiplier'])->name('game_tower_mul');
    Route::get('/game/tower/open/{id}/{row_cell_id}', [App\Http\Controllers\GeneralController::class, 'tower_open'])->name('game_tower_open');
    Route::get('/game/tower/take/{id}', [App\Http\Controllers\GeneralController::class, 'tower_take'])->name('game_tower_take');
    Route::get('/game/tower/{wager}/{bombs}', [App\Http\Controllers\GeneralController::class, 'tower'])->name('game_tower');
    Route::get('/game/blackjack/insure/{id}', [App\Http\Controllers\GeneralController::class, 'blackjack_insure'])->name('game_blackjack_insure');
    Route::get('/game/blackjack/double/{id}', [App\Http\Controllers\GeneralController::class, 'blackjack_double'])->name('game_blackjack_double');
    Route::get('/game/blackjack/score/{type}/{id}', [App\Http\Controllers\GeneralController::class, 'blackjack_score'])->name('game_blackjack_score');
    Route::get('/game/blackjack/stand/{id}', [App\Http\Controllers\GeneralController::class, 'blackjack_stand'])->name('game_blackjack_stand');
    Route::get('/game/blackjack/hit/{id}', [App\Http\Controllers\GeneralController::class, 'blackjack_hit'])->name('game_blackjack_hit');
    Route::get('/game/blackjack/{wager}', [App\Http\Controllers\GeneralController::class, 'blackjack'])->name('game_blackjack');
    Route::get('/game/coinflip/{wager}', [App\Http\Controllers\GeneralController::class, 'coinflip'])->name('game_coinflip');
    Route::get('/game/coinflip/flip/{id}/{side}', [App\Http\Controllers\GeneralController::class, 'coinflip_flip'])->name('game_coinflip_flip');
    Route::get('/game/coinflip/take/{id}', [App\Http\Controllers\GeneralController::class, 'coinflip_take'])->name('game_coinflip_take');
    /* Others */


    Route::get('/asyncBonus', [App\Http\Controllers\GeneralController::class, 'asyncBonus'])->name('async_bonuc');
});



Route::group(['middleware' => ['auth']], function () {

    Route::get('/referralcabinet', [App\Http\Controllers\HomeController::class, 'referralcabinet'])->name('referralcabinet');

    //games
    Route::get('/double', [App\Http\Controllers\GameController::class, 'double'])->name('double');
    Route::get('/crash', [App\Http\Controllers\GameController::class, 'crash'])->name('crash');
    Route::get('/dice', [App\Http\Controllers\GameController::class, 'dice'])->name('dice');
    Route::get('/hilo', [App\Http\Controllers\GameController::class, 'hilo'])->name('hilo');
    Route::get('/keno', [App\Http\Controllers\GameController::class, 'keno'])->name('keno');
    Route::get('/mines', [App\Http\Controllers\GameController::class, 'mines'])->name('mines');
    Route::get('/plinko', [App\Http\Controllers\GameController::class, 'plinko'])->name('plinko');
    Route::get('/roulette', [App\Http\Controllers\GameController::class, 'roulette'])->name('roulette');
    Route::get('/stairs', [App\Http\Controllers\GameController::class, 'stairs'])->name('stairs');
    Route::get('/tower', [App\Http\Controllers\GameController::class, 'tower'])->name('tower');
    Route::get('/blackjack', [App\Http\Controllers\GameController::class, 'blackjack'])->name('blackjack');
    Route::get('/coinflip', [App\Http\Controllers\GameController::class, 'coinflip'])->name('coinflip');
    //PG Games
    Route::get('/pg/{game_id}', [App\Http\Controllers\GameController::class, 'PGGames'])->name('PGGames');
    Route::get('/pgsoft/{game_id}', [App\Http\Controllers\GameController::class, 'PGSoftGames'])->name('PGSoftGames');

    //UAT TEST
    //Slotegrator
    
    Route::get('/slotegrator/{game_id}/{mobile}', [App\Http\Controllers\GameController::class, 'SlotegratorGames'])->name('SlotegratorGamesMobile');
    Route::get('/slotegrator/{game_id}', [App\Http\Controllers\GameController::class, 'SlotegratorGames'])->name('SlotegratorGames');

    Route::post('/deposit-money', [App\Http\Controllers\Wallet\WalletController::class, 'deposit'])->name('wallet');
    Route::post('/personal-center/vault', [App\Http\Controllers\Wallet\WalletController::class, 'postVerifyVault'])->name('set-password-vault');
    Route::post('/personal-center/verify-vault', [App\Http\Controllers\Wallet\WalletController::class, 'verifyVault'])->name('verify-vault');
    Route::get('/personal-center', [App\Http\Controllers\Wallet\WalletController::class, 'viewPersonalCenter'])->name('personal-center'); 
    Route::post('/personal-center/update-profile-image', [App\Http\Controllers\Wallet\WalletController::class, 'UpdateProfileImage'])->name('updateImage');
    Route::post('/personal-center/change-password-login', [App\Http\Controllers\Wallet\WalletController::class, 'changePasswordLogin'])->name('change-password-login');
    Route::get('/personal-center/vault/transfer', [App\Http\Controllers\Wallet\WalletController::class, 'viewTransfer'])->name('view-transfer');
    Route::post('/personal-center/vault/post-transfer', [App\Http\Controllers\Wallet\WalletController::class,'transferAgentBalance'])->name('transfer-agent-balance');
    Route::post('/personal-center/vault/transfer/safety-normal', [App\Http\Controllers\Wallet\WalletController::class,'transferSafetyNormal'])->name('transfer-safety-normal');
    Route::post('/personal-center/vault/change-password-transfer-balance', [App\Http\Controllers\Wallet\WalletController::class, 'changeTransferPassword'])->name('change-password-transfer-balance');
    Route::post('/referralcabinet/claim-level-achievement', [App\Http\Controllers\RewardController::class, 'getLevelAchievement'])->name('claim_reward');
    Route::post('/ranks/claim-vip-bonus',[App\Http\Controllers\RewardController::class, 'getLevelVIPBonus'])->name('claim_reward-vip');
    Route::get('/promo_bonus', [App\Http\Controllers\HomeController::class, 'promo_bonus'])->name('promo_bonus');
    Route::post('/post-google-registration', [App\Http\Controllers\HomeController::class, 'postgoogleregistration'])->name('post-google-registration');
    Route::post('/post-google-registration/google-registration', [App\Http\Controllers\Google\GoogleController::class, 'saveInformation'])->name('google-registration');

    Route::post('/post-comple-info/complete-reg', [App\Http\Controllers\Google\GoogleController::class, 'completeRegistration'])->name('complete-reg');
    
    Route::post('/personal-center/safe-box/' , [App\Http\Controllers\Wallet\WalletController::class, 'postVerifySafeBox'])->name('set-password-safebox');
    Route::post('/personal-center/verify-safe-box/', [App\Http\Controllers\Wallet\WalletController::class, 'verifySafeBox'])->name('verifySafeBox');
    //Payment Callback TodayPay API
    Route::match(['get', 'post'], '/controller/callback_check', [App\Http\Controllers\Wallet\WalletController::class, 'callback'])->name('callback');

    //User Info for Withdrawal
    Route::post('/info/account', [App\Http\Controllers\Wallet\WalletController::class, 'WithdrawalInfo'])->name('withdrawal_info');
    Route::post('/info/level', [App\Http\Controllers\Wallet\WalletController::class, 'LevelInfo'])->name('level_info');
    Route::post('/info/promo_recharge', [App\Http\Controllers\Wallet\WalletController::class, 'getPromoRecharge'])->name('getPromoRecharge');

    //Get All Bonus per User
    Route::get('/user_promo', [App\Http\Controllers\HomeController::class, 'getAllPromo'])->name('user_promo');
    Route::post('/claim-bonus', [App\Http\Controllers\HomeController::class, 'claim_bonus'])->name('claim_bonus');

    //Table Under PersonalCenter
    Route::post('/table/transaction', [App\Http\Controllers\Api\DataTableController::class, 'TransactionTable'])->name('transaction_table');
    Route::post('/table/registration_table', [App\Http\Controllers\Api\DataTableController::class, 'AccountRegistrationTable'])->name('registration_table');
    Route::post('/table/playhistory_table', [App\Http\Controllers\Api\DataTableController::class, 'PlayHistoryTable'])->name('playhistory_table');

    //Table Under ReferralCabinet
    Route::post('/tab/overview', [App\Http\Controllers\Api\DataTableController::class, 'OverviewTab'])->name('overview');
    Route::post('/table/commission', [App\Http\Controllers\Api\DataTableController::class, 'CommissionTable'])->name('commission');
    Route::post('/table/team_members', [App\Http\Controllers\Api\DataTableController::class, 'TeamMembersTable'])->name('team_members');
    Route::post('/table/recharge_record', [App\Http\Controllers\Api\DataTableController::class, 'RechargeRecordtable'])->name('recharge_record');

    //ranks
    Route::get('/ranks', [App\Http\Controllers\HomeController::class, 'ranks'])->name('ranks');

    //Notification
    Route::get('/get_notification', [App\Http\Controllers\ClearNotificationController::class, 'FetchNotification'])->name('FetchNotification');
    Route::post('/clear_notification', [App\Http\Controllers\ClearNotificationController::class, 'ClearNotification'])->name('ClearNotification');
    Route::post('/clear_all_notification', [App\Http\Controllers\ClearNotificationController::class, 'ClearAllNotification'])->name('ClearAllNotification');

    // Checking if Complete Information
    Route::post('/check_if_complete_info', [App\Http\Controllers\HomeController::class, 'checkIfCompleteInfo'])->name('check_if_complete_info');
});

Route::prefix('/')->name('site.')->group(function () {
    Route::get('/sports', [App\Http\Controllers\HomeController::class, 'sports'])->name('sports');
    Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
    Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
    Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
    Route::get('/allGames/{game_type}', [App\Http\Controllers\HomeController::class, 'allgames'])->name('allgames');

});

// PGSoft API for TEST Environment
Route::post('/api/testgame/VerifySession', [App\Http\Controllers\PGSoftController::class, 'ApiVerifySession'])->name('TestApiVerifySession');
Route::post('/api/testgame/Cash/Get', [App\Http\Controllers\PGSoftController::class, 'ApiCashGet'])->name('TestApiCashGet');
Route::post('/api/testgame/Cash/Transfer', [App\Http\Controllers\PGSoftController::class, 'ApiCashTransfer'])->name('TestApiCashTransfer');
Route::post('/api/testgame/Cash/Adjustment', [App\Http\Controllers\PGSoftController::class, 'ApiCashAdjustment'])->name('TestApiAdjustmentTestPrimera');

// PGSoft API for Production
Route::post('/api/pggame/VerifySession', [App\Http\Controllers\PGSoftController::class, 'ApiVerifySession'])->name('ApiVerifySession');
Route::post('/api/pggame/Cash/Get', [App\Http\Controllers\PGSoftController::class, 'ApiCashGet'])->name('ApiCashGet');
Route::post('/api/pggame/Cash/Transfer', [App\Http\Controllers\PGSoftController::class, 'ApiCashTransfer'])->name('ApiCashTransfer');
Route::post('/api/pggame/Cash/Adjustment', [App\Http\Controllers\PGSoftController::class, 'ApiCashAdjustment'])->name('ApiAdjustmentProdPrimera');

//Slotegrator API for Production
Route::post('/api/slotegrator/SlotegratorApi', [App\Http\Controllers\SlotegratorController::class, 'SlotegratorApi'])->name('SlotegratorApiRequest');
