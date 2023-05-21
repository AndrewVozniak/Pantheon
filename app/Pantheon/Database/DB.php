<?php

namespace App\Pantheon\Database;

use App\Models\Database\PDOException;
use Exception;
use PDO;

/**
 * Class DB | App\Pantheon\Database\DB
 */
class DB implements \App\Contracts\Pantheon\DBInterface
{
    /**
     * @inheritDoc
     * @throws Exception
     */
    public static function connect(string $db_type, string $host, string $port, string $name, string $user, string $pass): PDO
    {
        try {
            $pdo = new PDO("$db_type:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
}