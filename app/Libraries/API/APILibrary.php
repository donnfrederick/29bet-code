<?php 

namespace App\Libraries\API;
use			Illuminate\Support\Facades\Auth;
use			Exception;
use			ErrorException;
use App\Models\User;
use App\Models\PaymentResponse;
use App\Models\User_Info as User_Info;
use App\Models\ControlBalance;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
use App\Models\Ranks as Rank;
use App\Models\Transactions as Transactions;
use App\Models\GameHistory as GameHistory;
use DateTime;

class APILibrary
{

    // public static function WithdrawalMethod($data, $request){

    //     $uid = Auth::user()->uid;
    //     $ControlBalance = new ControlBalance();
    //     $query = $ControlBalance->getBalance($uid);
    //     $Rank = new Rank();
    //     $level_info = $Rank->getDetails($data['user_level']);
    //     $Transactions = new Transactions();
    //     $remaining = self::WithdrawRemainingBalance($level_info, $Transactions, $uid);

    //     if ($query['normal_balance'] >= $data['amount']) {

    //         if ($data['amount'] >= 50 && $data['amount'] <= $remaining['remaining_withdraw']) {
                
    //             $withdrawal_fee = $data['amount'] * ($level_info->withdrawal_rate / 100);
                
    //             $user = new User();
    //             $query = $user->select('api_token')
    //             ->where('uid', '=', $uid)
    //             ->first();
    //             $token = $query->api_token;
                
    //             $device = new Agent();
    //             $userAgent = $request->header('User-Agent');
    //             $device->setUserAgent($userAgent);
                
    //             $APIBody = json_encode([
    //                 "uid"=> $uid,
    //                 "amount"=> $data['amount'],
    //                 "withdraw_fee"=> $withdrawal_fee,
    //                 "ip_address" => $request->ip(),
    //                 'account_name' => $data['account_name'],
    //                 'account_number' => $data['account_number'],
    //                 'display_type' => $device->device(),
    //                 'browser' => $device->browser(),
    //                 'domain' => $request->getHost(),
    //                 'client' => $userAgent
    //             ]);
    //             $curl = curl_init();
    
    //             curl_setopt_array($curl, [
    //                 CURLOPT_URL => 'https://test-payment.29bet.com/api/withdrawal_request',
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_ENCODING => '',
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 0,
    //                 CURLOPT_FOLLOWLOCATION => true,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => 'POST',
    //                 CURLOPT_POSTFIELDS =>$APIBody,
    //                 CURLOPT_HTTPHEADER => [
    //                     'Content-Type: application/json',
    //                     'Authorization: Bearer '. $token
    //                 ],
    //             ]);
                
    //             $response = curl_exec($curl);
    //             curl_close($curl);

    //             return $response;

    //         }else {
    
    //             $response = json_encode([
    //                 'title' => 'error_title',
    //                 'title_message' => 'Erro de solicitação de retirada sem sucesso',
    //                 'body' => 'error_message',
    //                 'body_message' => 'O valor total do saque incluindo o saque solicitado deve ser menor ou igual a R$  '.$remaining['max_amount'].'  com o valor mínimo de R$ 50.'
    //             ]);
    
    //             return json_decode($response, true);

    //         }

    //     }else {

    //         $response = json_encode([
    //             'title' => 'error_title',
    //             'title_message' => 'Erro de solicitação de retirada sem sucesso',
    //             'body' => 'error_message',
    //             'body_message' => 'O valor de entrada está excedendo seu saldo'
    //         ]);

    //         return json_decode($response, true);

    //     }
            
    // }

    public static function DepositMethod($data){
        
        $uid = Auth::user()->uid;
        $user = new User();
        $user_info = new User_Info();
        $query = $user->select('api_token')
        ->where('uid', '=', $uid)
        ->first();
        $token = $query->api_token;
        $query_info = $user_info->getDetails($uid);

        if ($query_info->number_id != null) {

            $account_number = $query_info->number_id;

        }elseif ($query_info->mobile_number != null && $query_info->number_id == null) {

            $account_number = $query_info->mobile_number;

        }elseif ($query_info->email != null && $query_info->number_id == null && $query_info->mobile_number == null) {

            $account_number = $query_info->email;

        }elseif ($query_info->email == null && $query_info->number_id == null && $query_info->mobile_number == null) {

            return ['response' => [], 'status' => 1000];

        }
        
        $APIBody = json_encode([
            "uid"=> $uid,
            "amount"=> $data['deposit_amount'],
            'account_number' => $account_number,
            'email' => $query_info->email,
            'phone_number' => $query_info->mobile_number,
            'user_token' => $token,
            'user_ip' => $data['user_ip'],
            'user_domain' => $data['user_domain'],
            'user_client' => $data['user_client'],
            'user_display' => $data['user_display'],
            'user_browser' => $data['user_browser'],
            'promo_code_id' => $data['promotion'],
            'accumulated_discount' => $data['accumulated_discount']
        ]);
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://uat-payment.29bet.com/api/deposit',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$APIBody,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer '. $token
            ],
        ]);
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        if (curl_errno($curl)) {
            return curl_error($curl);
        }

        $PaymentResponse = new PaymentResponse();
        $max_length = 42949672;
        $long_text = $response;
        if (strlen($long_text) > $max_length) {
            $long_text = substr($long_text, 0 ,$max_length);
        }

        if ($PaymentResponse->saveReponse($uid, $APIBody, $long_text, now())) {

            return ['response' => $response, 'status' => 200];

        }else {

            return ['response' => [], 'status' => 1001];

        }
        
    }

    // public static function CallbackMethod($uid, $amount){

    //     $user = new User();
    //     $query = $user->select('api_token')
    //     ->where('uid', '=', $uid)
    //     ->first();
    //     $token = $query->api_token;

    //     $APIBody = json_encode([
    //         "uid"=> $uid,
    //         "amount"=> $amount
    //     ]);
    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => 'http://test.29betapi.com/api/callback',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS =>$APIBody,
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: application/json',
    //             'Authorization: Bearer '. $token
    //         ],
    //     ]);
        
    //     $response = curl_exec($curl);
        
    //     curl_close($curl);

    //     return $response;

    // }

    public static function WithdrawRemainingBalance($level_info, $Transactions, $uid){

        $first_withdraw = $Transactions->FirstWithdrawal($uid, 8);
        if (!is_null($first_withdraw)) {$first_recharge = date('Y-m', strtotime($first_withdraw->date_transacted));

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
            dd($startDate, $endDate, $currentMonth, $monthDifference, $max_amount, $total_withdraw, $remaining_withdraw);
    
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

}

?>