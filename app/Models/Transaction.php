<?php

namespace App\Models;

class Transaction extends Model
{
    public function __construct()
    {
        parent::__construct('transactions');
    }

    public function initializeDataFile(): void
    {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([]));
        }
    }

    public function create(array $data)
    {
        $userModel = new User();
        $user = $userModel->findById($data['user_id']);

        if (!$user) {
            throw new \Exception("The user with ID '{$data['user_id']}' is not found.");
        }

        $data['id'] = $this->generateUniqueId();
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->store($data);
    }

    public function view(): array
    {
        return $this->getAll();
    }

    public function show($userId): array
    {
        return array_filter($this->getAll(), fn($transaction) => $transaction['user_id'] == $userId);
    }

    public function edit($id): ?array
    {
        return $this->findById($id);
    }

    public function update($id, array $data): bool
    {
        $transaction = $this->findById($id);

        if ($transaction) {
            $transaction['user_id'] = $data['user_id'];
            $transaction['pay_to'] = $data['pay_to'];
            $transaction['amount'] = $data['amount'];
            $transaction['trans_type'] = $data['trans_type'];
            $transaction['status'] = $data['status'];

            return parent::update($id, $transaction);
        }

        return false;
    }

    public function delete($id): bool
    {
        return parent::delete($id);
    }

    private function generateUniqueId(): int
    {
        $transactions = $this->getAll();
        $maxId = 0;

        foreach ($transactions as $transaction) {
            if ($transaction['id'] > $maxId) {
                $maxId = $transaction['id'];
            }
        }

        return $maxId + 1;
    }
}
