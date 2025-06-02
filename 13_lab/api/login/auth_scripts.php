<?php
require_once '../data/sql/db_scripts.php';

function authBySession()
{
    session_start();
    if (!isset($_SESSION['auth'])) {
        http_response_code(401);
        exit;
    }

    $connection = connectDatabase();
    $user = findUserInDatabase($connection, $_SESSION['auth']);

    if (!$user) {
        http_response_code(401);
        exit;
    }

    return $user['id'];
}

function checkPermissions(int $id)
{
    session_start();
    if ((!isset($_SESSION['auth'])) || ($id != $_SESSION['auth'])) {
        http_response_code(401);
        exit;
    }

    return $id;
}

function getAuth()
{
    session_start();
    if (!isset($_SESSION['auth'])) {
        return -1;
    }

    return $_SESSION['auth'];
}
?>