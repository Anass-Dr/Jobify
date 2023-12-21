<?php

namespace App\model;

class ApplicationModel
{
    public static function isExist($user_id, $job_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM applications WHERE user_id = ? AND job_id = ?");
        $stmt->execute([$user_id, $job_id]);
        Database::close();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function add($user_id, $job_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO applications VALUES (NULL, ?, ?, 'in progress')");
        $stmt->execute([$user_id, $job_id]);
        Database::close();
    }

    public static function fetchAll()
    {
        $db = Database::connect();
        $stmt = $db->prepare(
            "SELECT u.username, j.title, j.description, a.status, a.id, j.job_id FROM applications a
            LEFT JOIN users u ON a.user_id = u.id
            LEFT JOIN jobs j ON a.job_id = j.job_id"
        );
        $stmt->execute();
        Database::close();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function updateStatus($items)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->execute([$items[0], $items[1]]);

        if ($items[0] === 'approved') {
            # Disapprove all the other applications
            $stmt = $db->prepare("UPDATE applications SET status = 'not approved' WHERE job_id = ?");
            $stmt->execute([$items[2]]);

            # Add Approved Notification :
            $stmt = $db->prepare("INSERT INTO notifications VALUES (NULL, ?, ?)");
            $stmt->execute(['You have been approved', $_SESSION['id']]);
        }
        Database::close();
    }

    public static function count()
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) as count FROM applications WHERE status = 'approved'");
        $stmt->execute();
        Database::close();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}
