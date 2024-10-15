<?php

namespace App\Controllers;

class CustomerController
{
    public function index()
    {
        $userId = $_SESSION['user']['id'];
        $transInfo = accountBalance($userId);
    
        return view("customer/index", [
            'transInfo' => $transInfo
        ]);
    }

    public function deposit()
    {
        $userId = $_SESSION['user']['id'];
        $transInfo = accountBalance($userId);

        return view("customer/deposit",  [
            'transInfo' => $transInfo
        ]);
    }

    public function withdraw()
    {
        $userId = $_SESSION['user']['id'];
        $transInfo = accountBalance($userId);

        return view("customer/withdraw", [
            'transInfo' => $transInfo
        ]);
    }

    public function transfer()
    {
        $userId = $_SESSION['user']['id'];
        $transInfo = accountBalance($userId);
        
        return view("customer/transfer", [
            'transInfo' => $transInfo
        ]);
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();

        header("Location: ../login");
        exit;
    }
}