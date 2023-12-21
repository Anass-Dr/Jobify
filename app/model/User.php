<?php

namespace App\model;

use App\model\Database;
use PDO;

class User
{
    public static function fetchUser($username)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$username]);
        Database::close();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addUser($items)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, 'candidat')");
        $stmt->execute($items);
        Database::close();
    }
}
