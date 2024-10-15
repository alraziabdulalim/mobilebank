<?php

namespace App\Models;

use PDO;

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $config = require __DIR__ . "/../../config/database.php";

        if (!is_array($config) || !isset($config['path'])) {
            throw new \Exception('Invalid SQLite database configuration.');
        }

        try {
            $dsn = "sqlite:{$config['path']}";
            $this->db = new PDO($dsn);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }
}
