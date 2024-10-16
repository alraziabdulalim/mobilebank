<?php

namespace App\Controllers;
use App\Models\User;

class AuthController extends Controller
{
    public function store($request)
    {
        $validateRequest = $this->validateRequest($request);

        if (!empty($validateRequest['errors'])) {
            $_SESSION['errors'] = $validateRequest['errors'];
            $_SESSION['sanitizedRequest'] = $validateRequest['sanitizedRequest'];

            return redirect('../register');
        }

        try {
            $user = new User();
            $newUser = $user->create($validateRequest['sanitizedRequest']);

            if ($newUser) {
                $_SESSION['message'] = 'Your Registration is under processing. Wait for confirmation e-mail. Thanks';

                return redirect('../login');
            } else {
                $_SESSION['message'] = 'Registration Unsuccessful!';

                return redirect('../register');
            }
        } catch (\Exception $e) {
            $_SESSION['errors'] = ['email' => $e->getMessage()];
            return redirect('../register');
        }
    }

    public function validateRequest($request)
    {
        $errors = [];
        $sanitizedRequest = [];

        $sanitizedRequest['name'] = nameValidity($request['name'], $errors);
        $sanitizedRequest['email'] = sanitizedEmail($request['email'], $errors);
        $sanitizedRequest['password'] = sanitizedPassword($request['password'], $errors);
        $sanitizedRequest['role'] = null;
        $sanitizedRequest['auth_permit'] = null;

        return ['errors' => $errors, 'sanitizedRequest' => $sanitizedRequest];
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

            return redirect('../login');
        }

        $_SESSION['user'] = dataVerify($sanitizedRequest);

        header('Location: ../customer');
    }
}