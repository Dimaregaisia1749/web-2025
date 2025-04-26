<?php
require_once '../data/sql/db_scripts.php';
$user = findUserInDatabase($connection, $post['user_id']);
$post_images = findPostImagesInDatabase($connection, $post['id']);
?>
<div class="post">
    <div class="post__header">
        <a href="http://localhost:8001/profile/?id=<?= $user['id'] ?>" class="post__user">
            <img src="<?= $user['logo_path'] ?>" alt="<?= htmlspecialchars($user['username'], ENT_QUOTES) ?>" class="post__user-avatar">
            <span class="post__user-name"><?= htmlspecialchars($user['username'], ENT_QUOTES) ?></span>
        </a>
        <a href="http://localhost:8001/post/edit/?id=<?= $post['id'] ?>" class="post__edit">
            <img src="src/edit.png" alt="Edit post" class="post__edit-icon">
        </a>
    </div>

    <div class="post__carousel">
        <img src="<?= $post_images[0]['image_path'] ?>" alt="Post image" class="post__image">
        <?php if (count($post_images) > 1): ?>
            <span class="post__counter">1/<?= count($post_images) ?></span>
            <button type="button" class="post__arrow post__arrow--left">
                <img src="src/left.png" alt="Previous" class="post__arrow-icon">
            </button>
            <button type="button" class="post__arrow post__arrow--right">
                <img src="src/right.png" alt="Next" class="post__arrow-icon">
            </button>
        <?php endif; ?>
    </div>

    <div class="post__actions">
        <a href="#" class="post__like">
            <img src="src/like.png" alt="Like" class="post__like-icon">
            <span class="post__like-count"><?= $post['likes'] ?></span>
        </a>
    </div>

    <div class="post__content">
        <p class="post__text"><?= htmlspecialchars($post['content'], ENT_QUOTES) ?></p>
        <span class="post__more">...еще</span>
    </div>

    <?php include_once "format_time.php"; ?>
    <div class="post__time"><?= timeAgo(strtotime('now') - strtotime($post['created_at'])) ?></div>
</div>