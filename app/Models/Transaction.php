<?php

namespace App\Models;

class Transaction extends Model
{
    public function create(array $data)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user WHERE id = :id");
        $stmt->bindParam(':id', $data['user_id']);
        $stmt->execute();
        $emailExists = $stmt->fetchColumn();

        if ($emailExists) {

            $stmt = $this->db->prepare("INSERT INTO transaction (user_id, pay_to, amount, trans_type, status, created_at) VALUES (:user_id, :pay_to, :amount, :trans_type, :status, NOW())");
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':pay_to', $data['pay_to']);
            $stmt->bindParam(':amount', $data['amount']);
            $stmt->bindParam(':trans_type', $data['trans_type']);
            $stmt->bindParam(':status', $data['status']);

            return $stmt->execute();
        }

        throw new \Exception("The email address '{$data['email']}' is not found.");
    }

    public function view()
    {
        $stmt = $this->db->prepare("SELECT * FROM transaction");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function show($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM transaction WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE transaction SET user_id = :user_id, pay_to = :pay_to, amount = :amount, trans_type = :trans_type, status = :status WHERE id = :id");
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':pay_to', $data['pay_to']);
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':trans_type', $data['trans_type']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM transaction WHERE id = :id");
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}