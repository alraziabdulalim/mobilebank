<?php

namespace App\Models;

use PDO;

class Model_2
{
    protected PDO $db;

    public function __construct()
    {
        $config = require __DIR__ . "/../../config/database.php";

        if (!is_array($config) || 
            !isset($config['host'], $config['dbname'], $config['username'], $config['password'])) {
            throw new \Exception('Invalid database configuration.');
        }

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $this->db = new PDO($dsn, $config['username'], $config['password']);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }
}
