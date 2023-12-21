<?php

namespace App\model;

use PDO;

class Job
{
    public static function fetchAll()
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM jobs");
        $stmt->execute();
        Database::close();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function search($items)
    {
        $db = Database::connect();
        $stmt = $db->prepare(
            "SELECT j.*, a.status as app_status FROM jobs j
                   LEFT JOIN applications a ON a.job_id = j.job_id
                   WHERE title LIKE ? AND company LIKE ? AND location LIKE ? AND j.status = 'open'
                   GROUP BY j.title HAVING COUNT(j.title = 1)"
        );
        $stmt->execute($items);
        Database::close();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($job_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM jobs WHERE job_id = ?");
        $stmt->execute([$job_id]);
        Database::close();
    }

    public static function add($job_data, $img_path)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO jobs VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $job_data['title'], $job_data['desc'], $job_data['comp'], $job_data['loc'], $job_data['status'],
            date('Y-m-d'),
            $img_path
        ]);
        Database::close();
    }

    public static function update($job_data, $img_path)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE jobs SET title = ? , description = ? , company = ? , location = ? , status = ? , image_path = ? WHERE job_id = ?");
        $stmt->execute([
            $job_data['title'], $job_data['desc'], $job_data['comp'], $job_data['loc'], $job_data['status'],
            $img_path, $job_data['job_id']
        ]);
        Database::close();
    }

    public static function count()
    {
        $db = Database::connect();
        $stmt1 = $db->prepare("SELECT COUNT(*) as count FROM jobs;");
        $stmt2 = $db->prepare("SELECT COUNT(*) as count FROM jobs WHERE status = 'open';");
        $stmt1->execute();
        $stmt2->execute();
        Database::close();
        return [
            "all" => $stmt1->fetch(PDO::FETCH_ASSOC)['count'],
            "open" => $stmt2->fetch(PDO::FETCH_ASSOC)['count'],
        ];
    }
}
