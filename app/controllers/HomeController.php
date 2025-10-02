<?php

namespace app\controllers;

use app\views\Viewer;

class HomeController
{
    public function index()
    {
        // checkPermission('view_home');
        $viewer = new Viewer();
        $viewer->render("home/index.php", ['title' => "the title of weblog", "name" => "Fatemeh"]);
    }
}
