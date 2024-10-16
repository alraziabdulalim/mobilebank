<?php

namespace App\Controllers;

use App\Models\Transaction;

class TransactionController
{
    public function deposit($request)
    {
        $link = [];
        $transType = 'deposit';
        $link['back'] = '../customer/deposit';
        $link['go'] = '../customer';

        $this->formValidation($request, $transType, $link);
    }

    public function withdraw($request)
    {
        $link = [];
        $transType = 'withdraw';
        $link['back'] = '../customer/withdraw';
        $link['go'] = '../customer';
        $balance = $request['balance'];
        $amount = $request['amount'];

        if($balance - $amount >= 0){

            $this->formValidation($request, $transType, $link);
        }
        $_SESSION['message'] = 'Balance is not sufficient!';

        return redirect($link['back']);
    }

    public function transfer($request)
    {
        $link = [];
        $transType = 'transfer';
        $link['back'] = '../customer/transfer';
        $link['go'] = '../customer';
        $balance = $request['balance'];
        $amount = $request['amount'];

        if($balance - $amount >= 0){

            $this->formValidation($request, $transType, $link);
        }
        $_SESSION['message'] = 'Balance is not sufficient!';
        
        return redirect($link['back']);
    }

    public function formValidation($request, $transType, $link)
    {
        $newRequest = [];
        $sanitizedRequest = [];
        $errors = [];

        $sanitizedRequest['amount'] = solidAmountValidity($request['amount'], $errors);

        if(isset($request['email'])){
            $sanitizedRequest['email'] = sanitizedEmail($request['email'], $errors);
        }else{
            $sanitizedRequest['email'] = 'self';
        }

        if (empty($errors) && !empty($sanitizedRequest['amount']) && !empty($sanitizedRequest['email'])) {
            $newRequest['user_id'] = $_SESSION['user']['id'];
            $newRequest['pay_to'] = $sanitizedRequest['email'];
            $newRequest['amount'] = $sanitizedRequest['amount'];
            $newRequest['trans_type'] = $transType;
            $newRequest['status'] = 'success';

            $this->transactionTry($newRequest, $link);
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['sanitizedRequest'] = $request['amount'];

            return redirect($link['back']);
        }
    }

    public function transactionTry($newRequest, $link)
    {
        try {
            $transaction = new Transaction();
            $newTransaction = $transaction->create($newRequest);

            if ($newTransaction) {
                $_SESSION['message'] = 'Successfull Deposit.';

                return redirect($link['go']);
            } else {
                $_SESSION['message'] = 'Deposit Unsuccessful!';

                return redirect($link['back']);
            }
        } catch (\Exception $e) {
            $_SESSION['errors'] = ['email' => $e->getMessage()];

            return redirect($link['back']);
        }
    }
}