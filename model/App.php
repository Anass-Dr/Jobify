<?php

include_once 'Database.php';

class App extends Database {
    public function check ($user_id, $job_id) {
        $stmt = $this->db->prepare("SELECT * FROM applications WHERE user_id = ? AND job_id = ?");
        $stmt->execute([$user_id, $job_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add ($user_id, $job_id) {
        $stmt = $this->db->prepare("INSERT INTO applications VALUES (NULL, ?, ?, 'in progress')");
        $stmt->execute([$user_id, $job_id]);
    }

    public function show () {
        $stmt = $this->db->prepare(
            "SELECT u.username, j.title, j.description, a.status, a.id, j.job_id FROM applications a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN jobs j ON a.job_id = j.job_id"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update ($items) {
        $stmt = $this->db->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->execute([$items[0], $items[1]]);

        if ($items[0] === 'approved') {
            # Disapprove all the other applications
            $stmt = $this->db->prepare("UPDATE applications SET status = 'not approved' WHERE job_id = ?");
            $stmt->execute([$items[2]]);

            # Add Approved Notification :
            $stmt = $this->db->prepare("INSERT INTO notifications VALUES (NULL, ?, ?)");
            $stmt->execute(['You have been approved', $_SESSION['id']]);
        }
    }

    public function count () {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM applications WHERE status = 'approved'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}

$app = new App();