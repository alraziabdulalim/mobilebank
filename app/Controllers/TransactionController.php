<?php

namespace App\Controllers;

use App\Models\Transaction;

class TransactionController
{
    public function deposit($request)
    {
        $this->processTransaction($request, 'deposit', '/create-deposit');
    }

    public function withdraw($request)
    {
        $userId = $_SESSION['user']['id'];
        $balance = accountBalance($userId);
        $amount = $request['amount'];

        if ($this->hasSufficientBalance($balance, $amount)) {
            $this->processTransaction($request, 'withdraw', '/create-withdraw');
        } else {
            $_SESSION['message'] = 'Balance is not sufficient!';
            return redirect('/withdraw');
        }
    }

    public function transfer($request)
    {
        if (!isset($request['email'])) {
            $_SESSION['errors']['email'] = 'Email required!';
            return redirect('/transfer');
        }
        $userId = $_SESSION['user']['id'];
        $balance = accountBalance($userId);
        $amount = $request['amount'];

        if ($this->hasSufficientBalance($balance, $amount)) {
            $this->processTransaction($request, 'transfer', '/create-transfer');
        } else {
            $_SESSION['message'] = 'Balance is not sufficient!';
            return redirect('/transfer');
        }
    }

    private function processTransaction($request, $transType, $backLink)
    {
        $link = [
            'back' => $backLink,
            'go' => '/dashboard'
        ];

        $this->formValidation($request, $transType, $link);
    }

    private function formValidation($request, $transType, $link)
    {
        $errors = [];
        $sanitizedRequest = [
            'amount' => solidAmountValidity($request['amount'], $errors),
            'email' => isset($request['email']) ? sanitizedEmail($request['email'], $errors) : 'self'
        ];

        if (empty($errors) && $sanitizedRequest['amount'] && $sanitizedRequest['email']) {
            $newRequest = [
                'user_id' => $_SESSION['user']['id'],
                'pay_to' => $sanitizedRequest['email'],
                'amount' => $sanitizedRequest['amount'],
                'trans_type' => $transType,
                'status' => 'success'
            ];

            $this->transactionTry($newRequest, $link);
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['sanitizedRequest'] = $request['amount'];
            return redirect($link['back']);
        }
    }

    private function transactionTry($newRequest, $link)
    {
        try {
            $transaction = new Transaction();
            $newTransaction = $transaction->create($newRequest);

            $_SESSION['message'] = $newTransaction ? 'Transaction Successful.' : 'Transaction Unsuccessful!';
            return redirect($newTransaction ? $link['go'] : $link['back']);
        } catch (\Exception $e) {
            $_SESSION['errors'] = ['email' => $e->getMessage()];
            return redirect($link['back']);
        }
    }

    private function hasSufficientBalance($balance, $amount)
    {
        return $balance['balance'] >= $amount;
    }
}
