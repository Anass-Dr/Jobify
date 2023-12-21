<?php

namespace App\model;

use mysqli;

// use PDO;

class Database
{
    public static $db;

    public static function connect()
    {
        $dsn = 'mysql:host=localhost;user=root;password=anasnay@2000;dbname=jobify';
        // Check connection
        try {
            self::$db = new \PDO($dsn);
            self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return self::$db;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function close()
    {
        self::$db = NULL;
    }
}
