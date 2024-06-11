<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sample', [App\Http\Controllers\HomeController::class, 'Sample'])->name('sample');

Route::group(['middleware' => ['auth']], function () {
    //Account Balance APIs
    Route::get('/balance/check', [App\Http\Controllers\Api\ControlBalanceController::class, 'Check'])->name('balance_check');
    Route::post('/balance/deduct', [App\Http\Controllers\Api\ControlBalanceController::class, 'Deduct'])->name('balance_deduct');
    Route::post('/balance/session/deduct', [App\Http\Controllers\Api\ControlBalanceController::class, 'SessionDeduct'])->name('balance_session_deduct');
    Route::put('/balance/add', [App\Http\Controllers\Api\ControlBalanceController::class, 'Add'])->name('balance_add');
    Route::put('/balance/session/add', [App\Http\Controllers\Api\ControlBalanceController::class, 'SessionAdd'])->name('balance_session_add');

    //Freespin
    Route::get('/freespin/spin', [App\Http\Controllers\Api\FreeSpinController::class, 'Spin'])->name('freespin_spin');
    Route::post('/freespin/win', [App\Http\Controllers\Api\FreeSpinController::class, 'Win'])->name('freespin_win');
    Route::get('/freespin/settings', [App\Http\Controllers\Api\FreeSpinController::class, 'Settings'])->name('freespin_settings');

    //Games APIs
    Route::post('/game/click/add/{game_id}', [App\Http\Controllers\Api\GameClickTrackerController::class, 'Add'])->name('game_click_record');

    //Games API dependencies
    Route::post('/crash/init', [App\Http\Controllers\Api\GameController::class, 'CrashConfig'])->name('ApiGamesCrashConfig');
    Route::post('/double/result', [App\Http\Controllers\Api\GameController::class, 'DoubleResult'])->name('ApiGamesDoubleResult');
    Route::post('/mines/init', [App\Http\Controllers\Api\GameController::class, 'MinesInit'])->name('ApiGamesMinesInit');
    Route::post('/tower/init', [App\Http\Controllers\Api\GameController::class, 'TowerInit'])->name('ApiGamesTowerInit');
    Route::post('/blackjack/init', [App\Http\Controllers\Api\GameController::class, 'BlackJackInit'])->name('ApiGamesBlackJackInit');
    Route::post('/stairs/init', [App\Http\Controllers\Api\GameController::class, 'StairsInit'])->name('ApiGamesStairsInit');
    Route::post('/blackjack/insure', [App\Http\Controllers\Api\GameController::class, 'BlackJackInsure'])->name("ApiGamesBlackJackInsure");
    Route::post('/blackjack/double', [App\Http\Controllers\Api\GameController::class, 'BlackJackDouble'])->name("ApiGamesBlackJackDouble");
    Route::post('/keno/result', [App\Http\Controllers\Api\GameController::class, 'KenoResult'])->name("ApiGamesKenoResult");
    Route::post('/plinko/init', [App\Http\Controllers\Api\GameController::class, 'PlinkoInit'])->name('ApiGamesPlinkoInit');
    Route::post('/dice/init', [App\Http\Controllers\Api\GameController::class, 'DiceInit'])->name('ApiGamesDiceInit');

    //pg
    Route::get('/pg/refresh/balance', [App\Http\Controllers\Api\GameController::class, 'PGRefreshBalance'])->name('ApiPGRefreshBalance');

    //general controller via XHR
    Route::post('/verify/token', [App\Http\Controllers\TokenController::class, 'Verify'])->name('ApiVerifyToken');

    //New DOUBLE & CRASH routes
    Route::post('/session/bets/get', [App\Http\Controllers\Api\GameController::class, 'DoubleGetBets'])->name('SessionDoubleGetBets');
    Route::post('/session/bet/get', [App\Http\Controllers\Api\GameController::class, 'DoubleGetBet'])->name('SessionDoubleGetBet');
    Route::post('/crash/session/bets/get', [App\Http\Controllers\Api\GameController::class, 'CrashGetBets'])->name('SessionCrashGetBets');
    Route::post('/crash/session/bet/get', [App\Http\Controllers\Api\GameController::class, 'CrashGetBet'])->name('SessionCrashGetBet');
    Route::get('/double/resultados', [App\Http\Controllers\Api\GameController::class, 'DoubleResultados'])->name('DoubleResultados');
    Route::get('/crash/resultados', [App\Http\Controllers\Api\GameController::class, 'CrashResultados'])->name('CrashResultados');
});
