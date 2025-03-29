<div class="content">
    <div class="profile">
        <img src=<?= $user['logo_path'] ?> alt="User 1" class="logo">
        <p class="name"><?= $user['user_name'] ?></p>
        <p class="description"><?= $user['description'] ?></p>
        <div class="post-counter">
            <img class="post-image" src="src/post.png" alt="Posts">
            <p class="post-text"><?= count($user['posts'])?> постов</p>
        </div>
        <div class="posts">
            <?php foreach ($user['posts'] as $post): ?>
                <img src=<?= $post['path'] ?> alt="Post" class="image">
            <?php endforeach; ?>
        </div>
    </div>
</div>