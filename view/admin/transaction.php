<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri == '/admin/transaction/delete') {
    require_once 'transaction/transaction-delete.php';
} elseif ($uri == "/admin/transaction/update") {
    require_once 'transaction/transaction-edit.php';
} else {
    require_once 'transaction/transaction.php';
}
