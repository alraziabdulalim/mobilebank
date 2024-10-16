<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Models\Transaction;

try {
    $user = new User();
    $user->initializeDataFile();

    $transaction = new Transaction();
    $transaction->initializeDataFile();

    echo "Data files initialized successfully.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

$adminData = [
    'first_name' => 'Admin',
    'last_name'  => 'User',
    'email'     => 'admin@example.com',
    'password'  => password_hash('adminpassword', PASSWORD_BCRYPT),
    'role'      => 'is_Admin',
    'auth_permit' => 'is_Permit'
];

try {
    if (!$user->findByEmailPublic($adminData['email'])) {
        $user->create($adminData);
        echo "Admin user created successfully.\n";
    } else {
        echo "Admin user already exists.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
