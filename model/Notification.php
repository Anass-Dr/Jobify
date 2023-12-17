<?php

include_once 'Database.php';

class Notification extends Database {
    public function getNotif ($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$notification = new Notification();