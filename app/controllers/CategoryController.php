<?php

namespace app\controllers;

use app\models\Category;
use app\views\Viewer;

class CategoryController
{
    private $model;

    public function __construct()
    {
        $this->model = new Category();
    }

    public function index()
    {
        checkPermission('view_category');

        $categories = $this->model->getCategories();
        $view = new Viewer();
        $view->render('categories/index.php', ["categories" => $categories]);
    }

    public function create()
    {
        checkPermission('create_category');

        $view = new Viewer();
        $view->render('categories/create.php');
    }

    public function store($data)
    {
        checkPermission('store_category');

        $formErrors = [];

        $title = test_form_input($data['title']) ?? '';

        if (empty($title)) {
            $formErrors += ['title' => "Title is required"];
        }

        if (empty($formErrors)) { //if no error create category 
            try {
                $this->model->createCategory($title);
                redirect("categories", ["success" => "category created successfully"]);
            } catch (\PDOException $e) {
                redirect("categories/create", ["error" => $e->getMessage()]);
            }
        } else {

            redirect("categories/create", ["category_create_form" => $formErrors]);
        }
    }

    public function edit($id)
    {
        checkPermission('edit_category');

        $view = new Viewer();
        $category = $this->model->getCategory($id);
        if (empty($category)) {
            $view->render('/errors/404.php');
            exit();
        } else {
            $view->render('categories/edit.php', ['category' => $category]);
        }
    }

    public function update($data, $id)
    {
        checkPermission('update_category');

        $category = $this->model->getCategory($id);
        if (empty($category)) {
            $view = new Viewer();
            $view->render('/errors/404.php');
            exit();
        }
        $formErrors = [];

        $title = test_form_input($data['title']) ?? '';

        if (empty($title)) {
            $formErrors += ['title' => "Title is required"];
        }

        if (empty($formErrors)) { //if no error update category 
            try {
                $this->model->updateCategory($title, $id);
                redirect("categories", ["success" => "category created successfully"]);
            } catch (\PDOException $e) {
                redirect("categories/edit/$id", ["error" => $e->getMessage()]);
            }
        } else {
            redirect("categories/edit/$id", ["category_create_form" => $formErrors]);
        }
    }

    public function delete($data, $id)
    {
        checkPermission('delete_category');

        $category = $this->model->getCategory($id);
        if (empty($category)) {
            $view = new Viewer();
            $view->render('/errors/404.php');
            exit();
        } else {
            try {
                $this->model->deleteCategory($data, $id);
                redirect("categories", ["success" => "category created successfully"]);
            } catch (\PDOException $e) {
                redirect("categories", ["error" => $e->getMessage()]);
            }
        }
    }
}
