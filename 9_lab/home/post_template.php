<?php
require_once '../data/sql/db_scripts.php';
$user = findUserInDatabase($connection, $post['user_id']);
$post_images = findPostImagesInDatabase($connection, $post['id']);
?>
<div class="post">
    <div class="post__header">
        <a href="http://localhost:8001/profile/?id=<?= $user['id'] ?>" class="post__user">
            <img src="<?= $user['logo_path'] ?>" alt="<?= htmlspecialchars($user['username']) ?>" class="post__logo">
            <span class="post__username"><?= htmlspecialchars($user['username']) ?></span>
        </a>
        <a href="#" class="post__edit">
            <img src="src/edit.png" alt="Edit post" class="post__edit-icon">
        </a>
    </div>

    <div class="post__carousel">
        <img src="<?= $post_images[0]['image_path'] ?>" alt="Post image" class="post__image">
        <?php if (count($post_images) > 1): ?>
            <span class="post__counter">1/<?= count($post_images) ?></span>
            <button type="button" class="post__arrow post__arrow-left">
                <img src="src/left.png" alt="Previous" class="post__arrow-icon">
            </button>
            <button type="button" class="post__arrow post__arrow-right">
                <img src="src/right.png" alt="Next" class="post__arrow-icon">
            </button>
        <?php endif; ?>
    </div>

    <div class="post__actions">
        <div class="post__like">
            <img src="src/like.png" alt="Like" class="post__like-icon">
            <span class="post__like-count"><?= $post['likes'] ?></span>
        </div>
    </div>

    <div class="post__content">
        <p class="post__text"><?= htmlspecialchars($post['content']) ?></p>
        <span class="post__more">еще</span>
    </div>

    <?php include_once "format_time.php"; ?>
    <div class="post__time"><?= timeAgo(strtotime('now') - strtotime($post['created_at'])) ?></div>
</div>