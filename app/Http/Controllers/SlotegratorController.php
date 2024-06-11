<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\GameList;
use App\Models\ControlBalance;
use App\Models\SlotegratorGamesAccess;
use App\Models\GameHistory;
use App\Models\Admin\DepositAndWithdrawal;
use App\Models\Transactions;
use App\Models\PromotionDiscount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SlotegratorController extends Controller
{
    
    private $MerchantId = 'e15e95d35bba81a98d6f53a6f55c9b87';
    private $MerchantKey = '67f91b1b8a8685b2d02084e87351a34ebfdbbeeb';
    private $SlotegratorGamesAccess;
    private $User;
    private $ControlBalance;
    private $GameList;
    private $GameHistory;

    public function __construct() {
        $this->SlotegratorGamesAccess = new SlotegratorGamesAccess();
        $this->User = new User();
        $this->ControlBalance = new ControlBalance();
        $this->GameList = new GameList();
        $this->GameHistory = new GameHistory();
    }

    public function SlotegratorApi(Request $request){

        $requestBody = file_get_contents("php://input");
        $requestHeaders = getallheaders();
        $validateMerchantID = $this->ValidateMerchantID($requestHeaders);
        $validateSign = $this->ValidateSign($requestHeaders, $requestBody);
        
        if ( $validateMerchantID == true ) {

            if ( empty($validateSign) ) {
                
                
                $data = array();
                parse_str($requestBody, $data);
                $validatePlayerSession = $this->ValidatePlayerSession($requestBody);
                if ($validatePlayerSession == true) {

                    if ($data['action'] == 'balance') {

                        $response = $this->PlayerBalance($data['player_id']);

                    }elseif ($data['action'] == 'bet') {

                        $response = $this->PlayerBet($requestBody);

                    }elseif ($data['action'] == 'win') {

                        $response = $this->PlayerWin($requestBody);

                    }elseif ($data['action'] == 'refund') {

                        $response = $this->PlayerRefund($requestBody);

                    }elseif ($data['action'] == 'rollback') {
                        
                        $response = $this->PlayerRollback($requestBody);

                    }

                }else {
            
                    $response = $validatePlayerSession;

                }

            }else {

                $response = $validateSign;

            }

        }else {
            
            $response = $validateMerchantID;

        }

        $this->SaveRequest($requestBody, $requestHeaders, $response);
                
        return response()->json($response, 200);

    }

    private function PlayerBalance($player_id){

        $balance = $this->ControlBalance->getUserBalance($player_id);
        if ($balance != null) {

            $response = ['balance' => $balance];

            return $response;

        }else {

            $response = [
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'Failed to get the balance of the player'
            ];

            return $response;

        }


    }

    private function PlayerBet($requestBody){

        $validateDuplicate = $this->ValidateTransactionID($requestBody);

        if ($validateDuplicate != null) {

            return json_decode($validateDuplicate, true);

        }

        $data = array();
        parse_str($requestBody, $data);
        $CheckGames = $this->GameValidation($data['game_uuid']);
        $transaction_id = $this->TransactionID();

        if ($CheckGames) {

            $balance = floatval($this->ControlBalance->getUserBalance($data['player_id']));
            $amount = $data['amount'];
    
            if ($balance >= $amount) {
    
                $game_id = $data['game_uuid'];
                $provider = $this->GameList->getGameBy('game_id', $game_id);
                $saveGameHistory = $this->GameHistory->SaveBetSlotegrator($data, $provider, $transaction_id);
    
                if ($saveGameHistory) {
    
                    $response = [
                        'balance' => $saveGameHistory,
                        'transaction_id' => $transaction_id
                    ];
    
                    return $response;
    
                }else {
    
                    $response = [
                        'error_code' => 'INTERNAL_ERROR',
                        'error_description' => 'Failed to save bet transactions'
                    ];
        
                    return $response;
    
                }

            }else {
                
                $game_id = $data['game_uuid'];
                $provider = $this->GameList->getGameBy('game_id', $game_id);
                $saveGameHistory = $this->GameHistory->SaveInternalErrorGames($data, $provider, $transaction_id);
    
                if ($saveGameHistory) {
    
                    $response = [
                        'error_code' => 'INSUFFICIENT_FUNDS',
                        'error_description' => 'Not enough money to continue playing'
                    ];
        
                    return $response;
    
                }else {
    
                    $response = [
                        'error_code' => 'INTERNAL_ERROR',
                        'error_description' => 'Failed to save bet transactions'
                    ];
        
                    return $response;
    
                }
    
            }

        }else {

            $response = $this->GetUserBalance($data['player_id'], $transaction_id);

            return $response;

        }

    }

    private function PlayerWin($requestBody){

        $validateDuplicate = $this->ValidateTransactionID($requestBody);

        if ($validateDuplicate != null) {

            return json_decode($validateDuplicate, true);

        }
        
        $data = array();
        parse_str($requestBody, $data);
        $CheckGames = $this->GameValidation($data['game_uuid']);
        $transaction_id = $this->TransactionID();
        if ($CheckGames) {

            if ($data['amount'] >= 0) {
    
                $game_id = $data['game_uuid'];
                $provider = $this->GameList->getGameBy('game_id', $game_id);
                $saveGameHistory = $this->GameHistory->SaveWinSlotegrator($data, $provider, $transaction_id);
        
                if ($saveGameHistory) {
        
                    $response = [
                        'balance' => $saveGameHistory,
                        'transaction_id' => $transaction_id
                    ];
        
                    return $response;
        
                }else {
        
                    $response = [
                        'error_code' => 'INTERNAL_ERROR',
                        'error_description' => 'Failed to save win transactions'
                    ];
        
                    return $response;
        
                }
    
            }else {
                
                $response = $this->GetUserBalance($data['player_id'], $transaction_id);
    
                return $response;
                
            }

        }else {
            
            $response = $this->GetUserBalance($data['player_id'], $transaction_id);

            return $response;

        }

    }

    private function PlayerRefund($requestBody){

        $data = array();
        parse_str($requestBody, $data);
        $transaction_id = $this->TransactionID();
        if (isset($data['round_id'])) {

            $validateDuplicate = $this->ValidateTransactionID($requestBody);
            
            if ($validateDuplicate != null) {
    
                return json_decode($validateDuplicate, true);
    
            }

        }else {

            // $validateDuplicate = $this->SlotegratorGamesAccess->FindProviderTransactionID($data);
            // if ($validateDuplicate != null) {
            //     return json_decode($validateDuplicate['response'], true);
            // }
            
            $CheckGames = $this->GameValidation($data['game_uuid']);


            if ($CheckGames) {
        
                $FindBetTransaction = $this->SlotegratorGamesAccess->FindTransactionID($data);
                
                if ($FindBetTransaction != null) {

                    $TransactionData = array();
                    $DataBetTransaction = trim($FindBetTransaction['request_body'], '"');
                    parse_str($DataBetTransaction, $TransactionData);
                    
                    if ($data['amount'] < 1) {

                        $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                        return $response;

                    }

                    if ($TransactionData['action'] == "bet") {
                        
                        $TransactionData = array();
                        $DataBetTransaction = trim($FindBetTransaction['request_body'], '"');
                        parse_str($DataBetTransaction, $TransactionData);

                        if ($TransactionData['action'] == "bet") {
        

                                $game_id = $data['game_uuid'];
                                $provider = $this->GameList->getGameBy('game_id', $game_id);
                                $saveGameHistory = $this->GameHistory->SaveRefundSlotegrator($data, $provider, $transaction_id);

                                if ($saveGameHistory) {
                        
                                    $response = [
                                        'balance' => $saveGameHistory,
                                        'transaction_id' => $transaction_id
                                    ];

                                    return $response;
                        
                                }else {
                        
                                    $response = [
                                        'error_code' => 'INTERNAL_ERROR',
                                        'error_description' => 'Failed to save refund transactions'
                                    ];
                        
                                    return $response;
                        
                                }
        
                        }else {

                            $response = $this->GetUserBalance($data['player_id'], $transaction_id);
            
                            return $response;

                        }

                    }else {

                        $response = $this->GetUserBalance($data['player_id'], $transaction_id);
        
                        return $response;

                    }


                }else {

                    $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                    return $response;

                }
            
            }else {

                $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                return $response;

            }

            // $FindBetTransaction = $this->SlotegratorGamesAccess->FindTransactionID($data);

            // return json_decode($FindBetTransaction['response'], true);
            // $response = $this->GetUserBalance($data['player_id'], $transaction_id);

            // return $response;

        }
        
        $CheckGames = $this->GameValidation($data['game_uuid']);


        if ($CheckGames) {
    
            $FindBetTransaction = $this->SlotegratorGamesAccess->FindTransactionID($data);
            
            if ($FindBetTransaction != null) {

                $TransactionData = array();
                $DataBetTransaction = trim($FindBetTransaction['request_body'], '"');
                parse_str($DataBetTransaction, $TransactionData);
                
                if ($data['amount'] < 1) {

                    $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                    return $response;

                }
                
                $ValidateRoundID = $this->RoundIDValidation($data['round_id']);
                if ( $ValidateRoundID != null) {

                    $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                    return $response;

                }

                if ($TransactionData['action'] == "bet") {
                    
                    $TransactionData = array();
                    $DataBetTransaction = trim($FindBetTransaction['request_body'], '"');
                    parse_str($DataBetTransaction, $TransactionData);

                    $game_history = $this->GameHistory->FindProviderTransactionID($data, $TransactionData['round_id']);

                    if ($game_history == null) {

                        $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                        return $response;

                    }

                    if ($TransactionData['action'] == "bet") {
    
                        if ($game_history['operation_type'] == 11 || $game_history['operation_type'] == "11") {

                            $game_id = $data['game_uuid'];
                            $provider = $this->GameList->getGameBy('game_id', $game_id);
                            $saveGameHistory = $this->GameHistory->SaveRefundSlotegrator($data, $provider, $transaction_id);

                            if ($saveGameHistory) {
                    
                                $response = [
                                    'balance' => $saveGameHistory,
                                    'transaction_id' => $transaction_id
                                ];

                                return $response;
                    
                            }else {
                    
                                $response = [
                                    'error_code' => 'INTERNAL_ERROR',
                                    'error_description' => 'Failed to save refund transactions'
                                ];
                    
                                return $response;
                    
                            }

                        }else {

                            $response = $this->GetUserBalance($data['player_id'], $transaction_id);
            
                            return $response;

                        }
    
                    }else {

                        $response = $this->GetUserBalance($data['player_id'], $transaction_id);
        
                        return $response;

                    }

                }else {

                    $response = $this->GetUserBalance($data['player_id'], $transaction_id);
    
                    return $response;

                }


            }else {

                $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                return $response;

            }
        
        }else {

            $response = $this->GetUserBalance($data['player_id'], $transaction_id);

            return $response;

        }

    }

    private function PlayerRollback($requestBody){

        $data = array();
        parse_str($requestBody, $data);
        $transaction_id = $this->TransactionID();

        $validateDuplicate = $this->ValidateTransactionID($requestBody);

        if ($validateDuplicate != null) {

            return json_decode($validateDuplicate, true);

        }

        $CheckGames = $this->GameValidation($data['game_uuid']);
        $RollBackTransaction = [];

        if ($CheckGames) {

            foreach ($data['rollback_transactions'] as $rollback) {
                
                $history = $this->SlotegratorGamesAccess->FindRollbackTransaction($rollback['transaction_id']);
                if ($history != NULL) {

                    if ($rollback['action'] == 'bet') {
    
                        $game_id = $data['game_uuid'];
                        $provider = $this->GameList->getGameBy('game_id', $game_id);        
                        $saveGameHistory = $this->GameHistory->SaveBetRollbackSlotegrator($data, $provider, $transaction_id, $history, $rollback['amount']);
            
                        if (!$saveGameHistory) {
            
                            $response = [
                                'error_code' => 'INTERNAL_ERROR',
                                'error_description' => 'Failed to save rollback transactions'
                            ];
                
                            return $response;
            
            
                        }else {
                            $RollBackTransaction[] = $rollback['transaction_id'];
                        }
    
                    }else {
    
    
                        $game_id = $data['game_uuid'];
                        $provider = $this->GameList->getGameBy('game_id', $game_id);
                        $saveGameHistory = $this->GameHistory->SaveWinRollbackSlotegrator($data, $provider, $transaction_id, $history, $rollback['amount']);
            
                        if (!$saveGameHistory) {
            
                            $response = [
                                'error_code' => 'INTERNAL_ERROR',
                                'error_description' => 'Failed to save rollback transactions'
                            ];
                
                            return $response;
            
            
                        }else {
                            $RollBackTransaction[] = $rollback['transaction_id'];
                        }
    
                    }
                    
                }else {

                    $response = $this->GetUserBalance($data['player_id'], $transaction_id);

                    return $response;

                }

            }

            $response = $this->GetUserBalance($data['player_id'], $transaction_id);
            $response['rollback_transactions'] = $RollBackTransaction;

            return $response;

        }else {

            $response = [
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'This game is not in the list.'
            ];

            return $response;

        }

    }

    public function SaveRequest($body, $header, $response){

        $save = $this->SlotegratorGamesAccess->SaveRequest(json_encode($body), json_encode($header), json_encode($response));

        return $save; 

    }

    public function ValidatePlayerSession($requestBody){

        $data = array();
        parse_str($requestBody, $data);
        $user = $this->User->findUserPlayer($data['player_id']);

        if ($user != NULL) {

            if ($user['guid'] == $data['session_id']) {

                if ($data['currency'] == 'BRL') {

                    return true;

                }else {

                    $response = [
                        'error_code' => 'INTERNAL_ERROR',
                        'error_description' => 'Currency used is not match'
                    ];

                    return $response;

                }

            }else {

                $response = [
                    'error_code' => 'INTERNAL_ERROR',
                    'error_description' => 'Player session expired'
                ];
    
                return $response;

            }

        }else {

            $response = [
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'Player is not present in our data'
            ];

            return $response;

        }

    }

    public function ValidateMerchantID($header){

        if (isset($header['X-Merchant-Id'])) {

            if ($header['X-Merchant-Id'] == $this->MerchantId) {
                
                return true;

            }else {

                $response = [
                    'error_code' => 'INTERNAL_ERROR',
                    'error_description' => 'Merchant ID is not match'
                ];
                
                return $response;

            }

        }else {

            $response = [
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'Merchant ID is not present in the request'
            ];

            return $response;

        }

    }

    public function ValidateTransactionID($requestBody){

        $data = array();
        parse_str($requestBody, $data);
        $access = $this->SlotegratorGamesAccess->checkDuplicate($data);

        if ($access != null) {
            return $access['response'];
        }else {
            return null;
        }

    }

    private function RoundIDValidation($round_id){

        $access = $this->SlotegratorGamesAccess->checkRoundID($round_id);

        if ($access != null) {
            $game_history = $this->GameHistory->FindRoundID($round_id);
            if ($game_history['operation_type'] == 11 || $game_history['operation_type'] == "11") {
                return null;
            }else {
                return $access['response'];
            }
        }else {
            return null;
        }

    }

    private function TransactionID(){
        
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
    
    private function ValidateSign($requestHeaders, $requestBody){

        $merchantKey = $this->MerchantKey;
        $headers1 = [
        'X-Merchant-Id' => $this->MerchantId,
        'X-Timestamp' => $requestHeaders['X-Timestamp'],
        'X-Nonce' => $requestHeaders['X-Nonce'],
        ];

        $data = array();
        parse_str($requestBody, $data);
        $mergedParams = array_merge($data, $headers1);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);
        $XSign = hash_hmac('sha1', $hashString, $merchantKey);

        if ($XSign == $requestHeaders['X-Sign']) {

            return [];

        }else {

            $response = [
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'Signature is not match'
            ];
            
            return $response;

        }

    }

    private function GameValidation($game_id){

        $CheckGames = $this->GameList->checkGamesID($game_id);

        return $CheckGames;

    }

    private function GetUserBalance($player_id, $transaction_id){

        $newBalance = $this->ControlBalance->getUserBalance($player_id);
        $response = [
            'balance' => $newBalance,
            'transaction_id' => $transaction_id
        ];

        return $response;

    }

}

?>