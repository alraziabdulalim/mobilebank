<?php
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\CustomersController;
use App\Controllers\Admin\TransactionsController;
use App\Controllers\AuthController;
use App\Controllers\TransactionController;
use App\Controllers\CustomerController;
use App\Controllers\HomeController;

return [
    "/" => [HomeController::class, "index"],
    "/login" => [HomeController::class, "login"],
    "/register" => [HomeController::class, "register"],

    "/auth/store" => [AuthController::class, "store"],
    "/auth/verify" => [AuthController::class, "verify"],

    "/customer" => [CustomerController::class, "index"],
    "/customer/deposit" => [CustomerController::class, "deposit"],
    "/customer/withdraw" => [CustomerController::class, "withdraw"],
    "/customer/transfer" => [CustomerController::class, "transfer"],
    "/logout" => [CustomerController::class, "logout"],

    "/transaction/deposit" => [TransactionController::class, "deposit"],
    "/transaction/withdraw" => [TransactionController::class, "withdraw"],
    "/transaction/transfer" => [TransactionController::class, "transfer"],

    "/admin" => [AdminController::class, "index"],
    "/admin/login" => [AdminController::class, "login"],
    "/admin/verify" => [AdminController::class, "verify"],
    "/admin/dashboard" => [AdminController::class, "dashboard"],
    "/admin/logout" => [AdminController::class, "logout"],

    "/admin/customers" => [CustomersController::class, "index"],
    "/admin/customers/create" => [CustomersController::class, "create"],
    "/admin/customers/store" => [CustomersController::class, "store"],
    "/admin/customers/update" => [CustomersController::class, "update"],

    "/admin/transactions" => [TransactionsController::class, "index"],
    "/admin/transactions/view" => [TransactionsController::class, "view"],
];