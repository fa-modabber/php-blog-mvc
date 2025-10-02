<?php

namespace app\controllers;

use app\models\Category;
use app\models\Post;
use app\views\Viewer;

class PostController
{
    private $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function index()
    {
        // checkPermission('view_post');

        $currentPage = $_GET['page'] ?? 1;
        $postsPerPage = POSTS_PER_PAGE;
        try {
            $postsCount = $this->model->getNumberofPosts();
            $pagesCount = ceil($postsCount / ((int) POSTS_PER_PAGE));
            $posts = $this->model->getPosts($currentPage, $postsPerPage);
        } catch (\PDOException $e) {
            redirect("posts", ["error" => $e->getMessage()]);
        }
        $view = new Viewer();
        $view->render('posts/index.php', ["posts" => $posts, 'currentPage' => $currentPage, 'pagesCount'=> $pagesCount]);
    }

    public function create()
    {
        checkPermission('create_post');

        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        $view = new Viewer();
        $view->render('posts/create.php', ["categories" => $categories]);
    }

    public function store($data)
    {
        checkPermission('store_post');

        $formErrors = [];

        $title = test_form_input($data['title']) ?? '';
        $body = test_form_input($data['body']) ?? '';
        $categoryId = test_form_input($data['category_id']) ?? '';

        if (empty($title)) {
            $formErrors += ['title' => "Title is required"];
        }

        if (empty($body)) {
            $formErrors += ['body' => "body is required"];
        }

        if (empty($categoryId)) {
            $formErrors += ['category_id' => "Category is required"];
        }

        if (empty($formErrors)) { //if no error create post 
            try {
                $this->model->createPost($title, $body, $categoryId);
                redirect("posts", ["success" => "post created successfully"]);
            } catch (\PDOException $e) {
                redirect("posts/create", ["error" => $e->getMessage()]);
            }
        } else {
            redirect("posts/create", ["post_create_form" => $formErrors]);
        }
    }

    public function edit($id)
    {
        checkPermission('edit_post');

        $categoryModel = new Category();
        $categories = $categoryModel->getCategories();
        $view = new Viewer();
        $post = $this->model->getPost($id);
        if (empty($post)) {
            $view->render('/errors/404.php');
            exit();
        } else {
            $view->render('posts/edit.php', ['post' => $post, "categories" => $categories]);
        }
    }

    public function update($data, $id)
    {
        checkPermission('update_post');

        $post = $this->model->getPost($id);
        if (empty($post)) {
            $view = new Viewer();
            $view->render('/errors/404.php');
            exit();
        }
        $formErrors = [];

        $title = test_form_input($data['title']) ?? '';
        $body = test_form_input($data['body']) ?? '';
        $categoryId = test_form_input($data['category_id']) ?? '';

        if (empty($title)) {
            $formErrors += ['title' => "Title is required"];
        }

        if (empty($body)) {
            $formErrors += ['body' => "body is required"];
        }

        if (empty($categoryId)) {
            $formErrors += ['category_id' => "Category is required"];
        }

        if (empty($formErrors)) { //if no error create post 
            try {
                $this->model->updatePost($id, $title, $body, $categoryId);
                redirect("posts", ["success" => "post updated successfully"]);
            } catch (\PDOException $e) {
                redirect("posts/edit/$id", ["error" => $e->getMessage()]);
            }
        } else {
            redirect("posts/edit/$id", ["post_edit_form" => $formErrors]);
        }
    }


    public function delete($data, $id)
    {
        checkPermission('delete_post');
        
        $post = $this->model->getPost($id);
        if (empty($post)) {
            $view = new Viewer();
            $view->render('/errors/404.php');
            exit();
        }
        try {
            $this->model->deletePost($id, $data);
            redirect("posts", ["success" => "post deleted successfully"]);
        } catch (\PDOException $e) {
            redirect("posts", ["error" => $e->getMessage()]);
        }
    }

    public function search()
    {
        // checkPermission('view_post');

        $query = $_GET['query'] ?? '';
        $query = trim($query);
        $posts = [];
        if (!empty($query)) {
            try {
                $posts = $this->model->searchPosts($query);
                $view = new Viewer();
                $view->render('posts/index.php', ["posts" => $posts, "query" => $query]);
            } catch (\PDOException $e) {
                redirect("posts", ["error" => $e->getMessage()]);
            }
        }
    }
}
