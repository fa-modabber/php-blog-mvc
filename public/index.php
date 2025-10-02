<?php

namespace app\views;

require __DIR__ . "/../bootstrap.php";



//for development in localhost
$path = trim(str_replace("php-blog-mvc/", "", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), "/");

//for deploy on server
// $path=trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),"/");

//Associative array
$routes = [
    'GET' => [
        "" => ['controller' => 'app\controllers\HomeController', 'method' => 'index'],

        "users/register" => ['controller' => 'app\controllers\UserController', 'method' => 'register'],
        "users/login-form" => ['controller' => 'app\controllers\UserController', 'method' => 'loginForm'],
        "users/logout" => ['controller' => 'app\controllers\UserController', 'method' => 'logout'],

        "posts" => ['controller' => 'app\controllers\PostController', 'method' => 'index'],
        "posts/create" => ['controller' => 'app\controllers\PostController', 'method' => 'create'],
        "posts/show/([0-9]+)" => ['controller' => 'app\controllers\PostController', 'method' => 'show'],
        "posts/edit/([0-9]+)" => ['controller' => 'app\controllers\PostController', 'method' => 'edit'],
        "posts/search" => ['controller' => 'app\controllers\PostController', 'method' => 'search'],


        "categories/create" => ['controller' => 'app\controllers\CategoryController', 'method' => 'create'],
        "categories" => ['controller' => 'app\controllers\CategoryController', 'method' => 'index'],
        "categories/edit/([0-9]+)" => ['controller' => 'app\controllers\CategoryController', 'method' => 'edit'],


        "test" => ['controller' => 'app\controllers', 'method' => '']
    ],
    'POST' => [
        "posts/store" => ['controller' => 'app\controllers\PostController', 'method' => 'store'],
        "posts/update/([0-9]+)" => ['controller' => 'app\controllers\PostController', 'method' => 'update'],
        "posts/delete/([0-9]+)" => ['controller' => 'app\controllers\PostController', 'method' => 'delete'],


        "categories/store" => ['controller' => 'app\controllers\CategoryController', 'method' => 'store'],
        "categories/update/([0-9]+)" => ['controller' => 'app\controllers\CategoryController', 'method' => 'update'],
        "categories/delete/([0-9]+)" => ['controller' => 'app\controllers\CategoryController', 'method' => 'delete'],

        "users/store" => ['controller' => 'app\controllers\UserController', 'method' => 'store'],
        "users/login" => ['controller' => 'app\controllers\UserController', 'method' => 'login'],


    ]
];

$method = $_SERVER['REQUEST_METHOD'];

foreach ($routes[$method] as $route => $info) {

    if (preg_match("#^$route$#", $path, $matches)) {
        $id = $matches[1] ?? null;
        $controller = new $info['controller'];
        $postParameters = ($method === 'POST') ? $_POST : null;
        if ($postParameters) {
            $controller->{$info['method']}($postParameters, $id);
        } else $controller->{$info['method']}($id);

        break;
    }
}

if (!isset($controller)) {
    $viewer = new Viewer();
    $viewer->render("errors/404.php", []);
}
