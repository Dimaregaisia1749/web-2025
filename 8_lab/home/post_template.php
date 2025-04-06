<div class="post">  
    <div class="userdata">
        <a href="http://localhost:8001/profile/?id=<?= $post['author']['user_id'] ?>">
            <img src=<?= $post['author']['logo_path'] ?> alt="User 1" class="logo">
            <p class="name"> <?= $post['author']['user_name'] ?> </p>
        </a>
        <img src="src/edit.png" alt="Edit" class="edit">
    </div>
    <div class="image-wrapper">
        <img src=<?= $post['images'][0]["path"] ?> alt="Content 1" class="post-image">
        <?php if (count($post['images']) > 1): ?>
            <p class="image-count"> 1/<?= count($post['images'])?></p>
            <img src="src/left.png" alt="Left arrow" class="left">
            <img src="src/right.png" alt="Right arrow" class="right">
        <?php endif; ?>
    </div>
    <div class="likes">
        <img src="src/like.png" alt="Like" class="like-image">
        <p class="like-count"><?= $post['likes'] ?></p>
    </div>
    <p class="post-text">
        <?= $post['text'] ?>
    </p>
    <span class="expand">...еще</span>
    <?php
    include_once "format_time.php" 
    ?>
    <p class="time"> <?= timeAgo(strtotime('now') - $post['timestamp']) ?></p>
</div> 