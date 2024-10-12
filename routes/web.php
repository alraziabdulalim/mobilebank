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

    "/customer-registration" => [AuthController::class, "store"],
    "/auth/verify" => [AuthController::class, "verify"],

    "/dashboard" => [CustomerController::class, "index"],
    "/deposit" => [CustomerController::class, "deposit"],
    "/withdraw" => [CustomerController::class, "withdraw"],
    "/transfer" => [CustomerController::class, "transfer"],
    "/logout" => [CustomerController::class, "logout"],

    "/create-deposit" => [TransactionController::class, "deposit"],
    "/create-withdraw" => [TransactionController::class, "withdraw"],
    "/create-transfer" => [TransactionController::class, "transfer"],

    "/admin" => [AdminController::class, "index"],
    "/admin/login" => [AdminController::class, "login"],
    "/admin/verify" => [AdminController::class, "verify"],
    "/admin/logout" => [AdminController::class, "logout"],

    "/admin/customers" => [CustomersController::class, "index"],
    "/admin/customers-create" => [CustomersController::class, "create"],
    "/admin/customers-store" => [CustomersController::class, "store"],
    "/admin/customers-update" => [CustomersController::class, "update"],

    "/admin/transactions" => [TransactionsController::class, "index"],
    "/admin/customer-transactions" => [TransactionsController::class, "view"],
];