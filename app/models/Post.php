<?php

namespace app\models;

use app\core\Database as Database;
use PDO;


class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPost($id)
    {
        $stmt = $this->db->conn->prepare("SELECT * FROM posts WHERE id=:id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getPosts($pageNumber = 1, $postsPerPage = POSTS_PER_PAGE)
    {
        $offset = ($pageNumber - 1) * $postsPerPage;
        $query = "SELECT posts.*, categories.title AS category_title FROM posts INNER JOIN categories ON posts.category_id=categories.id ORDER BY posts.id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindValue('limit', (int) $postsPerPage, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getNumberofPosts()
    {
        $stmt = $this->db->conn->prepare("SELECT COUNT(*) FROM posts");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function createPost($title, $body, $categoryId)
    {

        $stmt = $this->db->conn->prepare("INSERT INTO posts (title,body,category_id) VALUES (:title,:body,:category_id)");
        $stmt->execute(['title' => $title, 'body' => $body, 'category_id' => $categoryId]);
    }

    public function updatePost($id, $title, $body, $categoryId)
    {
        $stmt = $this->db->conn->prepare("UPDATE posts SET title=:title,body=:body,category_id=:category_id WHERE id=:id");
        $stmt->execute(['id' => $id, 'title' => $title, 'body' => $body, 'category_id' => $categoryId,]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function deletePost($id, $data)
    {
        $stmt = $this->db->conn->prepare("DELETE FROM posts WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }

    public function searchPosts($query)
    {
        $query = "%" . $query . "%";
        $stmt = $this->db->conn->prepare("SELECT posts.*, categories.title AS category_title FROM posts INNER JOIN categories ON posts.category_id=categories.id WHERE posts.body LIKE :query OR posts.title LIKE :query ORDER BY id DESC");
        $stmt->execute(['query' => $query]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
