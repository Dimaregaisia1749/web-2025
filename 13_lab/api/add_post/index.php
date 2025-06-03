<?php
require_once __DIR__  . '/../login/auth_scripts.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}
if (!isset($data['content']) || strlen($data['content']) > 10000) {
    echo json_encode(['error' => 'Invalid content']);
    exit;
}
if (!isset($data['images'])) {
    echo json_encode(['error' => 'Invalid images']);
    exit;
}

$content = $data['content'];
$images = $data['images'];

foreach ($images as $img) {
    if (!is_string($img)) {
        echo json_encode(['error' => 'Image data must be strings URL']);
        exit;
    }
}

$imagePaths = [];
foreach ($images as $img) {
    $fileName = uniqid('img_', true) . '.png';
    $savePath = '../../data/images/content/' . $fileName;
    file_put_contents($savePath, file_get_contents($img));

    $imagePaths[] = $savePath;
}

$connection = connectDatabase();
$userId = authBySession();
$postData = [
    'user_id' => $userId,
    'content' => $content,
    'likes' => 0,
];

$postId = savePostToDatabase($connection, $postData);
foreach ($imagePaths as $imagePath) {
    $postData = [
        'post_id' => $postId,
        'image_path' => $imagePath
    ];
    $id = savePostImageToDatabase($connection, $postData);
}

$response = [
    'success' => true,
    'message' => 'Post created successfully',
    'post' => [
        'id'      => $postId,
        'user_id' => $userId,
        'content' => $content,
        'images'  => $imagePaths
    ]
];
echo json_encode($response);
exit;
