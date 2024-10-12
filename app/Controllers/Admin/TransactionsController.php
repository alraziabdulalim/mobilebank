<?php

namespace App\Controllers\Admin;

use App\Models\Transaction;

class TransactionsController
{
    public function index()
    {
        $transaction = new Transaction();
        $transactions = $transaction->view();
        
        return view("admin/transactions", ['transactions' => $transactions]);
    }

    public function view($request)
    {
        $customerId = $request['customer_id'];
        $transInfo = accountBalance($customerId);
        $accountLedger = ['customerId' => $customerId, 'transactions' =>$transInfo['transactions']];
        
        return view("admin/customer-transactions", ['accountLedger' => $accountLedger]);
    }
}