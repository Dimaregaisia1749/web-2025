<?php
require_once '../../data/sql/db_scripts.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(response_code: 405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

session_start();
$connection = connectDatabase();
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$email = $data['email'];
$password = $data['password'];

$user = findUserByEmailInDatabase( $connection, $email);

if (!$user || ($password != $user['password'])) {
    http_response_code(response_code: 401);
    echo json_encode(['error' => 'Invalid password']);
    exit;
}

$_SESSION['auth'] = $user['id'];
http_response_code(200);
echo json_encode(['message' => 'Login successfully']);
?>