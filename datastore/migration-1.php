<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Models\Transaction;

try {
    $user = new User();
    $user->createTable();

    $transaction = new Transaction();
    $transaction->createTable();

    echo "Tables created successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}