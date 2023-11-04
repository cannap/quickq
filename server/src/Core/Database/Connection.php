<?php


namespace Framework\Core\Database;

use PDO;

class Connection
{

    public PDO $pdo;

    //Todo Maybe singleton or creat a ServiceContainer i can use it more dynamically
    public function __construct()
    {
        $dsn = "mysql:host={$_ENV["DATABASE_HOST"]};dbname={$_ENV["DATABASE_NAME"]}";
        $this->pdo = new PDO($dsn, $_ENV["DATABASE_USERNAME"], $_ENV["DATABASE_PASSWORD"]);
    }


}
