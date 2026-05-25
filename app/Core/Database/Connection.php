<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {

            $config = require __DIR__ . '/../../../config/database.php';

            try {

                self::$instance = new PDO(
                    "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4",
                    $config['username'],
                    $config['password']
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                die("Database Connection Failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}