<?php

include_once 'Database.php';

class Job extends Database {
    public function show () {
        $stmt = $this->db->prepare("SELECT * FROM jobs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search ($items) {
        $stmt = $this->db->prepare(
            "SELECT j.*, a.status as app_status FROM jobs j
                   LEFT JOIN applications a ON a.job_id = j.job_id
                   WHERE title LIKE ? AND company LIKE ? AND location LIKE ? AND j.status = 'open'
                   GROUP BY j.title HAVING COUNT(j.title = 1)"
        );
        $stmt->execute($items);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete ($job_id) {
        $stmt = $this->db->prepare("DELETE FROM jobs WHERE job_id = ?");
        $stmt->execute([$job_id]);
    }

    public function add ($job_data, $img_path) {
        $stmt = $this->db->prepare("INSERT INTO jobs VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $job_data['title'], $job_data['desc'], $job_data['comp'], $job_data['loc'], $job_data['status'],
            date('Y-m-d'),
            $img_path
        ]);
    }

    public function update ($job_data, $img_path) {
        $stmt = $this->db->prepare("UPDATE jobs SET title = ? , description = ? , company = ? , location = ? , status = ? , image_path = ? WHERE job_id = ?");
        $stmt->execute([
            $job_data['title'], $job_data['desc'], $job_data['comp'], $job_data['loc'], $job_data['status'],
            $img_path, $job_data['job_id']
        ]);
    }

    public function count () {
        $stmt1 = $this->db->prepare("SELECT COUNT(*) as count FROM jobs;");
        $stmt2 = $this->db->prepare("SELECT COUNT(*) as count FROM jobs WHERE status = 'open';");
        $stmt1->execute();
        $stmt2->execute();
        return [
            "all" => $stmt1->fetch(PDO::FETCH_ASSOC)['count'],
            "open" => $stmt2->fetch(PDO::FETCH_ASSOC)['count'],
        ];
    }
}

$job = new Job();