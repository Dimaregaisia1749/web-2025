<?php
require_once '../../data/sql/db_scripts.php';

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
$post_id = $data['post_id'];

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
$userId = 1;
$likes = findPostInDatabase($connection, $post_id)['likes'];
$postData = [
    'user_id' => $userId,
    'post_id' => $post_id,
    'content' => $content,
    'likes' => $likes,
];

deletePostImagesFromDatabase($connection, $postData);
deletePostFromDatabase($connection, $postData);

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
    'message' => 'Post updated successfully',
    'post' => [
        'id'      => $postId,
        'user_id' => $userId,
        'content' => $content,
        'images'  => $imagePaths
    ]
];
echo json_encode($response);
exit;
