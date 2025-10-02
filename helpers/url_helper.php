<?php
function redirect($path, $session = [])
{
    $_SESSION[array_key_first($session)] = $session[array_key_first($session)];

    header("Location: " . BASE_URL . '/' . $path);
    exit;
}
