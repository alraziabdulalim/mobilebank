<?php

use App\Models\User;
use App\Models\Transaction;

function redirect(string $location, ?string $message = null): void
{
    if ($message) {
        $_SESSION['flash_message'] = $message;
    }

    header("Location: $location");
    exit();
}

function displayMessage(?string $message = null): void
{
    if ($message) {
        echo "<p>" . htmlspecialchars($message) . "</p>";
    }
}

function view(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . "/views/{$view}.php";
}

function sanitize($data)
{
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(stripslashes(trim($data)));
}

function nameValidity(string $name, array &$errors): string
{
    if (strlen(trim($name)) < 3) {
        $errors['name'] = 'Name must be at least 3 characters long.';
        return '';
    }
    return sanitize($name);
}

function getFirstAndLastName(string $fullName): array
{
    $nameParts = preg_split('/\s+/', trim($fullName));
    $firstName = array_shift($nameParts);
    $lastName = implode(' ', $nameParts) ?: '';

    return ['first_name' => $firstName, 'last_name' => $lastName];
}

function sanitizedEmail(string $email, array &$errors): string
{
    $sanitizedEmail = sanitize($email);
    if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address.';
        return '';
    }

    return $sanitizedEmail;
}

function sanitizedPassword(string $password, array &$errors): string
{
    if (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
        return '';
    }

    return password_hash(sanitize($password), PASSWORD_DEFAULT);
}

function passwordValidity(string $password, array &$errors): string
{
    if (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
        return '';
    }

    return sanitize($password);
}

function dataVerify(array $sanitizedRequest)
{
    return userVerification($sanitizedRequest, '../login', 'Recheck your credentials.');
}

function adminVerify(array $sanitizedRequest)
{
    return userVerification($sanitizedRequest, './login', 'Recheck your credentials.', true);
}

function userVerification(array $sanitizedRequest, string $redirectUrl, string $redirectMessage, bool $adminCheck = false)
{
    $user = new User();
    $existingUser = $user->dataVerify($sanitizedRequest['email']);

    $existingUser = array_values($existingUser);

    if (!$existingUser || !password_verify($sanitizedRequest['password'], $existingUser[0]['password'])) {
        $_SESSION['message'] = $redirectMessage;
        return redirect($redirectUrl);
    }

    $userData = $existingUser[0];

    if ($userData['auth_permit'] === 'is_Permit') {
        if ($adminCheck && $userData['role'] !== 'is_Admin') {
            $_SESSION['message'] = $redirectMessage;
            return redirect($redirectUrl);
        }
        return $userData;
    }

    $_SESSION['message'] = 'Your registration is under processing. Wait for confirmation e-mail. Thanks.';
    return redirect($redirectUrl);
}

function amountValidity(string $amount, array &$errors): string
{
    return validateAmount($amount, $errors, '/^\d+(\.\d{1,2})?$/', 'Amount must be a valid number with up to two decimal places.');
}

function solidAmountValidity(string $amount, array &$errors): string
{
    return validateAmount($amount, $errors, '/^\d+$/', 'Amount must be a valid solid number (no decimals).');
}

function validateAmount(string $amount, array &$errors, string $pattern, string $errorMessage): string
{
    if (!preg_match($pattern, $amount)) {
        $errors['amount'] = $errorMessage;
        return '';
    }
    return number_format((float)$amount, 2, '.', '');
}

function accountBalance(int $userId): array
{
    $transactions = (new Transaction())->show($userId);
    $balance = array_reduce($transactions, function ($carry, $transaction) {
        $amount = ($transaction['trans_type'] === 'deposit') ? $transaction['amount'] : -$transaction['amount'];
        return $carry + $amount;
    }, 0);

    return [
        'transactions' => $transactions,
        'balance' => $balance
    ];
}

function customerNameShow(int $customerId): string
{
    $user = new User();
    $name = $user->customerNameShow($customerId);
    return trim($name['first_name'] . ' ' . $name['last_name']);
}
