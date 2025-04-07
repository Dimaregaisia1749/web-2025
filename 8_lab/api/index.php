<?php
require_once '../data/sql/db_scripts.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo  json_encode(['error' => 'Invalid JSON']);
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
    $savePath = '../data/images/content/' . $fileName;
    if (!$img) {
        echo json_encode(['error' => 'Empty URl']);
        exit;
    }
    $headers = @get_headers($img);
    if (!$headers || substr($headers[0], 9, 3) !== '200') {
        echo json_encode(['error' => 'Incorrect URL']);
        exit;
    }
    $decoded = file_get_contents($img);

    file_put_contents($savePath, $decoded);

    $imagePaths[] = $savePath;
}

$connection = connectDatabase();
$userId = 1;
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
