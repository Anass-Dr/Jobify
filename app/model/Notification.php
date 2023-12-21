<?php

namespace App\model;

use PDO;

class Notification
{
    public static function getNotif($user_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM notifications WHERE user_id = ?");
        $stmt->execute([$user_id]);
        Database::close();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
