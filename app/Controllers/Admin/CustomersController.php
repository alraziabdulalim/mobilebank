<?php

namespace App\Controllers\Admin;

use App\Models\User;

class CustomersController
{
    public function index()
    {
        $customers = new User();
        $customers = $customers->view();
        return view("admin/customers", ['customers' => $customers]);
    }

    public function create()
    {
        return view("admin/customers-create");
    }

    public function store($request)
    {
        $validateRequest = $this->validateRequest($request);

        if (!empty($validateRequest['errors'])) {
            $_SESSION['errors'] = $validateRequest['errors'];
            $_SESSION['sanitizedRequest'] = $validateRequest['sanitizedRequest'];

            return redirect('customers-create');
        }

        try {
            $user = new User();
            $newUser = $user->create($validateRequest['sanitizedRequest']);

            if ($newUser) {
                $_SESSION['message'] = 'Your Registration is under processing. Wait for confirmation e-mail. Thanks';

                return redirect('customers');
            } else {
                $_SESSION['message'] = 'Registration Unsuccessful!';

                return redirect('customers-create');
            }
        } catch (\Exception $e) {
            $_SESSION['errors'] = ['email' => $e->getMessage()];

            return redirect('customers-create');
        }
    }

    public function validateRequest($request)
    {
        $errors = [];
        $sanitizedRequest = [];

        $sanitizedRequest['first_name'] = nameValidity($request['first_name'], $errors);
        $sanitizedRequest['last_name'] = nameValidity($request['last_name'], $errors);
        $sanitizedRequest['email'] = sanitizedEmail($request['email'], $errors);
        $sanitizedRequest['password'] = sanitizedPassword($request['password'], $errors);
        $authPermit = $request['auth_permit'] ?? null;
        $sanitizedRequest['role'] = $authPermit === 'is_Permit' ? 'is_User' : null;
        $sanitizedRequest['auth_permit'] = $authPermit === 'is_Permit' ? 'is_Permit' : null;

        return ['errors' => $errors, 'sanitizedRequest' => $sanitizedRequest];
    }

    public function update($request)
    {
        $user = new User();
        $newRequest = [];
        $newRequest['user_id'] = is_numeric($request['user_id']) && is_int((int) $request['user_id']) ? (int) $request['user_id'] : null;
        $authPermit = $request['auth_permit'] ?? null;
        $newRequest['role'] = $authPermit === 'is_Permit' ? 'is_User' : null;
        $newRequest['auth_permit'] = $authPermit === 'is_Permit' ? 'is_Permit' : null;

        if ($newRequest['auth_permit'] != null) {
            $user->isPermit($newRequest);

            return redirect('./customers');
        }

        return redirect('./customers');
    }
}