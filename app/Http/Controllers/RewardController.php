<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LevelAchievementBonus;
use App\Models\AgentReferralParams;
use App\Models\ActivityLog;
use App\Models\Transactions;
use App\Models\ControlBalance;
use App\Models\ActionType;
use Illuminate\Support\Facades\Auth;
use App\Models\LevelBonusAchievement;
use App\Models\LevelVIPBonusClaimed;
use App\Models\PromotionDiscount;
use App\Models\Admin\DepositAndWithdrawalConfig;
use Illuminate\Support\Facades\DB;

// use App\Models\LevelVIPBonusClaimed;
class RewardController extends Controller
{
    private $User;
    private $LevelAchievementBonus;
    private $AgentReferralParams;
    private $ActivityLog;
    private $transactions;
    private $ControlBalance;
    private $LevelBonusAchievement;
    private $LevelVIPBonusClaimed;
    private $ActionType;
    private $WithdrawalManagement;
    private $PromotionDiscount;

    public function __construct(User $User,LevelAchievementBonus $LevelAchievementBonus, AgentReferralParams $AgentReferralParams, ActivityLog $ActivityLog, Transactions $transactions, ControlBalance $ControlBalance,LevelBonusAchievement $LevelBonusAchievement,LevelVIPBonusClaimed $LevelVIPBonusClaimed){
        $this->User = $User;
        $this->LevelAchievementBonus = $LevelAchievementBonus;
        $this->AgentReferralParams = $AgentReferralParams;
        $this->ActivityLog = $ActivityLog;
        $this->transactions = $transactions;
        $this->ControlBalance = $ControlBalance;
        $this->LevelBonusAchievement = $LevelBonusAchievement;
        $this->LevelVIPBonusClaimed = $LevelVIPBonusClaimed;
        $this->ActionType = new ActionType();
        $this->WithdrawalManagement = new DepositAndWithdrawalConfig();
        $this->PromotionDiscount = new PromotionDiscount();
       
    }

    public function getLevelAchievement(Request $request)
    {
        if( $request->ajax() ){
            
            if( $this->User->pullApiToken() == $request->input('_token') ) {

                $generated_trans_id = $this->LevelAchievementBonus->generateLvlAchievenCode();

                // $user_balance = ControlBalance::where('')->first()

                $checkTransaction = $this->PromotionDiscount->checkAgencyReferralReward(Auth::user()->uid, $request->input('id'));

                if ($checkTransaction < 1) {

                    $refer_details = $this->AgentReferralParams->getReferralDetails($request->input('id'));
                    $ReferralCount = DB::table('user_referrals')
                        ->select(DB::raw('COUNT(*) as guests'))
                        ->join('users', 'user_referrals.users_id', '=', 'users.uid')
                        ->join('transactions', 'user_referrals.users_id', '=', 'transactions.uid')
                        ->whereIn('transactions.action_id', [7, 26])
                        ->where('user_referrals.referral_id', '=', Auth::user()->referral_no)
                        ->first();
    
                    if ($ReferralCount->guests >= $refer_details->referral_count) {
    
                        $request['uid'] = Auth::user()->uid;
                        $request['transaction_id'] = $generated_trans_id;
                        $request['game_id'] = NULL;
                        $request['game_provider'] = NULL;
                        $request['agent_level'] = NULL;
                        $request['promo_code_id'] = 'AgencyReferral-'.$request->input('id');
                        $request['promotion_name'] = NULL;
                        $request['event_start'] = NULL;
                        $request['event_end'] = NULL;
                        $request['before_balance'] = Auth::user()->balance()->control_balance;
                        $request['amount'] = $refer_details->reward_value;
                        $request['balance_type_id'] = 3;
                        $request['description'] = $refer_details->description;
                        $request['for_user_remarks'] = 'Claimed '.$refer_details->description. 'With The Amount of '.$refer_details->reward_value;
                        $request['admin_remarks'] = 'User Claimed '.$refer_details->description. 'With The Amount of '.$refer_details->reward_value;
                        $request['system_remarks'] = 'User Claimed '.$refer_details->description. 'With The Amount of '.$refer_details->reward_value;
                        $request['action_id'] = 16;
                        $request['transaction_type'] = $this->ActionType->getActionDescription(16);
                        $request['operator_uid'] = NULL;
                        $request['claimed_ip'] = $request->ip();
    
                        if( $this->ControlBalance->updateBalance(Auth::user()->uid,$refer_details->reward_value)){
        
        
                            $request['new_amount'] = $this->ControlBalance->computeControlBalance(Auth::user()->uid);
        
                            if( $this->LevelAchievementBonus->saveClaimedAchievementBonus($request) ){
            
                                 if( $this->PromotionDiscount->savePromotionDiscount($request) ){
                                    if( $this->ActivityLog->saveTransactionParam($request) ){
                                        return response()->json([
                                            'success' => __("Successfull Request"),
                                            'message' => __("Successfully Claimed")
                                        ], 200); 
                                    }else {
                                        return response()->json([
                                            'error' => __("Bad Request"),
                                            'message' => __("Invalid Request")
                                        ], 400); 
                                    }
                                  }else{
                                    return response()->json([
                                        'error' => __("Bad Request"),
                                        'message' => __("Invalid Request")
                                    ], 400); 
                                  }   
                                
                            }else{
                                return response()->json([
                                    'error' => __("Bad Request"),
                                    'message' => __("Invalid Request")
                                ], 400); 
                            }
                            
                        }else{
            
                            return response()->json([
                                'error' => __("Bad Request"),
                                'message' => __("Invalid Request")
                            ], 401);  
            
                        }
                    }else {
                        return response()->json([
                            'error' => __("Bad Request"),
                            'message' => __("Invalid Request")
                        ], 401);  
                    }

                }else {

                    return response()->json([
                        'error' => __("Bad Request"),
                        'message' => __("Invalid Request")
                    ], 401);  

                }

            }
                
           
        }else{
            //  
        }
        
    }

    public function getLevelVIPBonus(Request $request) {
        if( $request->ajax() ){
            if( $this->User->pullApiToken() == $request->input('_token') ) {
                
                $generated_trans_id = $this->LevelAchievementBonus->generateLvlAchievenCode();
                $query = $this->ControlBalance->getBalance(Auth::user()->uid);
                $withdrawal_mangement = $this->WithdrawalManagement->getWithdrawalManagement();
                $refer_details = $this->LevelBonusAchievement->getDetailslevel_vip_bonus($request->input('id'));  
                $rollover_multiplier = $withdrawal_mangement['rollover_multiplier'];
           
                $request['description'] = "Reach VIP Level ".$request->input('id');
                $request['amount'] = $refer_details->discount_amount; 
                $request['transaction_id'] = $generated_trans_id;
                $request['transaction_type'] = $this->ActionType->getActionDescription(17);
                $request['date_transacted'] = now();
                $request['before_balance'] = Auth::user()->balance()->control_balance;
                $request['action_id'] = 17;
                $request['new_balance'] = bcadd($refer_details->discount_amount,Auth::user()->balance()->control_balance);
                $request['level'] = $request->input('id'); 
                $new_rollover = ($refer_details->discount_amount * $rollover_multiplier) + $query['rollover_balance'];

                if (is_null($this->LevelVIPBonusClaimed->checkClaimedVIPBonus($request['level']))) {

                    if( $this->LevelVIPBonusClaimed->saveClaimedVIPBonus($request) ){
                        
                        if( $this->transactions->saveTransactions($request) ){
                               if( $this->ControlBalance->updateDiscountBalance(Auth::user()->uid, $query['discount_balance'] + $refer_details->discount_amount, $new_rollover)){
                                   if( $this->ActivityLog->saveTransactionParam($request) ){
                                       return response()->json([
                                           'success' => __('Successfull Request'),
                                           'message' => __('Successfully Claimed')
                                       ], 200); 
                                   }
                               } 
                        }else{

                            return response()->json([
                                'error' => __('Bad Request'),
                                'message' => __('Invalid Request')
                            ], 400); 

                        }   
                       
                   }else{

                       return response()->json([
                           'error' => __('Bad Request'),
                           'message' => __('Invalid Request')
                       ], 400); 

                   }

                }else {

                    return response()->json([
                        'error' => __('Bad Request'),
                        'message' => __('Invalid Request')
                    ], 400); 

                }

            }else{

                return response()->json([
                    'error' => __('Bad Request'),
                    'message' => __('Unauthorized')
                ], 401);  

            }    
            
        }

    }

}
