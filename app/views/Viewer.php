<?php

namespace app\views;

class Viewer
{
    public function render($template, $data = [])
    {
        extract($data, EXTR_SKIP);
        require BASE_PATH . "/app/views/shared/header.php";
        require BASE_PATH . "/app/views/shared/navbar.php";
        require BASE_PATH . "/app/views/$template";
        require BASE_PATH . "/app/views/shared/footer.php";
    }
}
