<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

session_start();
unset($_SESSION['user_id']);
http_response_code(200);
?>