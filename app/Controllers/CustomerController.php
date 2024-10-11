<?php

namespace App\Controllers;

use App\Models\Transaction;

class CustomerController
{
    public function index()
    {
        $transaction = new Transaction();
        $selfTransactions = $transaction->show($_SESSION['user']['id']);

        return view("customer/index", ['selfTransactions' => $selfTransactions]);
    }

    public function deposit()
    {
        $transaction = new Transaction();
        $selfTransactions = $transaction->show($_SESSION['user']['id']);

        return view("customer/deposit", ['selfTransactions' => $selfTransactions]);
    }

    public function withdraw()
    {
        $transaction = new Transaction();
        $selfTransactions = $transaction->show($_SESSION['user']['id']);

        return view("customer/withdraw", ['selfTransactions' => $selfTransactions]);
    }

    public function transfer()
    {
        $transaction = new Transaction();
        $selfTransactions = $transaction->show($_SESSION['user']['id']);
        
        return view("customer/transfer", ['selfTransactions' => $selfTransactions]);
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();

        header("Location: ../login");
        exit;
    }
}