<?php
session_start();
ob_start();
require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('BASE_URL', $_ENV['BASE_URL']); // url of the root
define('BASE_PATH', __DIR__); // project root
define('POSTS_PER_PAGE',5);
