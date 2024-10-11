<?php

use App\Models\User;

function redirect($location, $message = null)
{
    if ($message) {
        $_SESSION['flash_message'] = $message;
    }

    header("Location: $location");
    exit();
}

function displayMessage($message = null)
{
    if ($message) {
        echo "<p>" . htmlspecialchars($message) . "</p>";
    }
}

function view(string $view, array $data = [])
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
    if (empty($name) || strlen($name) < 3) {
        $errors['name'] = 'Name must be at least 3 characters long.';
        return '';
    }
    return sanitize($name);
}

function sanitizedEmail(string $email, array &$errors): string
{
    $sanitizedEmail = sanitize($email);
    if (empty($sanitizedEmail) || !filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address.';
        return '';
    }

    return $sanitizedEmail;
}

function sanitizedPassword(string $password, array &$errors): string
{
    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
        return '';
    }

    $sanitizedPassword = sanitize($password);
    return password_hash($sanitizedPassword, PASSWORD_DEFAULT);
}

function passwordValidity(string $password, array &$errors): string
{
    if (empty($password) || strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
        return '';
    }

    return sanitize($password);
}

function dataVerify(array $sanitizedRequest)
{
    $redirectUrl = '../login';
    $redirectMessage = 'Recheck your credentials.';

    $user = new User();
    $existingUser = $user->dataVerify($sanitizedRequest['email']);

    if (!$existingUser) {
        $_SESSION['message'] = $redirectMessage;
        return redirect($redirectUrl);
    }

    if (password_verify($sanitizedRequest['password'], $existingUser[0]['password'])) {

        $userData = $existingUser[0];
    } else {
        $_SESSION['message'] = $redirectMessage;

        return redirect($redirectUrl);
    }

    if ($existingUser[0]['auth_permit'] == 'is_Permit') {

        return $userData;
    }

    $_SESSION['message'] = 'Your Registration is under processing. Wait for confirmation e-mail. Thanks.';
    return redirect($redirectUrl);
}

function adminVerify(array $sanitizedRequest)
{
    $redirectUrl = './login';
    $redirectMessage = 'Recheck your credentials.';

    $user = new User();
    $existingUser = $user->dataVerify($sanitizedRequest['email']);

    if (!$existingUser) {
        $_SESSION['message'] = $redirectMessage . '1';
        return redirect($redirectUrl);
    }

    if (password_verify($sanitizedRequest['password'], $existingUser[0]['password'])) {

        $userData = $existingUser[0];
    } else {
        $_SESSION['message'] = $redirectMessage . '2';
        return redirect($redirectUrl);
    }

    if ($existingUser[0]['auth_permit'] == 'is_Permit' && $existingUser[0]['role'] == 'is_Admin') {

        return $userData;
    }

    $_SESSION['message'] = $redirectMessage . '3';
    return redirect($redirectUrl);
}

function amountValidity(string $amount, array &$errors): string
{
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $amount)) {
        $errors['amount'] = 'Amount must be a valid number with up to two decimal places.';
        return '';
    }

    return number_format((float) $amount, 2, '.', '');
}

function solidAmountValidity(string $amount, array &$errors): string
{
    // Check if the amount is a valid integer (solid number)
    if (!preg_match('/^\d+$/', $amount)) {
        $errors['amount'] = 'Amount must be a valid solid number (no decimals).';
        return '';
    }

    // Convert the amount to an integer and return it as a formatted string
    return number_format((int) $amount, 0, '.', '');
}
