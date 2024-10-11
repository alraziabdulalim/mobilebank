<?php

namespace App\Models;

class User extends Model
{
    public function create(array $data)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();
        $emailExists = $stmt->fetchColumn();

        if ($emailExists) {
            throw new \Exception("The email address '{$data['email']}' is already in use.");
        }

        $stmt = $this->db->prepare("INSERT INTO user (first_name, last_name, email, password, role, auth_permit, created_at) VALUES (:first_name, :last_name, :email, :password, :role, :auth_permit, NOW())");
        $stmt->bindParam(':first_name', $data['firstName']);
        $stmt->bindParam(':last_name', $data['lastName']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);
        // $stmt->bindValue(':role', 'role');
        $stmt->bindParam(':auth_permit', $data['auth_permit']);

        return $stmt->execute();
    }

    public function view()
    {
        $stmt = $this->db->prepare("SELECT * FROM user");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function show($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function dataVerify($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function edit($id)
    {
        return $this->show($id);
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE user SET firstName = :first_name, lastName = :last_name, email = :email, password = :password, role = :role, auth_permit = :auth_permit WHERE id = :id");
        $stmt->bindParam(':first_name', $data['firstName']);
        $stmt->bindParam(':last_name', $data['lastName']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':auth_permit', $data['auth_permit']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function isPermit($request)
    {
        $stmt = $this->db->prepare("UPDATE user SET role = :role, auth_permit = :auth_permit WHERE id = :id");
        $stmt->bindParam(':role', $request['role']);
        $stmt->bindParam(':auth_permit', $request['auth_permit']);
        $stmt->bindParam(':id', $request['user_id']);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}