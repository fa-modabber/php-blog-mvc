<?php

namespace app\models;

use app\core\Database as Database;
use PDO;

class Category
{

    private $db;
    
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCategory($id)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM categories WHERE id=:id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function getCategories()
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM categories ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createCategory($title)
    {
        $stmt = $this->db->conn->prepare("INSERT INTO categories (title) VALUES (:title)");
        $stmt->execute(['title' => $title]);
    }

    public function updateCategory($title, $id)
    {
        $stmt = $this->db->conn->prepare("UPDATE categories SET title=:title WHERE id=:id");
        $stmt->execute(['title' => $title, 'id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function deleteCategory($data, $id)
    {
        $stmt = $this->db->conn->prepare("DELETE FROM categories WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }
}
