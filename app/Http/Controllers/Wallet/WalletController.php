<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vault;
use App\Models\ActivityLog;
use App\Models\Admin\AdminActivityLog;
use App\Models\Avatar;
use App\Models\GameHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User as User;
use App\Models\User_Info;
use App\Models\Transactions;
use App\Models\ActionType;
use App\Libraries\API\APILibrary;
use App\Models\ControlBalance;
use App\Models\HistoryBalance;
use App\Models\CallbackPayment;
use App\Models\User_Referral;
use App\Models\Admin\DepositAndWithdrawal;
use App\Models\Ranks as Ranks;
use App\Models\PromotionSettings;
use App\Models\PromotionRuleConfig;
use App\Models\Admin\DepositAndWithdrawalConfig;
use App\Models\PromotionDiscount;
use Illuminate\Support\Str;
use DataTables;
use Jenssegers\Agent\Agent;
use App\Services\GoogleTranslateService;
use Illuminate\Support\Facades\Cache;
use DateTime;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Dotenv\Dotenv;
use Aws\Exception\AwsException;
use Exception;
use Illuminate\Database\QueryException;

class WalletController extends Controller
{
    public $Vault;
    public $ActivityLog;
    private $GameHistory;
    private $User;
    private $transactions;
    private $API;
    private $ControlBalance;
    private $HistoryBalance;
    private $CallbackPayment;
    private $User_Info;
    private $User_Referral;
    private $DepositAndWithdrawal;
    public $AdminActivityLog;
    public $PromotionSettings;
    public $PromotionRuleConfig;
    public $ActionType;
    private $WithdrawalManagement;
    protected $filterTranslate;

    public function __construct()
    {

        $this->Vault = new Vault();
        $this->ActivityLog = new ActivityLog();
        $this->GameHistory = new GameHistory();
        $this->User = new User();
        $this->transactions = new Transactions();
        $this->ControlBalance = new ControlBalance();
        $this->middleware('auth');
        $this->API = new APILibrary;
        $this->ControlBalance = new ControlBalance;
        $this->HistoryBalance = new HistoryBalance;
        $this->CallbackPayment = new CallbackPayment;
        $this->User_Info = new User_Info;
        $this->User_Referral = new User_Referral;
        $this->DepositAndWithdrawal = new DepositAndWithdrawal;
        $this->AdminActivityLog = new AdminActivityLog;
        $this->PromotionSettings = new PromotionSettings;
        $this->PromotionRuleConfig = new PromotionRuleConfig;
        $this->ActionType = new ActionType;
        $this->WithdrawalManagement = new DepositAndWithdrawalConfig();
        $this->filterTranslate = new GoogleTranslateService;
   
    }

    public function deposit(Request $request)
    {

        // if(Auth::user()->member_type == 3){
            
            if ($request->has('btn-deposit')) {

                $validator = Validator::make($request->all(), [
                    'deposit_amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                ]);

                if ($validator->fails()) {

                    return redirect()->back()
                        ->with('session', 'session')
                        ->withErrors($validator, 'validator')
                        ->withInput();

                } else {
                    
                    $amount = $request->input('deposit_amount');

                    if ($amount < 30) {

                        return redirect()
                            ->route('index')
                            ->with('session', 'session')
                            ->withErrors([
                                'error_title' => __('Error Processing The Deposit!'),
                                'error_message' => __('The minimum deposit is R$ 30')
                            ]);

                    }elseif ($amount > 20000) {

                        return redirect()
                            ->route('index')
                            ->with('session', 'session')
                            ->withErrors([
                                'error_title' => __('Error Processing The Deposit!'),
                                'error_message' => __('The maximum deposit is R$ 20,000')
                            ]);

                    }

                    if ($request->input('promotion') != "" && $request->input('promotion') != null && $request->input('promotion') != "null" && !$request->has('doNotParcipate')) {

                        $promo_code_id = $request->input('promotion');
                        $PromoSettings = $this->PromotionSettings->getPromoSettings($promo_code_id);
                        
                        if(empty($PromoSettings)){
                            
                            return redirect()
                            ->route('index')
                            ->with('session', 'session')
                            ->withErrors([
                                'error_title' => 'Error Processing The Deposit!',
                                'error_message' => 'There is promotion detected but not found.'
                            ]);
                            
                        }

                        $amount_array = [30, 100, 200, 500, 1000, 2000, 5000, 19999];
                        $promo_bonus = [];
                        $i = 0;
                        $accumulated_discount = 0;

                        foreach ($amount_array as $row) {

                            if ($row == $PromoSettings[$i]['calculation_result'] && $PromoSettings[$i]['calculation_result'] != null) {

                                $promo_bonus[$row] = $PromoSettings[$i]['discount_amount_value'];
                                if ($i < count($PromoSettings) - 1) {
                                    
                                    $i++;
                                    
                                }

                            }else {

                                if ($i == 0) {

                                    if ($row == $PromoSettings[$i]['calculation_result'] && $PromoSettings[$i]['calculation_result'] != null) {

                                        $promo_bonus[$row] = $PromoSettings[$i]['discount_amount_value'];

                                    }elseif ($row >= $PromoSettings[$i]['calculation_result'] && $PromoSettings[$i]['calculation_result']) {

                                        $promo_bonus[$row] = $PromoSettings[$i]['discount_amount_value'];

                                    }

                                }else {

                                    $promo_bonus[$row] = $PromoSettings[$i-1]['discount_amount_value'];

                                }

                            }

                        }
                        
                        if ($promo_code_id != null) {

                            $amount_range = [
                                ['min' => 30, 'max' => 99],
                                ['min' => 100, 'max' => 199],
                                ['min' => 200, 'max' => 499],
                                ['min' => 500, 'max' => 999],
                                ['min' => 1000, 'max' => 1999],
                                ['min' => 2000, 'max' => 4999],
                                ['min' => 5000, 'max' => 19998],
                                ['min' => 19999, 'max' => INF]
                            ];

                            $amount_calculation_method = $this->PromotionSettings->getAmountCalculationMethod($promo_code_id);

                            foreach ($amount_range as $range) {

                                if ($amount >= $range['min'] && $amount <= $range['max']) {

                                    if (isset($promo_bonus[$range['min']])) {

                                        $bonus = $promo_bonus[$range['min']];

                                        if ($amount_calculation_method['amount_calculation_method'] == 1) {
    
                                            $accumulated_discount = ($bonus / 100) * $amount;
    
                                        }elseif ($amount_calculation_method['amount_calculation_method'] == 2) {
    
                                            $accumulated_discount = $bonus;
    
                                        }
    
                                        break;

                                    }else {
                                        
                                        $accumulated_discount = 0;
                                        $promo_code_id = null;
                                        break;

                                    }

                                }

                            }
                            
                        }

                    }else {
                        
                        $promo_code_id = null;
                        $accumulated_discount = 0;
                        
                    }


                    $device = new Agent();
                    $data = [
                        'deposit_amount' => $amount,
                        'promotion' => $promo_code_id,
                        'accumulated_discount' => $accumulated_discount,
                        'user_ip' => $request->ip(),
                        'user_domain' => $request->getHost(),
                        'user_client' => $request->header('User-Agent'),
                        'user_display' => self::deviceDetected($device),
                        'user_browser' => self::browserDetected($device)
                    ];

                    $response = $this->API->DepositMethod($data);
                    
                    if ($response['status'] == 200) {
                        
                        $responseData = json_decode($response['response'], true);
    
                        if ($responseData != NULL) {
    
                            if ($responseData['resultCode'] == "000000") {
    
                                return redirect()->back()
                                    ->with(['pay' => $responseData['data'][0]['checkoutUrl'], 'pixcode' => $responseData['data'][0]['qrCodeString'], 'amount' => $data['deposit_amount']]);
    
                            } else {
    
                                return redirect()
                                    ->route('index')
                                    ->withErrors([
                                        'error_title' => 'Error Processing The Deposit!',
                                        'error_message' => isset($responseData['errorMsg']) ? $responseData['errorMsg'] : "Try Again Later Cannot Connect To The Server"
                                    ]);
    
                            }
    
                        } else {
    
                            return redirect()
                                ->route('index')
                                ->withErrors([  
                                    'error_title' => 'Cannot Connect To Server!',
                                    'error_message' => 'Try Again Later Cannot Connect To The Server'
                                ]);
    
                        }

                    }elseif ($response['status'] == 1000){
                    
                        return redirect()
                            ->route('index')
                            ->withErrors([
                                'error_title' => 'Error!',
                                'error_message' => 'You need to put your CPF/Phone Number/Email. If you already have it in your account contact customer service.'
                            ]);

                    }elseif ($response['status'] == 1001) {

                        return redirect()
                            ->route('index')
                            ->withErrors([
                                'error_title' => 'Cannot Connect To Server!',
                                'error_message' => 'Try Again Later Server Having A Connection Problem'
                            ]);

                    }

                    
                }

            } elseif ($request->has('withdrawal')) {

                $validator = Validator::make($request->all(), [
                    'withdraw_amount' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                    'cardholder_name' => [
                        'required',
                        function ($attribute, $value, $fail) {

                            if (!DB::table('users')->where('name', $value)->where('uid', Auth::user()->uid)->exists()) {
                                $fail("The name entered does not exist");
                            }
                        },
                    ],
                    // 'account_number' => [
                    //     'required',
                    //     function ($attribute, $value, $fail) use ($request) {

                    //         if (!DB::table('users_info')->where($request->input('select_account'), $value)->where('uid', Auth::user()->uid)->exists()) {
                    //             $fail("The account number entered does not exist");
                    //         }
                    //     },
                    // ],
                ]);

                if ($validator->fails()) {

                    return redirect()->back()
                        ->with('withdraw_error', 'withdraw_error')
                        ->withErrors($validator, 'validator')
                        ->withInput();

                } else {
                    DB::beginTransaction();
                    
                    $control_balance = Auth::user()->balance()->control_balance;
                    $frozen_normal_balance = Auth::user()->balance()->frozen_normal_balance;
                    $rollover_balance = Auth::user()->balance()->rollover_balance;
                    $amount = $request->input('withdraw_amount');
                    $uid = Auth::user()->uid;
                    $matchedRank = self::UserLevel($uid);
                    $user_level = $matchedRank['level'];
                    $Rank = new Ranks();
                    $level_info = $Rank->getDetails($user_level);
                    $remaining = self::WithdrawRemainingBalance($level_info, new Transactions(), $uid);
                    $withdrawal_mangement = $this->WithdrawalManagement->getWithdrawalManagement();
                    $newcontrol_balance = ($withdrawal_mangement['withdrawal_percentage'] / 100) * $control_balance;

                    if ($control_balance >= $amount) {

                        if ($newcontrol_balance >= $amount) {

                            if ($amount >= $withdrawal_mangement['minimum_withdrawal'] && $amount <= $remaining['remaining_withdraw']) {

                                if ($rollover_balance < 1) {

                                    $withdrawal_fee = $amount * ($level_info->withdrawal_rate / 100);
                                    $trans_id = self::TransactionID();
                                    $account_name = $request->input('cardholder_name');
                                    $user_infos = $this->User_Info->getDetails($uid);

                                    if ($user_infos->number_id != NULL || $user_infos->number_id != "") {

                                        $account_number = $user_infos->number_id;

                                    }elseif ($user_infos->mobile_number != NULL || $user_infos->mobile_number != "") {

                                        $account_number = $user_infos->mobile_number;

                                    }elseif ($user_infos->email != NULL || $user_infos->email != "") {

                                        $account_number = $user_infos->email;

                                    }
                                    $new_balance = $control_balance - $amount;
                                    
                                    $request_withdrawal = DepositAndWithdrawal::updateOrCreate(
                                        ['uid' => $uid, 'transaction_id' => $trans_id],[
                                        'uid' => $uid,
                                        'transaction_id' => $trans_id,
                                        // 'transaction_type' => "Request Withdrawal",
                                        // 'transaction_description' => "User Request a Withdrawal with Transaction ID of ". $trans_id,
                                        'account_number' => $account_number,
                                        'account_name' => $account_name,
                                        'date_transacted' => now(),
                                        'before_balance' => $control_balance,
                                        'amount' => $amount,
                                        'new_balance' => $new_balance,
                                        'withdraw_fee' => $withdrawal_fee,
                                        'front_users_remarks' => "Request a Withdrawal",
                                        'admin_remarks' => "User Request a Withdrawal",
                                        'action_id' => 12
                                    ]);

                                    if ($request_withdrawal) {

                                        $updateBalance = [
                                            'uid' => $uid,
                                            'amount' => $amount,
                                            'frozen_normal_balance' => $frozen_normal_balance + $amount
                                        ];

                                        $update_balance = $this->ControlBalance->NewBalance($updateBalance);
                                        if ($update_balance) {
                                            
                                            $desc = "User Request Withdrawal with Transaction Id of ". $trans_id;
                                            $this->ActivityLog->saveLogs($desc, $request->ip(), Auth::user()->uid, now(), 12, $request->getHost(), $request->header('User-Agent'));
                                            $this->AdminActivityLog->saveLogs($desc, $request->ip(), Auth::user()->uid, now(), 12, $request->getHost(), $request->header('User-Agent'));
    
                                            DB::commit();
                                            return redirect()
                                                ->route('index')
                                                ->withErrors([
                                                    'success_title' => 'Successful Withdrawal!',
                                                    'success_message' => 'Withdrawal Request Successful',
                                                    'amount' => $amount,
                                                    'new_balance' => $new_balance
                                                ]);

                                        }else {
                                            DB::rollback();
                                            return redirect()
                                                ->route('index')
                                                ->withErrors([
                                                    'error_title' => "Unsuccessful withdrawal request error",
                                                    'error_message' => "Withdrawal error, please try again later"
                                                ]);

                                        }

                                    } else {

                                        DB::rollback();
                                        return redirect()
                                            ->route('index')
                                            ->withErrors([
                                                'error_title' => "Unsuccessful withdrawal request error",
                                                'error_message' => "Withdrawal error, please try again later server error"
                                            ]);
                                    }

                                }else {
                                    DB::rollback();
                                    return redirect()
                                        ->route('index')
                                        ->withErrors([
                                            'error_title' => "Unsuccessful withdrawal request error",
                                            'error_message' => "You're not qualified to make a withdrawal request"
                                        ]);
                                }

                            }else {

                                DB::rollback();
                                return redirect()
                                    ->route('index')
                                    ->withErrors([
                                        'error_title' => "Unsuccessful withdrawal request error",
                                        'error_message' => "The total withdrawal amount including the requested withdrawal must be less than or equal to BRL " . $remaining['max_amount'] . " with a minimum value of BRL " . $withdrawal_mangement['minimum_withdrawal']
                                    ]);

                            }

                        }else {

                            DB::rollback();
                            return redirect()
                                ->route('index')
                                ->withErrors([
                                    'error_title' => "Unsuccessful withdrawal request error",
                                    'error_message' => "Entry amount is exceeding your withdrawal limit"
                                ]);

                        }

                    }else {

                        DB::rollback();
                        return redirect()
                            ->route('index')
                            ->withErrors([
                                'error_title' => "Unsuccessful withdrawal request error",
                                'error_message' => "Entry amount is exceeding your balance"
                            ]);

                    }

                }

            }
    
        // }else {
            
        //     return redirect()
        //         ->route('index')
        //         ->withErrors([
        //             'error_title' => "Error!",
        //             'error_message' => "Withdrawal and Recharge is not available right now."
        //         ]);

        // }
        
    }

    public function callback(Request $request)
    {

        if (Auth::check()) {

            $uid = Auth::user()->uid;
            $deposit = $this->CallbackPayment->CheckCallback($uid);

            if (!is_null($deposit)) {

                if ($deposit->orderStatus === "SUCCESS") {

                    $this->CallbackPayment->updateCallback($uid, $deposit->mchOrderId);

                    $data = [
                        'status' => 'success',
                        'orderId' => $deposit->mchOrderId,
                        'failMessage' => "Successfully Recharge"
                    ];
                } else {

                    $this->CallbackPayment->updateCallback($uid, $deposit->mchOrderId);

                    $data = [
                        'status' => 'error',
                        'orderId' => $deposit->mchOrderId,
                        'failMessage' => $deposit->failMessage
                    ];

                }

                return response()->json($data);

            }else {

                return response()->json(['status' => 500, 'error' => 'No New Deposit To Process']);

            }

        }else {

            return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

        }

    }

    public function postVerifyVault(Request $request)
    {
        function checkEmptyArr($var)
        {
            $is_null = false;

            foreach ($var as $password) {

                if ($password === null) {
                    $is_null = true;
                    break;
                }
            }
            if ($is_null) {
                return true;
            } else {
                return false;
            }
        }

        if (!is_null($request->input('redirect-input'))) {

            $inputs = $request->only(['passwordMember1', 'passwordMember2', 'passwordMember3', 'passwordMember4', 'passwordMember5', 'passwordMember6']);
            $password = implode('', $inputs);
            if (!checkEmptyArr($inputs)) {

                if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {

                    $current_password = Vault::find(Auth::user()->uid);

                    $request['password'] = $password;

                    if ($this->Vault->matchPassword($request, $current_password)) {

                        $request['description'] = "Accessed Vault";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));

                        return redirect()->back()
                            ->with('show_modal_transfer', 'show_modal_transfer');
                    } else {

                        $error = "password did not match";
                        return redirect()->back()
                            ->with('password_did_not_match', $error)
                            ->withErrors($error, 'verifypassword');
                    }
                } else {
                }
            } else {

                $arr = [
                    'password' => implode('', $inputs)
                ];

                $validator = Validator::make($arr, [
                    'password' => 'required',
                ]);

                if ($validator->fails()) {

                    $error = "password is required";
                    return redirect()->back()
                        ->with('password_did_not_match', $error)
                        ->withErrors($error, 'verifypassword');
                    // return redirect()->back()
                    //     ->with('session_verifypassword', 'session_verifypassword')
                    //     ->withErrors($validator, 'verifypassword')
                    //     ->withInput();
                } else {



                    dd($password);
                }
            }
        } else {

            $inputs = $request->only(['passwordMember1', 'passwordMember2', 'passwordMember3', 'passwordMember4', 'passwordMember5', 'passwordMember6']);
            $inputs2 = $request->only(['passwordMemberConfirm1', 'passwordMemberConfirm2', 'passwordMemberConfirm3', 'passwordMemberConfirm4', 'passwordMemberConfirm5', 'passwordMemberConfirm6']);
            $password = implode('', $inputs);
            $arr = [
                'password' => implode('', $inputs),
                'password_confirmation' => implode('', $inputs2)
            ];


            $validator = Validator::make($arr, [
                'password' => 'required|confirmed:password_confirmation|min:6',
                'password_confirmation' => 'required|min:6',
            ]);

            if ($validator->fails()) {

                return redirect()->back()
                    ->with('session_verifypassword', 'session_verifypassword')
                    ->withErrors($validator, 'verifypassword')
                    ->withInput();
            } else {

                if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {
                    // dd($this->Vault->checkIfExistsUid(Auth::user()->uid));
                    $current_password = Vault::find(Auth::user()->uid);

                    if ($this->Vault->matchPassword($request, $current_password)) {
                        $request['description'] = "Accessed Vault";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));
                        return view('pages.vault');
                    } else {
                        $error = "password did not match";

                        return redirect()->back()
                            ->with('password_did_not_match', $error)
                            ->withErrors($error, 'verifypassword');
                    }
                } else {

                    $request['password'] = $password;
                    // dd("asds");
                    if ($this->Vault->setPasswordVault($request)) {
                        $request['description'] = "Created a password for vault";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));
                        return redirect()->back()
                            ->with('show_modal_transfer', 'show_modal_transfer');
                        // return view('pages.vault');
                    } else {
                        $error = "password did not match";
                        return redirect()->back()
                            ->with('password_did_not_match', $error)
                            ->withErrors($error, 'verifypassword');
                    }
                }
            }
        }
    }

    public function verifyVault(Request $request)
    {


        if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {
            return response()->json(["msg" => true]);
        } else {
            return response()->json(["msg" => false]);
        }
    }

    // password for safe box

    public function postVerifySafeBox(Request $request)
    {
        function checkEmptyArrBox($var)
        {
            $is_null = false;

            foreach ($var as $password) {

                if ($password === null) {
                    $is_null = true;
                    break;
                }
            }
            if ($is_null) {
                return true;
            } else {
                return false;
            }
        }

        if (!is_null($request->input('redirect-input-safe'))) {

            $inputs = $request->only(['passwordSafe1', 'passwordSafe2', 'passwordSafe3', 'passwordSafe4', 'passwordSafe5', 'passwordSafe6']);
            $password = implode('', $inputs);
            if (!checkEmptyArrBox($inputs)) {

                if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {

                    $current_password = Vault::find(Auth::user()->uid);

                    $request['password'] = $password;

                    if ($this->Vault->matchPassword($request, $current_password)) {

                        $request['description'] = "Accessed Safe Box";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));

                        return redirect()->back()
                            ->with('show_modal_transfer_safe', 'show_modal_transfer_safe');
                    } else {

                        $error = "password did not match";
                        return redirect()->back()
                            ->with('password_did_not_match_safe', $error)
                            ->withErrors($error, 'verifypasswordsafe');
                    }
                } else {
                }
            } else {

                $arr = [
                    'password' => implode('', $inputs)
                ];

                $validator = Validator::make($arr, [
                    'password' => 'required',
                ]);

                if ($validator->fails()) {
                    $error = "password is required";
                    return redirect()->back()
                        ->with('password_did_not_match_safe', $error)
                        ->withErrors($error, 'verifypasswordsafe');
                    // return redirect()->back()
                    //     ->with('password_did_not_match_safe', 'password_did_not_match_safe')
                    //     ->withErrors($validator, 'verifypasswordsafe')
                    //     ->withInput();
                } else {



                    dd($password);
                }
            }
        } else {

            $inputs = $request->only(['passwordSafe1', 'passwordSafe2', 'passwordSafe3', 'passwordSafe4', 'passwordSafe5', 'passwordSafe6']);
            $inputs2 = $request->only(['passwordSafeConfirm1', 'passwordSafeConfirm2', 'passwordSafeConfirm3', 'passwordSafeConfirm4', 'passwordSafeConfirm5', 'passwordSafeConfirm6']);
            $password = implode('', $inputs);
            $arr = [
                'password' => implode('', $inputs),
                'password_confirmation' => implode('', $inputs2)
            ];


            $validator = Validator::make($arr, [
                'password' => 'required|confirmed:password_confirmation|min:6',
                'password_confirmation' => 'required|min:6',
            ]);

            if ($validator->fails()) {

                return redirect()->back()
                    ->with('session_verifypassword_safe', 'session_verifypassword_safe')
                    ->withErrors($validator, 'verifypasswordsafe')
                    ->withInput();
            } else {

                if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {
                    // dd($this->Vault->checkIfExistsUid(Auth::user()->uid));
                    $current_password = Vault::find(Auth::user()->uid);

                    if ($this->Vault->matchPassword($request, $current_password)) {
                        $request['description'] = "Accessed Safe Box";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));
                        return view('pages.safe');
                    } else {
                        $error = "password did not match";

                        return redirect()->back()
                            ->with('password_did_not_match_safe', $error)
                            ->withErrors($error, 'verifypasswordsafe');
                    }
                } else {

                    $request['password'] = $password;
                    // dd("asds");
                    if ($this->Vault->setPasswordVault($request)) {
                        $request['description'] = "Created a password for Safe Box";
                        $request['action_id'] = 33;
                        $this->ActivityLog->saveLogs($request['description'],$request->ip(),Auth::user()->uid, now(),$request['action_id'],$request->getHost(), $request->header('User-Agent'));
                        return redirect()->back()
                            ->with('show_modal_transfer_safe', 'show_modal_transfer_safe');
                        // return view('pages.vault');
                    } else {
                        $error = "password did not match";
                        return redirect()->back()
                            ->with('password_did_not_match_safe', $error)
                            ->withErrors($error, 'verifypasswordsafe');
                    }
                }
            }
        }
    }

    public function verifySafeBox(Request $request)
    {
        if ($this->Vault->checkIfExistsUid(Auth::user()->uid)) {
            return response()->json(["msg" => true]);
        } else {
            return response()->json(["msg" => false]);
        }
    }
    // end password for safe box

    public function viewPersonalCenter()
    {
        $avatars = Avatar::get();

        $uid = Auth::user()->uid;

        $query = DB::table('users')
            ->select(
                'users.uid',
                'users.username',
                'users.password',
                'users.email',
                'users.name',
                'users.status_lock',
                'users.member_type',
                'users.agent_group',
                'users.registration_ip',
                'users.referral_no',
                'users.referral_link',
                'users.api_token',
                'users.remember_token',
                'control_balance.control_balance',
                'control_balance.frozen_normal_balance',
                'control_balance.agency_balance',
                'control_balance.frozen_agency_balance',
                'control_balance.safety_balance',
                'game_history.game_id',
                'game_history.description',
                'game_history.result',
                'game_history.date_transacted',
                'game_history.operation_type'
            )
            ->leftJoin('control_balance', 'users.uid', '=', 'control_balance.uid')
            ->leftJoin('game_history', 'users.uid', '=', 'game_history.uid')
            ->where('users.uid', '=', $uid)
            ->where('game_history.result', '=', 0)
            ->groupBy(
                'users.uid',
                'users.username',
                'users.password',
                'users.email',
                'users.name',
                'users.status_lock',
                'users.member_type',
                'users.agent_group',
                'users.registration_ip',
                'users.referral_no',
                'users.referral_link',
                'users.api_token',
                'users.remember_token',
                'control_balance.control_balance',
                'control_balance.frozen_normal_balance',
                'control_balance.agency_balance',
                'control_balance.frozen_agency_balance',
                'control_balance.safety_balance',
                'game_history.game_id',
                'game_history.description',
                'game_history.result',
                'game_history.date_transacted',
                'game_history.operation_type'
            )
            ->first();

        $transactions = DB::table('transactions')->select('transactions.transaction_description', 'transactions.date_transacted', 'transactions.before_balance', 'transactions.amount')
            ->leftjoin('action_types', 'action_types.action_id', '=', 'transactions.action_id')
            ->where('transactions.uid', '=', $uid)
            ->get();

        // dd($transactions);

        // // Calculate the total sum of game_history.amount separately
        // $totalAmount = DB::table('game_history')
        //     ->where('uid', '=', $uid)
        //     ->where('result', '=', 0)
        //     ->sum('amount');

        // if(is_null($query)){

        // }else{
        //     $query->total = $totalAmount;
        // }

        // $games_data = DB::table('control_balance')
        //     ->select(DB::raw('SUM(users.deposit) as deposit,SUM(games.bet) as bet'))
        //     ->join('users', 'users.uid', '=', 'games.uid')
        //     ->where('users.uid', '=', $uid)
        //     ->first();

        $uid = Auth::user()->uid;

        $ranks = Ranks::get();
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
                    dd("b|".$percB);
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];
                $matched[] = [
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];

                continue;
            } else {
                if ($rank['total_deposits'] <= (int) $new_arry['total_deposit']) {
                    $percD = $rank['total_deposits'] != 0 ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                    // $percD = 100;
                } elseif ($rank['total_deposits'] >= (int) $new_arry['total_deposit']) {
                    // $p = (int)((int)$new_arry['total_deposit'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_deposit'] / 100 * 100);
                    // $percB = (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] *100;
                    $percB = $rank['total_deposits'] != 0 ? ((int) $new_arry['total_deposit'] / (int) $rank['total_deposits']) * 100 : 0;
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];
                $matched[] = [
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];

                break;
            }
            $cnt++;

        }
        // if array count is equal or less than 2

        if(count($matched) == 2){
            $matchedRank = $matched[0];

        }else{
            $matchedRank = $matchedRank[0];
        }

        $bets = $this->HistoryBalance->Bets(11, $uid);
        $earnings = $this->HistoryBalance->Bets(10, $uid);

        return view('pages.user')->with('avatars', $avatars)->with('rank_match', $matchedRank)->with([ 'bets' => $bets, 'earnings' => $earnings]);
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

    public function UpdateProfileImage(Request $request)
    {

        // if($request->ajax()){

        $update = $this->User->updateIMG($request->input('img_url'), Auth::user()->uid);

        // save activity log
        if ($update) {
            $notif = "Successfully Updated";
        } else {
            $notif = "Something went wrong";
        }
        return response()->json(['resp' => $notif]);
        // }
    }

    public function changePasswordLogin(Request $request)
    {
        if ($request->has('btn-confirm-changepassword')) {

            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|confirmed:new_password_confirmation',
                'new_password_confirmation' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('session_changepass_md', 'session_changepass_md')
                    ->withErrors($validator, 'error_changepass')
                    ->withInput();
            } else {

                $check_old_password = $this->User->checkOldPassword($request, Auth::user()->uid);

                if ($check_old_password) {

                    if ($this->User->saveNewPassword($request)) {

                        $msg = "Successfully Changed Password";
                        $request['description'] =  $msg;
                        $request['action_id'] = 3;

                        $this->ActivityLog->saveTransactionParam($request);
                    } else {

                        $msg = "Something went wrong, Pls try again";
                    }

                    return redirect()->back()->with('session_notification', $msg);
                } else {
                    $error = "Current password is incorrect";
                    return redirect()->back()
                        ->with('session_changepass_md_not_match', $error)
                        ->withErrors($error, 'session_changepass_md_not_match')
                        ->withInput();
                }
            }
        }
    }
    public function changeTransferPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'transfer_current_password' => 'required',
            'transfer_new_password' => 'required',
            'transfer_confirm_new_password' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->with('session_changepass_transfer', 'session_changepass_transfer')
                ->withErrors($validator, 'error_transfer')
                ->withInput();
        } else {

            $check_old_password = $this->Vault->checkOldPasswordVault($request, Auth::user()->uid);

            if ($check_old_password) {

                if ($this->Vault->saveNewPassword($request)) {

                    $msg = "Successfully Changed Transfer Balance Password";
                    $request['description'] =  $msg;
                    $request['action_id'] = 3;

                    $this->ActivityLog->saveTransactionParam($request);
                } else {

                    $msg = "Something went wrong, Pls try again";
                }

                return redirect()->back()->with('session_notification', $msg);

            } else {
                $error = "Current password is incorrect";
                return redirect()->back()
                    ->with('session_changepass_md_not_match_transfer', $error)
                    ->withErrors($error, 'session_changepass_md_not_match_transfer')
                    ->withInput();
            }
        }
    }

    public function transferAgentBalance(Request $request)
    {
        if ($request->has('members__withdrawl__submit')) {

            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                $err = "amount is required";
                return redirect()->back()
                    ->with('session_transfer_balance', $err);
            } else {

                $trans_id = self::TransactionID();
                $frozen_balance = Auth::user()->balance()->frozen_agency_balance + $request->input('amount');
                $agencybalance = Auth::user()->balance()->agency_balance - $request->input('amount');
                $request['transaction_id'] = $trans_id;
                $request['date_transacted'] = now();
                $request['action_id'] = 30;
                $request['transaction_type'] = $this->ActionType->getActionDescription(30);
                $request['before_balance'] = Auth::user()->balance()->agency_balance;
                $request['amount'] = $request->input('amount');
                $request['new_balance'] = $agencybalance;
                $request['front_users_remarks'] = "Requested a Transfer Agency Balance" . " " . $request->input('amount');
                $request['admin_remarks'] = "User Request to Transfer Agency Balance" . " " . $request->input('amount');
                $request['system_remarks'] = '';

                if ($agencybalance > 0) {

                    DB::beginTransaction();

                    if ($this->DepositAndWithdrawal->saveTransactions($request)) {

                        if ($this->ControlBalance->updateAgencyBalance(Auth::user()->uid, $frozen_balance, $agencybalance)) {

                            $desc = 'User Requested a Transfer Agency Balance with the amount of '.$request->input('amount').' to '.Auth::user()->username.'('.Auth::user()->uid.' ) Account';

                            $saveLogs = $this->ActivityLog->saveLogs($desc, $request->ip(), Auth::user()->uid, now(), 30, $request->getHost(), $request->header('User-Agent'));

                            if ($saveLogs) {

                                DB::commit();
                                return redirect()->back()
                                    ->with('message_transfer', __('Successfully Request Transfered of Agent Balance'));

                            }else {

                                DB::rollback();
                                return redirect()->back()
                                    ->with('session_transfer_balance', __('Error transfering the agency balance'));

                            }

                        }else{

                            DB::rollback();
                            return redirect()->back()
                                ->with('session_transfer_balance', __('Error transfering the agency balance'));

                        }

                    }else{

                        DB::rollback();
                        return redirect()->back()
                                ->with('session_transfer_balance', __('Error transfering the agency balance'));

                    }

                }else {

                    return redirect()->back()
                        ->with('session_transfer_balance', __('The amount is greater than the agency balance'));

                }
            }
        }
    }

    /**
     * Route="/personal-center/vault/transfer/safety-normal"
     * Method={"POST"}
     * name="transfer-safety-normal"
     */
    public function transferSafetyNormal(Request $request)
    {
        if ($request->has('members__withdrawl__submit_safe')) {
            $validator = Validator::make($request->all(), [
                'safety_amount' => 'required',
            ]);
            $request['action_id'] = 35;
            $request['amount'] = $request['safety_amount'];

            $balance = $this->ControlBalance->getBalance(Auth::user()->uid);

            if ($balance->control_balance >= $request->amount) {
                if ($validator->fails()) {
                    $err = "Amount is required";
                    return redirect()->back()
                        ->with('session_transfer_safety_normal', $err);
                } else {
                    $request['transaction_type'] = $this->ActionType->getActionDescription(35);
                    $request['description'] = "User transferred " . $request->input('amount') . " from Normal Balance to Safety Balance";

                    $prefix = "TRXWD";
                    $maxdigits = '19';
                    $randnum = '';
                    while (strlen($randnum) < $maxdigits) {
                        $randnum .= mt_rand(0, 9);
                    }

                    $request['transaction_id'] = $prefix."-".$randnum;
                    $request['date_transacted'] = now();
                    $request['before_balance'] = $balance->control_balance;

                    if ($this->ControlBalance->hideFunds(Auth::user()->uid, $request->amount)) {
                        $balance->safety_balance = $balance->safety_balance + $request->amount;
                        $balance->updated_at = now();
                        $balance->save();
                        $request['new_balance'] = $this->ControlBalance->computeControlBalance(Auth::user()->uid);
                        $this->transactions->saveTransactions($request);

                        return redirect()->back();
                    } else {
                        return redirect()->back()
                            ->with('session_transfer_safety_normal', "Unable to hide funds");
                    }
                }
            } else {
                return redirect()->back()
                    ->with('session_transfer_safety_normal', "Not enough funds");
            }
        } else {
            $validator = Validator::make($request->all(), [
                'normal_amount' => 'required',
            ]);
            $request['action_id'] = 36;
            $request['amount'] = $request['normal_amount'];

            $balance = $this->ControlBalance->getBalance(Auth::user()->uid);

            if ($balance->safety_balance >= $request->amount) {
                if ($validator->fails()) {
                    $err = "Amount is required";
                    return redirect()->back()
                        ->with('session_transfer_safety_normal', $err);
                } else {
                    $request['transaction_type'] = $this->ActionType->getActionDescription(36);
                    $request['description'] = "User transferred " . $request->input('amount') . " from Safety Balance to Normal Balance";
                
                    $prefix = "TRXWD";
                    $maxdigits = '19';
                    $randnum = '';
                    while (strlen($randnum) < $maxdigits) {
                        $randnum .= mt_rand(0, 9);
                    }

                    $request['transaction_id'] = $prefix."-".$randnum;
                    $request['date_transacted'] = now();
                    $request['before_balance'] = $balance->control_balance;
                    $balance->safety_balance = $balance->safety_balance - $request->amount;

                    if ($balance->save()) {
                        $balance = $this->ControlBalance->getBalance(Auth::user()->uid);
                        $balance->discount_balance = $balance->control_balance + $request->amount;
                        $balance->updated_at = now();
                        if ($balance->save()) {
                            $request['new_balance'] = $this->ControlBalance->computeControlBalance(Auth::user()->uid);
                            $this->transactions->saveTransactions($request);

                            return redirect()->back();
                        } else {
                            return redirect()->back()
                                ->with('session_transfer_safety_normal', "Unable to transfer funds");
                        }
                    } else {
                        return redirect()->back()
                            ->with('session_transfer_safety_normal', "Unable to transfer funds");
                    }
                }
            } else {
                return redirect()->back()
                    ->with('session_transfer_safety_normal', "Not enough funds");
            }
        }
    }

    public function transferSafeBalance(Request $request)
    {

        if ($request->has('members__withdrawl__submit_safe')) {

            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                $err = "amount is required";
                return redirect()->back()
                    ->with('session_transfer_balance_safe', $err);
            } else {

                $prefix = "TRXWD";
                $maxdigits = '19';
                $randnum = '';
                while (strlen($randnum) < $maxdigits) {
                    $randnum .= mt_rand(0, 9);
                }

                $trans_id = $prefix."-".$randnum;

                // $frozen_balance = Auth::user()->balance()->frozen_agency_balance + $request->input('amount');
                // $agencybalance = Auth::user()->balance()->agency_balance - $request->input('amount');
                // $request['transaction_id'] = $trans_id;
                // $request['date_transacted'] = now();
                // $request['action_id'] = 30;
                // $request['before_balance'] = Auth::user()->balance()->agency_balance;
                // $request['amount'] = $request->input('amount');
                // $request['new_balance'] = $agencybalance;
                // $request['front_users_remarks'] = "Requested a Transfer Agency Balance" . " " . $request->input('amount');
                // $request['admin_remarks'] = "User Request to Transfer Agency Balance" . " " . $request->input('amount');

                // if ($agencybalance > 0) {

                //     if ($this->DepositAndWithdrawal->saveTransactions($request)) {

                //         if ($this->ControlBalance->updateAgencyBalance(Auth::user()->uid, $frozen_balance, $agencybalance)) {

                //             $desc = 'User Requested a Transfer Agency Balance with the amount of '.$request->input('amount').' to '.Auth::user()->username.'('.Auth::user()->uid.' ) Account';

                //             $this->ActivityLog->saveLogs($desc, $request->ip(), Auth::user()->uid, now(), 30, $request->getHost(), $request->header('User-Agent'));

                //             return redirect()->back()
                //                 ->with('message_transfer', "Successfully Transfered Balance");

                //         }
                //     }

                // }else {

                //     return redirect()->back()
                //         ->with('session_transfer_balance', 'O valor é maior que o saldo da agência');

                // }
            }
        }
    }

    // public function changepasswordVault(Request $request)
    // {

    //     // $inputs = $request->only(['input1', 'input2', 'input3']);
    //     // $concatenatedString = implode(' ', $inputs);

    //     // return redirect()->back()->with('session_notification', $msg);
    // }

    public function WithdrawalInfo(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {

                $uid = Auth::user()->uid;
                $user_info = $this->User_Info->getDetails($uid);

                return response()->json($user_info);

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }

    }

    public function LevelInfo(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {

                $matchedRank = self::UserLevel(Auth::user()->uid);

                $Rank = new Ranks();
                $level_info = $Rank->getDetails($matchedRank['level']);
                $withdrawal_info = $this->WithdrawalManagement->getWithdrawalManagement();

                $data = [
                    'level_info' => $level_info,
                    'minimum_withdrawal' => $withdrawal_info->minimum_withdrawal
                ];

                return response()->json(['status' => 200, 'data' => $data]);

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }

    }

    public function getPromoRecharge(Request $request){

        if ($request->ajax()) {

            if (Auth::user()->api_token == $request->input('_token')) {

                $promos = $this->PromotionRuleConfig->getPromorecharge();
                $promos = $this->filterTranslate->filterCustomTranslate2($promos, 'promo_recharge-', ['sub_type_name', 'name']);

                $today = date('Y-m-d');
                $discount_amount = [
                    'amount' => [],
                    'discount_amount' => [],
                    'name' => null,
                    'promotion' => null,
                    'calculation_method' => null
                ];

                foreach ($promos as $promo) {

                    $start_date = date('Y-m-d', strtotime($promo['event_start_time']));
                    $end_date = date('Y-m-d', strtotime($promo['event_end_time']));

                    if ($promo['event_end_time'] == NULL || ($today >= $start_date && $today <= $end_date)) {


                        if ($promo['benefits_subtype'] == 1 ) {

                            $discount_amount = self::processPromoRules($promo, $discount_amount);
                            break;

                        }elseif ($promo['benefits_subtype'] == 2 || $promo['benefits_subtype'] == 4 || $promo['benefits_subtype'] == 5) {

                            if ($promo['event_end_time'] == NULL) {
                                $check_recharge = Transactions::where('uid', Auth::user()->uid)->whereIn('action_id', [7, 26])->whereDate('date_transacted', '>=', $start_date)->count();
                            }else {
                                $check_recharge = Transactions::where('uid', Auth::user()->uid)->whereIn('action_id', [7, 26])->whereBetween('date_transacted', [$start_date, $end_date])->count();
                            }

                            if ($check_recharge < self::CheckRecharge($promo['benefits_subtype'])) {

                                $discount_amount = self::processPromoRules($promo, $discount_amount);
                                break;

                            }

                        }elseif ($promo['benefits_subtype'] == 3) {

                            if ($promo['event_end_time'] == NULL) {
                                $check_recharge = Transactions::where('uid', Auth::user()->uid)->WhereIn('action_id', [7, 26])->whereDate('date_transacted', '>=', $start_date)->count();
                            }else {
                                $check_recharge = Transactions::where('uid', Auth::user()->uid)->WhereIn('action_id', [7, 26])->whereBetween('date_transacted', [$start_date, $end_date])->count();
                            }

                            if ($check_recharge < self::CheckRecharge($promo['benefits_subtype'])) {

                                $discount_amount = self::processPromoRules($promo, $discount_amount);
                                break;

                            }

                        }elseif ($promo['benefits_subtype'] == 6 || $promo['benefits_subtype'] == 7 || $promo['benefits_subtype'] == 8 ) {

                            $check_recharge = Transactions::where('uid', Auth::user()->uid)->whereIn('action_id', [7, 26])->whereDate('date_transacted', $today)->count();


                            if ($check_recharge < self::CheckRecharge($promo['benefits_subtype'])) {

                                $discount_amount = self::processPromoRules($promo, $discount_amount);
                                break;

                            }

                        }

                    }

                }

                return response()->json($discount_amount);

            }else {

                return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

            }

        }else {

            return response()->json(['status' => 500, 'error' => 'Unauthenticated']);

        }

    }

    public static function CheckRecharge($benefits_subtype){

        switch ($benefits_subtype) {
            case 2:
                return 1;
            break;
            case 3:
                return 1;
            break;
            case 4:
                return 2;
            break;
            case 5:
                return 3;
            break;
            case 6:
                return 1;
            break;
            case 7:
                return 2;
            break;
            case 8:
                return 3;
            break;
        }

    }

   public static function processPromoRules($promo, $discount_amount){

        $getPromoRules = PromotionRuleConfig::where('promotion_id', $promo['promo_code_id'])->get()->toArray();
        $discount_amount['name'] = $promo['sub_type_name'];
        $discount_amount['promotion'] = $promo['promo_code_id'];
        $discount_amount['calculation_method'] = $promo['amount_calculation_method'];
        foreach ($getPromoRules as $getPromoRule) {

                $discount_amount['amount'][] = $getPromoRule['calculation_result'];
                $discount_amount['discount_amount'][] = ($promo['amount_calculation_method'] == 1) ? "+" . $getPromoRule['discount_amount_value'] . "%" : "+" . $getPromoRule['discount_amount_value'];

        }

        return $discount_amount;

    }

    public static function UserLevel($uid){
        $ranks = Ranks::get();
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
                    dd("b|".$percB);
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];
                $matched[] = [
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];

                continue;
            } else {
                if ($rank['total_deposits'] <= (int) $new_arry['total_deposit']) {
                    $percD = $rank['total_deposits'] != 0 ? ($rank['total_deposits'] / $new_arry['total_deposit']) * 100 : 0;
                    // $percD = 100;
                } elseif ($rank['total_deposits'] >= (int) $new_arry['total_deposit']) {
                    // $p = (int)((int)$new_arry['total_deposit'] / 100 * 100) > 100 ? 100 : (int)((int)$new_arry['total_deposit'] / 100 * 100);
                    // $percB = (int)$new_arry['total_deposit'] / (int)$rank['total_deposits'] *100;
                    $percB = $rank['total_deposits'] != 0 ? ((int) $new_arry['total_deposit'] / (int) $rank['total_deposits']) * 100 : 0;
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];
                $matched[] = [
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
                    'image_lvl' => "https://cdn.29bet.com/uat-images/memberlevels/".$rank['vip_level_badge'],
                ];

                break;
            }
            $cnt++;

        }
        // if array count is equal or less than 2

        if(count($matched) == 2){
            $matchedRank = $matched[0];

        }else{
            $matchedRank = $matchedRank[0];
        }

        return $matchedRank;

    }


    public static function WithdrawRemainingBalance($level_info, $Transactions, $uid){

        $first_withdraw = $Transactions->FirstWithdrawal($uid, 8);

        if (!is_null($first_withdraw)) {

            $first_recharge = date('Y-m', strtotime($first_withdraw->date_transacted));

            $startDate = DateTime::createFromFormat('Y-m', $first_recharge);
            $endDate = DateTime::createFromFormat('Y-m', $first_recharge)->modify("+". (int) $level_info->max_withdraw_amount_period_cover ."months");
            $currentMonth = DateTime::createFromFormat('Y-m', date('Y-m'));

            while ($startDate <= $endDate) {

                if ($currentMonth >= $startDate && $currentMonth <= $endDate) {

                    break;

                }

                $startDate = $startDate->modify("+". (int) $level_info->max_withdraw_amount_period_cover ."months");
                $endDate = $endDate->modify("+". (int) $level_info->max_withdraw_amount_period_cover ."months");

            }

            $monthDifference = $startDate->diff($currentMonth)->m;

            if ($monthDifference == 0) {

                $monthDifference++;

            }

            $max_amount = $level_info->max_withdraw_amount + ($level_info->monthly_free_withdrawal * $monthDifference);

            $total_withdraw = $Transactions->getTotalWithdraw($uid, [8, 12], [$startDate->format('Y-m'), $currentMonth->format('Y-m')]);
            $remaining_withdraw = $max_amount - $total_withdraw;
            // dd($startDate, $endDate, $currentMonth, $monthDifference, $max_amount, $total_withdraw, $remaining_withdraw);

            $response = [
                'max_amount' => $max_amount,
                'remaining_withdraw' => $remaining_withdraw
            ];

        }
        else {

            $max_amount = $level_info->max_withdraw_amount + $level_info->monthly_free_withdrawal;

            $response = [
                'max_amount' => $max_amount,
                'remaining_withdraw' => $max_amount
            ];

        }

        return $response;

    }

    public static function deviceDetected($device){

        if($device->isMobile()){
            return 'isMobile';
        }else{
            if($device->isDesktop()){
                return 'isDesktop';
            }else{
                if($device->isTablet()){
                    return 'isTablet';
                }else{
                    if($device->isPhone()){
                        return 'isPhone';
                    }else{
                        if($device->isRobot()){
                            return 'isRobot';
                        }else{
                            return 'unknown';
                        }
                    }
                }
            }
        }
    }

    public static function browserDetected($device) {
        if( $device->isChrome() ){
            return 'isChrome';
        }else{
            if( $device->isFirefox() ){
                return 'isFirefox';
            }else{
                if( $device->isSafari() ){
                    return 'isSafari';
                }else{
                    if( $device->isOpera() ){
                        return 'isOpera';
                    }else{
                        if( $device->isIE() ){
                            return 'isIE';
                        }else{
                            return browser();
                        }
                    }
                }
            }
        }
    }

    public static function TransactionID(){

        $transid_unique = false;

        while (!$transid_unique) {

            $prefix = "TRXWD";
            $maxdigits = '19';
            $randnum = '';
            while (strlen($randnum) < $maxdigits) {
                $randnum .= mt_rand(0, 9);
            }

            $trans_id = $prefix."-".$randnum;

            $exist = DepositAndWithdrawal::where('transaction_id', $trans_id)->first();
            $exist1 = Transactions::where('transaction_id', $trans_id)->first();
            $exist2 = PromotionDiscount::where('transaction_id', $trans_id)->first();

            if (!$exist || !$exist1 || !$exist2) {
                $transid_unique = true;
            }

        }

        return $trans_id;

    }

}
