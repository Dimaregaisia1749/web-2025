<?php
require_once '../data/sql/db_scripts.php';
$connection = connectDatabase();
$user = findUserInDatabase($connection, $id);
$posts = findAllUsersPosts($connection, $id);
if (empty($user)) {
    $id = 1;
    $user = findUserInDatabase($connection, $id);
    $posts = findAllUsersPosts($connection, $id);
}
?>
<div class="user-profile">
    <div class="user-profile__info">
        <img src=<?= $user['logo_path'] ?> alt="User 1" class="user-profile__logo">
        <p class="user-profile__username"><?= $user['username'] ?></p>
        <p class="user-profile__description"><?= $user['description'] ?></p>
        <div class="user-profile__stat">    
            <img class="user-profile__stat-icon" src="src/post.png" alt="Posts">
            <p class="user-profile__stat-count"><?= count($posts) ?> постов</p>
        </div>
    </div>
    <div class="posts">
        <?php foreach ($posts as $post): ?>
            <?php
                $first_image = findPostImagesInDatabase($connection, $post['id'])[0];
            ?>
            <img src=<?= $first_image['image_path'] ?> alt="Post" class="posts__post">
        <?php endforeach; ?>
    </div>
</div>