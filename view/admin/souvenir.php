<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri !== '/admin/souvenir/delete') {
    require_once 'layouts/header.php';
    require_once 'utils/format.php';

    if ($uri == "/admin/souvenir") {
        require_once 'souvenir/souvenir.php';
    } elseif ($uri == "/admin/souvenir/add") {
        require_once 'souvenir/souvenir-add.php';
    } elseif (substr($uri, 0, 21) == "/admin/souvenir/edit/") {
        $id = substr($uri, 21);
        require_once 'souvenir/souvenir-edit.php';
    }

    require_once 'layouts/footer.php';
} else {
    require_once 'souvenir/souvenir-delete.php';
}
