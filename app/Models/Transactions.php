<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ActionType;

class Transactions extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'transaction_id',
        'order_id',
        'transaction_type',
        'transaction_description',
        'account_number',
        'date_transacted',
        'before_balance',
        'action_id',
        'amount',
        'new_balance',
        'balance_type_id',
        'withdraw_fee',
        'new_amount',
        'action_id',
        'operator_uid',
        'admin_remarks',
        'system_remarks'
    ];

    public function saveTransactions($request)
    {
        
        return Transactions::updateOrCreate(
            ['uid'   => Auth::user()->uid,'transaction_id' => $request->input('transaction_id')],
            [
                'uid'   => Auth::user()->uid,
                'transaction_id' =>  $request->input('transaction_id'),
                'transaction_type' => $request->input('transaction_type'),
                'transaction_description' => $request->input('description'),
                'date_transacted' => $request->input('date_transacted'),
                'before_balance' => $request->input('before_balance'),
                'action_id' => $request->input('action_id'),
                'amount' => $request->input('amount'),
                'new_balance' => $request->input('new_balance'),
                'balance_type_id'=> 3,
                'admin_remarks' => '',
                'system_remarks' => ''
            ]
        );

    }

    public function getDetails($uid, $action_id) {
        $query = $this->select()
            ->where('uid', $uid)
            ->where('action_id', $action_id)
            ->latest('id')
            ->get();

        return $query;
    }

    public function getTotalWithdraw($uid, $action_id, $date){

        $query = $this->select()
            ->where('uid', $uid)
            ->whereIn('action_id', $action_id)
            // ->whereBetween('date_transacted', [$date[0],$date[1]])
            ->whereRaw("DATE_FORMAT(date_transacted, '%Y-%m') BETWEEN '$date[0]' AND '$date[1]'")
            ->sum('amount');

        return $query;

    }

    public function FirstWithdrawal($uid, $action_id){

        $query = $this->select('id', 'date_transacted')
            ->where('uid', $uid)
            ->where('action_id', $action_id)
            ->first();

        return $query;

    }


    public function TotalAmount($uid, $action_id, $date){

        $query = $this->select()
            ->where('uid', $uid)
            ->whereIn('action_id', $action_id)
            ->whereBetween('date_transacted', $date)
            ->sum('amount');

        return $query;

    }

    public function TransactionTable($uid, $action_id, $date){

        // $query = $this->select('transaction_id', 'transaction_type', 'transaction_description', 'date_transacted', 'amount', 'before_balance', 'new_balance');
        // $query->where('uid', $uid);

        // switch ($date){

        //     case '1':
        //         $query->whereBetween('date_transacted', [now()->subDays(7), now()]);
        //         break;
        //     case '2':
        //         $query->whereDate('date_transacted', now());
        //         break;
        //     case '3':
        //         $query->whereDate('date_transacted', now()->subDays(1));
        //         break;
        //     case '4':
        //         $query->whereMonth('date_transacted', now()->month);
        //         break;
        //     case '5':
        //         $query->whereYear('date_transacted', now()->year);
        //         break;

        // }

        // $query->whereIn('action_id', $action_id);
        // $query->orderBy('id', 'desc');
        // $query->get();

        DB::statement('SET sql_mode=(SELECT REPLACE(@@sql_mode, "ONLY_FULL_GROUP_BY", ""))');

        $results = DB::table(function ($subquery) use ($uid, $action_id, $date) {
            $subquery->select(['transaction_id', 'transaction_type', 'transaction_description', 'date_transacted', 'amount', 'before_balance', 'new_balance']);
            $subquery->from('transactions');
            $subquery->where('uid', $uid);

            switch ($date){

                case '1':
                    $subquery->whereRaw('DATE(date_transacted) BETWEEN ? AND ?', [
                        now()->subDays(7)->toDateString(),
                        now()->toDateString()
                    ]);
                    break;
                case '2':
                    $subquery->whereDate('date_transacted', now());
                    break;
                case '3':
                    $subquery->whereDate('date_transacted', now()->subDays(1));
                    break;
                case '4':
                    $subquery->whereMonth('date_transacted', now()->month);
                    break;
                case '5':
                    $subquery->whereYear('date_transacted', now()->year);
                    break;

            }

            $subquery->whereIn('action_id', $action_id);

            $subquery->unionAll(function ($subquery) use ($uid, $action_id, $date) {
                $subquery->select(['transaction_id', 'front_users_remarks AS transaction_type', 'front_users_remarks AS transaction_description', 'date_transacted', 'amount', 'before_balance', 'new_balance']);
                $subquery->from('db29betadmin.deposit_and_withdrawal');
                $subquery->where('uid', $uid);

                switch ($date){

                    case '1':
                        $subquery->whereBetween('date_transacted', [now()->subDays(7), now()]);
                        break;
                    case '2':
                        $subquery->whereDate('date_transacted', now());
                        break;
                    case '3':
                        $subquery->whereDate('date_transacted', now()->subDays(1));
                        break;
                    case '4':
                        $subquery->whereMonth('date_transacted', now()->month);
                        break;
                    case '5':
                        $subquery->whereYear('date_transacted', now()->year);
                        break;

                }

                $subquery->whereIn('action_id', $action_id);
            });
        }, 'subquery')
            ->groupBy('transaction_id')
            ->get();

        return $results;

        // return $query;

    }

    public function RechargeRecordtable($referral_id, $action_id, $date){

        // $query = $this->select('username', 'name', 'transaction_type', 'date_transacted', 'amount', 'before_balance', 'new_balance');
        // $query->leftJoin('users', 'transactions.uid', '=', 'users.uid');
        // $query->leftJoin('user_referrals', 'transactions.uid', '=', 'user_referrals.users_id');
        // // $query->whereIn('transactions.uid', $uid);
        // $query->where('user_referrals.referral_id', $referral_id);

        // switch ($date){

        //     case '1':
        //         $query->whereBetween('date_transacted', [now()->subDays(7), now()]);
        //         break;
        //     case '2':
        //         $query->whereDate('date_transacted', now());
        //         break;
        //     case '3':
        //         $query->whereDate('date_transacted', now()->subDays(1));
        //         break;
        //     case '4':
        //         $query->whereMonth('date_transacted', now()->month);
        //         break;
        //     case '5':
        //         $query->whereYear('date_transacted', now()->year);
        //         break;

        // }

        // $query->whereIn('action_id', $action_id);
        // $query->orderBy('transactions.id', 'desc');

        // return $query->get()->toArray();

        DB::statement('SET sql_mode=(SELECT REPLACE(@@sql_mode, "ONLY_FULL_GROUP_BY", ""))');

        $results = DB::table(function ($subquery) use ($referral_id, $action_id, $date) {
            $subquery->select(['username', 'name', 'transaction_id', 'transaction_type', 'transaction_description', 'date_transacted', 'amount', 'before_balance', 'new_balance']);
            $subquery->from('transactions');
            $subquery->leftJoin('users', 'transactions.uid', '=', 'users.uid');
            $subquery->leftJoin('user_referrals', 'transactions.uid', '=', 'user_referrals.users_id');
            $subquery->where('user_referrals.referral_id', $referral_id);

            switch ($date){

                case '1':
                    $subquery->whereRaw('DATE(date_transacted) BETWEEN ? AND ?', [
                        now()->subDays(7)->toDateString(),
                        now()->toDateString()
                    ]);
                    break;
                case '2':
                    $subquery->whereDate('date_transacted', now());
                    break;
                case '3':
                    $subquery->whereDate('date_transacted', now()->subDays(1));
                    break;
                case '4':
                    $subquery->whereMonth('date_transacted', now()->month);
                    break;
                case '5':
                    $subquery->whereYear('date_transacted', now()->year);
                    break;

            }

            $subquery->whereIn('action_id', $action_id);

            $subquery->unionAll(function ($subquery) use ($referral_id, $action_id, $date) {
                $subquery->select(['username', 'name', 'transaction_id', 'front_users_remarks AS transaction_type', 'front_users_remarks AS transaction_description', 'date_transacted', 'amount', 'before_balance', 'new_balance']);
                $subquery->from('db29betadmin.deposit_and_withdrawal');
                $subquery->leftJoin('users', 'deposit_and_withdrawal.uid', '=', 'users.uid');
                $subquery->leftJoin('user_referrals', 'deposit_and_withdrawal.uid', '=', 'user_referrals.users_id');
                $subquery->where('user_referrals.referral_id', $referral_id);

                switch ($date){

                    case '1':
                        $subquery->whereBetween('date_transacted', [now()->subDays(7), now()]);
                        break;
                    case '2':
                        $subquery->whereDate('date_transacted', now());
                        break;
                    case '3':
                        $subquery->whereDate('date_transacted', now()->subDays(1));
                        break;
                    case '4':
                        $subquery->whereMonth('date_transacted', now()->month);
                        break;
                    case '5':
                        $subquery->whereYear('date_transacted', now()->year);
                        break;

                }

                $subquery->whereIn('action_id', $action_id);
            });
        }, 'subquery')
            ->groupBy('transaction_id')
            ->get();

        return $results;

    }

    public function getUserTransactionsByAction($uid, $params) {
        return $this::where('uid', $uid)->whereIn('action_id', $params);
    }

    public function getTransactionsByAction($params) {
        return $this::whereIn('action_id', $params);
    }

    public function getTransaction($transaction_id) {
        return $this::where('transaction_id', $transaction_id);
    }

    public function generateTransactionId() {
        $prefix = "TRXWD";
        $maxdigits = '19';
        $randnum = '';
        while (strlen($randnum) < $maxdigits) {
            $randnum .= mt_rand(0, 9);
        }

        return $prefix."-".$randnum;
    }
}
