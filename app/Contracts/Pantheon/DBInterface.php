<?php

namespace App\Contracts\Pantheon;

use PDO;

/**
 * Interface DBInterface
 */
interface DBInterface
{
    /** Connect to database
     * @param string $host
     * @param string $port
     * @param string $name
     * @param string $user
     * @param string $pass
     * @return mixed
     */
    public static function connect(string $db_type, string $host, string $port, string $name, string $user, string $pass): PDO;
}