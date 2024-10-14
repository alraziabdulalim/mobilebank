<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Models\Transaction;

try {
    $user = new User();
    $user->createTable();

    $transaction = new Transaction();
    $transaction->createTable();

    echo "Tables created successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$adminData = [
    'firstName' => 'Admin',
    'lastName'  => 'User',
    'email'     => 'admin@example.com',
    'password'  => password_hash('adminpassword', PASSWORD_BCRYPT),
    'role'      => 'is_Admin',
    'auth_permit' => 'is_Permit'
];

try {
    $user->create($adminData);
    echo "Admin user created successfully.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
