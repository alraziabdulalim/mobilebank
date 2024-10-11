<?php

namespace App\Models;

use PDO;

class yModel
{
    protected PDO $db;
    public function __construct()
    {
        $config = require_once __DIR__ . "/../../config/.env";

        $dsn = 'mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_NAME'];
        $username = $config['DB_USER'];
        $password = $config['DB_PASSWORD'];

        try {
            $db = new PDO($dsn, $username, $password);
            // Set error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }
}