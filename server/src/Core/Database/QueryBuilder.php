<?php

namespace Framework\Core\Database;

use PDO;

class QueryBuilder
{
    private static function getConnection(): PDO
    {
        return Connection::getInstance()->pdo;
    }

    public static function query($query, $params = []): false|\PDOStatement
    {
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    // Hier könnten weitere statische Methoden definiert werden,
    // die auf die PDO-Instanz in Connection::getInstance()->pdo zugreifen
}