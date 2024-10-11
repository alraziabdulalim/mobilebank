<?php

namespace App\Controllers\Admin;

use App\Models\Transaction;

class TransactionsController
{
    public function index()
    {
        $transaction = new Transaction();
        $transactions = $transaction->view();
        
        return view("admin/transactions/index", ['transactions' => $transactions]);
    }

    public function view($request)
    {
        $customerId = $request['customer_id'];
        $transaction = new Transaction();
        $transactions = $transaction->show($customerId);
        $accountLedger = ['customerId' => $customerId, 'transactions' =>$transactions];
        
        return view("admin/transactions/view", ['accountLedger' => $accountLedger]);
    }
}