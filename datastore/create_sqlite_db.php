<?php

try {
    $dbFile = __DIR__ . '/bangubank.sqlite';

    $db = new PDO('sqlite:' . $dbFile);


    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "SQLite database created at: " . $dbFile;
} catch (PDOException $e) {
    echo "Error creating SQLite database: " . $e->getMessage();
}
