<?php
require_once '../data/sql/db_scripts.php';
$user = findUserInDatabase($connection, $post['user_id']);
$post_images = findPostImagesInDatabase($connection, $post['id']);
?>
<div class="post">  
    <div class="userdata">
        <a href="http://localhost:8001/profile/?id=<?= $user['id'] ?>">
            <img src=<?= $user['logo_path'] ?> alt="User 1" class="logo">
            <p class="name"> <?= $user['username'] ?> </p>
        </a>
        <img src="src/edit.png" alt="Edit" class="edit">
    </div>
    <div class="image-wrapper">
        <img src=<?= $post_images[0]["image_path"] ?> alt="Content 1" class="post-image">
        <?php if (count($post_images) > 1): ?>
            <p class="image-count"> 1/<?= count($post_images)?></p>
            <img src="src/left.png" alt="Left arrow" class="left">
            <img src="src/right.png" alt="Right arrow" class="right">
        <?php endif; ?>
    </div>
    <div class="likes">
        <img src="src/like.png" alt="Like" class="like-image">
        <p class="like-count"><?= $post['likes'] ?></p>
    </div>
    <p class="post-text">
        <?= $post['content'] ?>
    </p>
    <span class="expand">...еще</span>
    <?php
    include_once "format_time.php"
    ?>
    <p class="time"> <?= timeAgo(strtotime('now') - strtotime($post['created_at'])) ?></p>
</div> 