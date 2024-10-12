<?php

namespace App\Models;

use PDO;

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $config = require __DIR__ . "/../../config/database.php";

        // Check if $config is an array and contains all the required keys
        if (!is_array($config) || 
            !isset($config['host'], $config['dbname'], $config['username'], $config['password'])) {
            throw new \Exception('Invalid database configuration.');
        }

        try {
            // Construct the DSN string properly
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $this->db = new PDO($dsn, $config['username'], $config['password']);

            // Set PDO attributes
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Log the error or handle it appropriately
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }
}
