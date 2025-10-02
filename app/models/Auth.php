<?php

namespace app\models;

use app\core\Database as Database;
use PDO;

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPermissions($roleId)
    {
        $query = "SELECT permissions.name FROM permissions JOIN role_permission ON permissions.id=role_permission.permission_id WHERE role_permission.role_id = :roleId";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute(['roleId' => $roleId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
