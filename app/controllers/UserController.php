<?php

namespace app\controllers;

use app\models\User;
use app\views\Viewer;

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function loginForm()
    {
        $view = new Viewer();
        $view->render('users/login.php');
    }

    public function login($data)
    {
        // Validate inputs
        $formErrors = [];

        $email = test_form_input($data['email']) ?? '';
        $password = test_form_input($data['password']) ?? '';

        //validate email
        if (empty($email)) {
            $formErrors += ['email' => "Email is required"];
        }

        //validate password
        if (empty($password)) {
            $formErrors += ['password' => "Password is required"];
        }

        if (empty($formErrors)) { //if no error create post 

            try {

                $user = $this->model->getUserByEmail($email);
                if ($user && password_verify($password, $user->password)) {
                    $_SESSION['user'] = [
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'role_id' => $user->role_id
                    ];
                    redirect("/", ["success" => "you successfully logged in"]);
                }
                redirect("users/login-form", ["error" => "Invalid email or password"]);
            } catch (\PDOException $e) {
                redirect("users/login-form", ["error" => $e->getMessage()]);
            }
        } else {
            redirect("users/login-form", ["user_login_form" => $formErrors]);
        }
    }

    public function register()
    {
        $view = new Viewer();
        $view->render('users/register.php');
    }

    public function store($data)
    {
        // checkPermission('store_user');

        // Validate inputs
        $formErrors = [];

        $email = test_form_input($data['email']) ?? '';
        $password = test_form_input($data['password']) ?? '';
        $confirm_password = test_form_input($data['confirm_password']) ?? '';

        //validate email
        if (empty($email)) {
            $formErrors += ['email' => "Email is required"];
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $formErrors += ['email' => "Invalid email format"];
            }
        }

        //validate password
        if (empty($password)) {
            $formErrors += ['password' => "Password is required"];
        } else {
            if (strlen($password) < 5) {
                $formErrors += ['password' => "password should have at least 5 characters"];
            }
        }

        //validate donfirm_password
        if (empty($confirm_password)) {
            $formErrors += ['confirm_password' => "Confirm Password is required"];
        } else {
            if ($password != $confirm_password) {
                $formErrors += ['confirm_password' => "password and confirm-password are not equal"];
            }
        }

        if (empty($formErrors)) { //if no error create post 
            try {
                if ($this->model->getUserByEmail($email)) {
                    $formErrors += ['email' => "email already exists"];
                    redirect("users/register", ["user_create_form" => $formErrors]);
                }
            } catch (\PDOException $e) {
                redirect("users/register", ["error" => $e->getMessage()]);
            }

            try {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->model->createUser($email, $hashedPassword);
                redirect("users/login-form", ["success" => "you signed up successfully"]);
            } catch (\PDOException $e) {
                redirect("users/register", ["error" => $e->getMessage()]);
            }
        } else {
            redirect("users/register", ["user_create_form" => $formErrors]);
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        redirect("users/login-form");
    }
}
