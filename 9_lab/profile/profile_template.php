<?php
require_once '../data/sql/db_scripts.php';
$connection = connectDatabase();
$user = findUserInDatabase($connection, $id);
$posts = findAllUsersPosts($connection, $id);
?>
<div class="content">
    <div class="profile">
        <img src=<?= $user['logo_path'] ?> alt="User 1" class="logo">
        <p class="name"><?= $user['username'] ?></p>
        <p class="description"><?= $user['description'] ?></p>
        <div class="post-counter">
            <img class="post-image" src="src/post.png" alt="Posts">
            <p class="post-text"><?= count($posts)?> постов</p>
        </div>
        <div class="posts">
            <?php foreach ($posts as $post): ?>
                <?php
                    $first_image = findPostImagesInDatabase($connection, $post['id'])[0];
                ?>
                <img src=<?= $first_image['image_path'] ?> alt="Post" class="image">
            <?php endforeach; ?>
        </div>
    </div>
</div>