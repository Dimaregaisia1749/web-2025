<?php

require __DIR__ . '/../../data/sql/db_scripts.php';

function authBySession()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    
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
    if (!isset($_SESSION)) {
        session_start();
    }

    if ((!isset($_SESSION['auth'])) || ($id != $_SESSION['auth'])) {
        http_response_code(401);
        exit;
    }

    return $id;
}

function getUserInfo()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (!isset($_SESSION['auth'])) {
        $id = -1;
        $email = -1;
    } else {
        $id = $_SESSION['auth'];
        $connection = connectDatabase();
        $user = findUserInDatabase($connection, $_SESSION['auth']);
        $email = $user['email'];
    }

    return [
        'id' => $id,
        'email' => $email
    ];
}
?>