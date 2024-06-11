<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ControlBalance;

class GameHistory extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'game_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'description',
        'result',
        'amount',
        'date_transacted',
        'uid',
        'operation_type',
        'bet',
        'provider',
        'order_number',
        'provider_transaction_id',
        'ghid',
        'session_id',
        'session_param'
    ];

    protected $primaryKey = 'uid';

    public function create($game_id, $description, $result, $amount, $uid, $operation_type, $bet, $provider = null, $order_number = null) {
        $GameHistory = new GameHistory();

        $GameHistory->game_id = $game_id;
        $GameHistory->description = $description;
        $GameHistory->result = $result;
        $GameHistory->amount = $amount;
        $GameHistory->uid = $uid;
        $GameHistory->operation_type = $operation_type;
        $GameHistory->bet = $bet;
        $GameHistory->date_transacted = now();
        $GameHistory->provider = $provider;
        $GameHistory->order_number = $order_number;

        if ($GameHistory->save()) {
            return $GameHistory->getKey();
        } else {
            return false;
        }
    }

    public function createWithSession($game_id, $description, $result, $amount, $uid, $operation_type, $bet, $provider, $order_number, $session_id, $session_param) {
        $GameHistory = new GameHistory();

        $GameHistory->game_id = $game_id;
        $GameHistory->description = $description;
        $GameHistory->result = $result;
        $GameHistory->amount = $amount;
        $GameHistory->uid = $uid;
        $GameHistory->operation_type = $operation_type;
        $GameHistory->bet = $bet;
        $GameHistory->date_transacted = now();
        $GameHistory->provider = $provider;
        $GameHistory->order_number = $order_number;
        $GameHistory->session_id = $session_id;
        $GameHistory->session_param = $session_param;

        if ($GameHistory->save()) {
            return $GameHistory->getKey();
        } else {
            return false;
        }
    }

    public function getPlayHistory($uid){
        //$try = '648b6f5aaff1f524';

        return GameHistory::where('uid','=',$uid)->get();
    }

    public function getPlayHistoryTable($uid, $date, $game_type){

        $frontDB = DB::connection('mysql');
        $backDB = DB::connection('db29betadmin');

        $query = $frontDB->table('game_history');
        $query->select('game_list.game_name',
        'action_types.action_description',
        'game_category.category_name',
        'game_history.amount',
        'game_history.bet',
        'game_history.date_transacted',
        'game_history.operation_type');
        $query->leftJoin('action_types', 'game_history.operation_type', '=', 'action_types.action_id');
        $query->leftJoin('db29betadmin.game_list', 'game_history.game_id', '=', 'game_list.game_id');
        $query->leftJoin('game_category', 'game_category.game_category_id', '=', 'game_list.game_category_id');

        switch ($date){

            case '1':
                $query->whereRaw('DATE(game_history.date_transacted) BETWEEN ? AND ?', [
                    now()->subDays(7)->toDateString(),
                    now()->toDateString()
                ]);
                break;
            case '2':
                $query->whereDate('game_history.date_transacted', now());
                break;
            case '3':
                $query->whereDate('game_history.date_transacted', now()->subDays(1));
                break;
            case '4':
                $query->whereMonth('game_history.date_transacted', now()->month);
                break;
            case '5':
                $query->whereYear('game_history.date_transacted', now()->year);
                break;

        }

        $query->where('game_history.uid', $uid);
        $query->whereIn('game_category.game_category_id', $game_type);
        // $query->where('game_category.game_category_id', $game_type);


        $query->orderBy('game_history.id', 'desc');

        return $query->get();

    }

    public function getWinHistory($uid = null) {
        if ($uid != null) return $this::where('uid', $uid)->where('operation_type', 10);
        else return $this::where('operation_type', 10);
    }

    public function getLoseHistory($uid = null) {
        if ($uid != null) return $this::where('uid', $uid)->where('operation_type', 11);
        else return $this::where('operation_type', 11);
    }

    public function getBets($uid = null) {
        if ($uid != null) return $this::where('uid', $uid);
        else return $this::select();
    }

    public function getGameHistory($id) {
        return $this::find($id);
    }

    public function SaveBetSlotegrator($data, $provider, $transaction_id){

        $game_history_id = $this->updateOrCreate(
            ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $data['round_id']],
            [
                'game_id' => $data['game_uuid'],
                'description' => "User has lose ".$data['amount'],
                'result' => 0,
                'amount' => 0,
                'bet' => $data['amount'],
                'date_transacted' => now(),
                'uid' => $data['player_id'],
                'operation_type' => 11,
                'provider' => $provider->game_provider,
                'order_number' => $data['round_id'],
                'provider_transaction_id' => $data['transaction_id'],
                'session_id' => $data['session_id'],
            ]
        );

        $ControlBalance = new ControlBalance();

        return $ControlBalance->SlotegratorDeductFunds(abs($data['amount']), $data['player_id'], $data['game_uuid'], $provider->game_provider, $game_history_id, $data['round_id'], $transaction_id);

    }

    public function SaveWinSlotegrator($data, $provider, $transaction_id){

        $game_history_id = $this->updateOrCreate(
            ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $data['round_id']],
            [
                'game_id' => $data['game_uuid'],
                'description' => "User has won ".$data['amount'],
                'result' => 1,
                'amount' => $data['amount'],
                'date_transacted' => now(),
                'uid' => $data['player_id'],
                'operation_type' => 10,
                'provider' => $provider->game_provider,
                'order_number' => $data['round_id'],
                'provider_transaction_id' => $data['transaction_id'],
                'session_id' => $data['session_id'],
            ]
        );

        $ControlBalance = new ControlBalance();

        return $ControlBalance->WinSlotegrator(abs($data['amount']), $data['player_id'], $data['game_uuid'], $provider->game_provider, $data['round_id'], $transaction_id);

    }

    public function SaveRefundSlotegrator($data, $provider, $transaction_id){

        if (isset($data['round_id'])) {

            $round_id = $data['round_id'];
            $game_history_id = $this->updateOrCreate(
                ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $data['round_id'], 'provider_transaction_id' => $data['bet_transaction_id']],
                [
                    'game_id' => $data['game_uuid'],
                    'description' => "System refunded the user with the amount of ".$data['amount'],
                    'result' => 1, 
                    'amount' => $data['amount'],
                    'date_transacted' => now(),
                    'uid' => $data['player_id'],
                    'operation_type' => 52,
                    'provider' => $provider->game_provider,
                    'order_number' => $data['round_id'],
                    'provider_transaction_id' => $data['transaction_id'],
                    'session_id' => $data['session_id'],
                ]
            );

        }else {

            $round_id = null;
            $game_history_id = $this->updateOrCreate(
                ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'provider_transaction_id' => $data['bet_transaction_id']],
                [
                    'game_id' => $data['game_uuid'],
                    'description' => "System refunded the user with the amount of ".$data['amount'],
                    'result' => 1, 
                    'amount' => $data['amount'],
                    'date_transacted' => now(),
                    'uid' => $data['player_id'],
                    'operation_type' => 52,
                    'provider' => $provider->game_provider,
                    'provider_transaction_id' => $data['transaction_id'],
                    'session_id' => $data['session_id'],
                ]
            );

        }

        $ControlBalance = new ControlBalance();

        return $ControlBalance->RefundSlotegrator(abs($data['amount']), $data['player_id'], $round_id, $transaction_id);

    }

    public function SaveInternalErrorGames($data, $provider, $transaction_id){

        $game_history_id = $this->updateOrCreate(
            ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $data['round_id']],
            [
                'game_id' => $data['game_uuid'],
                'description' => "Insufficient Funds Bet Amount: ".$data['amount'],
                'result' => 0,
                'amount' => 0,
                'bet' => $data['amount'],
                'date_transacted' => now(),
                'uid' => $data['player_id'],
                'operation_type' => 53,
                'provider' => $provider->game_provider,
                'order_number' => $data['round_id'],
                'provider_transaction_id' => $data['transaction_id'],
                'session_id' => $data['session_id'],
            ]
        );

        $ControlBalance = new ControlBalance();

        return $ControlBalance->ErrorInternalSlotegrator($data['player_id'], $data['round_id'], $transaction_id);

    }

    public function SaveBetRollbackSlotegrator($data, $provider, $transaction_id, $history, $amount){

        $game_history_id = $this->updateOrCreate(
            ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $history['round_id']],
            [
                'game_id' => $data['game_uuid'],
                'description' => "System rollback the whole round.",
                'result' => 0,
                'amount' => 0,
                'bet' => 0,
                'date_transacted' => now(),
                'uid' => $data['player_id'],
                'operation_type' => 54,
                'provider' => $provider->game_provider,
                'order_number' => $history['round_id'],
                'provider_transaction_id' => $history['transaction_id'],
                'session_id' => $data['session_id'],
            ]
        );

        $ControlBalance = new ControlBalance();

        return $ControlBalance->BetRollbackSlotegrator(abs($amount), $data['player_id'], $history['round_id'], $transaction_id);

    }

    public function SaveWinRollbackSlotegrator($data, $provider, $transaction_id, $history, $amount){

        $game_history_id = $this->updateOrCreate(
            ['game_id' => $data['game_uuid'], 'uid' => $data['player_id'], 'order_number' => $history['round_id']],
            [
                'game_id' => $data['game_uuid'],
                'description' => "System rollback the whole round.",
                'result' => 0,
                'amount' => 0,
                'bet' => 0,
                'date_transacted' => now(),
                'uid' => $data['player_id'],
                'operation_type' => 54,
                'provider' => $provider->game_provider,
                'order_number' => $history['round_id'],
                'provider_transaction_id' => $history['transaction_id'],
                'session_id' => $data['session_id'],
            ]
        );

        $ControlBalance = new ControlBalance();

        return $ControlBalance->WinRollbackSlotegrator(abs($amount), $data['player_id'], $data['game_uuid'], $provider->game_provider, $history['round_id'], $transaction_id);

    }

    public function FindProviderTransactionID($data, $round_id){

        $query = $this->where('uid', $data['player_id'])
        ->where('game_id', $data['game_uuid'])
        ->where('provider_transaction_id', $data['bet_transaction_id'])
        ->where('order_number', $round_id)
        ->first();

        return $query;
        
    }

    public function FindRoundID($round_id){

        $query = $this->where('order_number', $round_id)
        ->first();

        return $query;

    }

}
