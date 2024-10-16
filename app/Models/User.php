<?php

namespace App\Models;

class User extends Model
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function initializeDataFile(): void
    {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }

    public function create(array $data)
    {
        foreach ($this->getAll() as $user) {
            if ($user['email'] === $data['email']) {
                throw new \Exception("The email address '{$data['email']}' is already in use.");
            }
        }

        $data['id'] = $this->generateUniqueId();
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->store($data);
    }

    public function view(): array
    {
        return $this->getAll();
    }

    public function show($email): ?array
    {
        foreach ($this->getAll() as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }

        return null;
    }

    public function edit($id): ?array
    {
        return $this->findById($id);
    }

    public function update($id, array $data): bool
    {
        return parent::update($id, $data);
    }

    public function delete($id): bool
    {
        return parent::delete($id);
    }

    public function isPermit($request): bool
    {
        $data = $this->findById($request['user_id']);

        if ($data) {
            $data['role'] = $request['role'];
            $data['auth_permit'] = $request['auth_permit'];

            return $this->update($request['user_id'], $data);
        }

        return false;
    }

    public function dataVerify($email): array
    {
        return array_filter($this->getAll(), fn($user) => $user['email'] === $email);
    }

    public function customerNameShow($customerId): ?array
    {
        $user = $this->findById($customerId);
        if ($user) {
            return [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name']
            ];
        }

        return null;
    }

    private function generateUniqueId(): int
    {
        $users = $this->getAll();
        $maxId = 0;

        foreach ($users as $user) {
            if ($user['id'] > $maxId) {
                $maxId = $user['id'];
            }
        }

        return $maxId + 1;
    }

    public function findByEmailPublic(string $email): ?array
    {
        return $this->findByEmail($email);
    }
}
