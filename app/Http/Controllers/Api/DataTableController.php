<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameHistory;
use App\Models\Transactions;
use App\Models\User_Referral;
use App\Models\PromotionDiscount;
use DataTables;
use App\Services\GoogleTranslateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DataTableController extends Controller
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

    private $User;
    private $User_Info;
    private $User_Referral;
    private $GameHistory;
    private $Transactions;
    private $PromotionDiscount;
    protected $filterTranslate;
    
    public function __construct()
    {

        $this->User = new User;
        $this->User_Info = new User_Info;
        $this->User_Referral = new User_Referral;
        $this->GameHistory = new GameHistory;
        $this->Transactions = new Transactions;
        $this->PromotionDiscount = new PromotionDiscount;
        $this->filterTranslate = new GoogleTranslateService;

    }


    public function PlayHistoryTable(Request $request){
        
        if ($request->ajax()) {
            
            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {
    
                $game_type = explode(', ', $request->input('game_type'));
                $data = $this->GameHistory->getPlayHistoryTable(Auth::user()->uid, $request->input('date'), $game_type);
                $data = $this->filterTranslate->filterCustomTranslate2($data, 'play_history_table-', ['game_name', 'action_description', 'category_name']);
                $data = collect($data);

                $data = $data->map(function ($item){

                    if ($item->operation_type == 10) {

                        $item->amount = '<li style="color: green; font-weight: 500;">+' . $item->amount . '</li>';

                    }else {

                        $item->amount = '<li style="color: red; font-weight: 500;">-' . $item->bet . '</li>';

                    }
 
                    return $item;

                });

                return DataTables($data)->rawColumns(['amount'])->toJson();
    
            }else {
    
                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);
    
            }
            
        }

    }
    
    public function AccountRegistrationTable(Request $request){
        
        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $data = $this->User_Referral->AccountRegistrationTable(Auth::user()->referral_no, $request->input('date'));

                return DataTables($data)->toJson();

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }

    }
    
    public function TransactionTable(Request $request){
        
        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $action_id = explode(', ', $request->input('action_id'));
                $data = $this->Transactions->TransactionTable(Auth::user()->uid, $action_id, $request->input('date'));
                $data = $this->filterTranslate->filterCustomTranslate2($data, 'transaction_table-', ['transaction_type']);

                return DataTables($data)->toJson();

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }

    }

    public function RechargeRecordtable(Request $request){

        if ($request->ajax()) {
            
            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $action_id = explode(', ', $request->input('action_id'));
                $data = $this->Transactions->RechargeRecordtable(Auth::user()->referral_no, $action_id, $request->input('date'));
                $data = $this->filterTranslate->filterCustomTranslate2($data, 'recharge_record_table-', ['transaction_type']);

                return DataTables($data)->toJson();

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }
        }

    }

    public function TeamMembersTable(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $data = $this->User_Referral->AccountRegistrationTable(Auth::user()->referral_no, $request->input('date'));


                return DataTables($data)->toJson();

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }
            
        }

    }

    public function CommissionTable(Request $request){

        if ($request->ajax()) {
            
            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $action_id = explode(', ', $request->input('action_id'));
                $data = $this->PromotionDiscount->CommissionTable(Auth::user()->uid, $action_id, $request->input('date'));
                $data = $this->filterTranslate->filterCustomTranslate2($data, 'commission_table-', ['transaction_type']);

                return DataTables($data)->toJson();

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }

    }

    public function OverviewTab(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->header('X-CSRF-TOKEN')) {

                $query_UserGuest = DB::table('users')
                ->distinct()
                ->leftJoin('transactions', 'users.uid', '=', 'transactions.uid')
                ->where('users.member_type', 3)
                ->whereNull('transactions.uid')
                ->count('users.id');

                $query_UserDeposit = DB::table('users')
                ->distinct()
                ->Join('transactions', 'users.uid', '=', 'transactions.uid')
                ->where('users.member_type', 3)
                ->count('users.id');

                $query_BonusToday = DB::table('promotion_discount')
                ->whereDate('created_at', now())
                ->sum('amount');

                $query_BonusYesterday = DB::table('promotion_discount')
                ->whereDate('created_at', now()->subDays(1))
                ->sum('amount');

                return response()->json([ 'user_guest' => $query_UserGuest, 'user_deposit' => $query_UserDeposit, 'bonus_today' => $query_BonusToday, 'bonus_yesterday' => $query_BonusYesterday]);

            }

        }

    }

}
