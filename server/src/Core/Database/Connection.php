<?php

namespace Framework\Core\Database;

use PDO;

class Connection
{
    private static ?Connection $instance = null;
    public PDO $pdo;

    private function __construct()
    {
        $dsn = "mysql:host={$_ENV['DATABASE_HOST']};dbname={$_ENV['DATABASE_NAME']};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD'], $options);
    }

    public static function getInstance(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


}