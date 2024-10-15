<?php

namespace App\Models;

class Transaction extends Model
{
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS \"transaction\" (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            pay_to TEXT NOT NULL,
            amount REAL NOT NULL,
            trans_type TEXT NOT NULL,
            status TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(id)
        )";

        $this->db->exec($sql);
        echo "Table 'transaction' created successfully (or already exists).\n";
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user WHERE id = :id");
        $stmt->bindParam(':id', $data['user_id']);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists) {
            $stmt = $this->db->prepare("INSERT INTO transaction (user_id, pay_to, amount, trans_type, status, created_at) VALUES (:user_id, :pay_to, :amount, :trans_type, :status, CURRENT_TIMESTAMP)");
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':pay_to', $data['pay_to']);
            $stmt->bindParam(':amount', $data['amount']);
            $stmt->bindParam(':trans_type', $data['trans_type']);
            $stmt->bindParam(':status', $data['status']);

            return $stmt->execute();
        }

        throw new \Exception("The user with ID '{$data['user_id']}' is not found.");
    }

    public function view()
    {
        $stmt = $this->db->prepare("SELECT * FROM transaction");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function show($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM `transaction` WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        $result = $stmt->fetchAll();

        if (empty($result)) {
            return [];
        }

        return $result;
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
