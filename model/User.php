<?php

include_once 'Database.php';

class User extends Database {
    public function login ($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register ($items) {
        $stmt = $this->db->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, 'candidat')");
        $stmt->execute($items);
    }
}

$user = new User();