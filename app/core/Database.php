<?php

namespace app\core;

use \PDO;
use \PDOException;

class Database
{
    private $serverName;
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    public $conn;

    public function __construct()
    {
        $this->serverName = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? '127.0.0.1';
        $this->dbName     = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'database';
        $this->dbUsername = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
        $this->dbPassword = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?? '';

        $dns = "mysql:host=$this->serverName;dbname=$this->dbName;charset=utf8mb4";

        try {
            $this->conn = new PDO($dns, $this->dbUsername, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Connection Error: " . $e->getMessage();
            exit;
        }
    }


    //     function queryExecuteWithParams(PDO $db, $query, $params)
    // {
    //     $stmt = $db->prepare($query);
    //     $stmt->execute($params);
    //     return $stmt;
    // }

    // function queryFetchAll(PDO $db, string $query, array $params = [], int $fetchMode = PDO::FETCH_ASSOC)
    // {
    //     $stmt = empty($params)
    //         ? $db->query($query)
    //         : queryExecuteWithParams($db, $query, $params);

    //     return $stmt->fetchAll($fetchMode);
    // }

    // function queryFetchOne(PDO $db, string $query, array $params = [], int $fetchMode = PDO::FETCH_ASSOC)
    // {
    //     $stmt = empty($params)
    //         ? $db->query($query)
    //         : queryExecuteWithParams($db, $query, $params);

    //     return $stmt->fetch($fetchMode); // might return false if not found
    // }

    // function executeStatement(PDO $db, string $query, array $params = [])
    // {
    //     $stmt = $db->prepare($query);
    //     $stmt->execute($params);
    //     return $stmt->rowCount() > 0;
    // }
}
