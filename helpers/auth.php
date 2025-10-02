<?php

use app\models\Auth;

function isLoggedin()
{
    return isset($_SESSION['user']['id']);
}

function checkPermission($permission)
{
    if (!isLoggedIn()) {
        redirect('users/login-form', ['error' => 'You do not have permission to access this page, Please log in']);
    }
    $roleId = $_SESSION['user']['role_id'] ?? 3;
    $authModel = new Auth();
    $permissionList = $authModel->getPermissions($roleId);
    if (!in_array($permission, $permissionList)) {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
}
