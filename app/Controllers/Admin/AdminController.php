<?php

namespace App\Controllers\Admin;

use App\Models\Transaction;

class AdminController
{

    public function index()
    {
        return view("admin/index");
    }

    public function login()
    {
        return view("admin/login");
    }

    public function verify($request)
    {
        $errors = [];
        $sanitizedRequest = [];

        $sanitizedRequest['email'] = sanitizedEmail($request['email'], $errors);
        $sanitizedRequest['password'] = passwordValidity($request['password'], $errors);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['sanitizedRequest'] = $sanitizedRequest;

            return redirect('./login');
        }

        $_SESSION['user'] = adminVerify($sanitizedRequest);

        header('Location: ./dashboard');
    }

    public function dashboard()
    {
        $transaction = new Transaction();
        $transactions = $transaction->view();
        return view("admin/dashboard", ['transactions' => $transactions]);
    }
    public function logout()
    {
        unset($_SESSION);
        session_destroy();

        header("Location: ./login");
        exit;
    }

}