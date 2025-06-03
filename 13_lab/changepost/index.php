<?php
require_once '../api/login/auth_scripts.php';
authBySession();
$user = getUserInfo();
$post_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'filter' => FILTER_CALLBACK,
    'options' => function ($value) {
        return (strlen($value) >= 1 && strlen($value) <= 100000) ? $value : false;
    }
]);

$connection = connectDatabase();
$postOwnerId = findPostInDatabase($connection, $post_id)['user_id'];
if (!($user['id'] == $postOwnerId)) {
    http_response_code(response_code: 401);
    exit;
}

$user_id = $user['id'];
$user_email = $user['email'];
?>
<!DOCTYPE html>
<html lang="ru">
<script src="scripts.js" defer></script>
<script src="../scripts/user_logo.js" defer></script>

<head>
    <meta charset="UTF-8">
    <title>Редактировать пост</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="wrapper">
        <div class="nav">
            <div class="nav__item">
                <a href="http://localhost:8001/home/" class="nav__link">
                    <img src="src/home.png" alt="Home" class="nav__icon">
                </a>
            </div>
            <div class="nav__item">
                <a href="http://localhost:8001/profile/" class="nav__link">
                    <img src="src/profile.png" alt="Profile" class="nav__icon">
                </a>
            </div>
            <div class="nav__item">
                <a href="http://localhost:8001/addpost/" class="nav__link">
                    <img src="src/plus.png" alt="Add" class="nav__icon">
                </a>
            </div>
        </div>

        <div class="add-post-result add-post-result_disabled">
            <p class="add-post-result__text"></p>
        </div>

        <div class="add-post">
            <p class="title">Редактирование поста</p>
            <div class="add-post__carousel">
                <button type="button" class="remove-button remove-button_disabled">
                    <img src="src/remove_button.png" alt="Remove" class="remove-button__icon">
                </button>
                <p class="add-post__counter add-post__counter_disabled"></p>
                <div class="add-post__images">
                    <?php
                    require_once '../data/sql/db_scripts.php';
                    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
                        'filter' => FILTER_CALLBACK,
                        'options' => function ($value) {
                            return (strlen($value) >= 1 && strlen($value) <= 100000) ? $value : false;
                        }
                    ]);
                    $connection = connectDatabase();
                    $post = findPostInDatabase($connection, $id);
                    ?>
                    <?php foreach (findPostImagesInDatabase($connection, $post['id']) as $img): ?>
                        <img src=<?=$img['image_path'] ?> alt="Post" class="add-post__image add-post__image_disabled">
                    <?php endforeach; ?>
                </div>
                <button type="button" class="add-post__arrow add-post__arrow-left add-post__arrow_disabled">
                    <img src="src/left.png" alt="Previous" class="add-post__arrow-icon">
                </button>
                <button type="button" class="add-post__arrow add-post__arrow-right add-post__arrow_disabled">
                    <img src="src/right.png" alt="Next" class="add-post__arrow-icon">
                </button>
                <img src="src/image_placeholder.png" alt="Placeholder" class="add-post__image-placeholder add-post__image-placeholder_disabled">
                <button class="btn-upload btn-upload_first btn-upload_disabled">Добавить фото</button>
            </div>
            <button class="btn-upload btn-upload_second btn-upload_disabled">
                <img src="src/add_post.png" alt="Add post" class="add-post__icon btn-upload">
                <p class="btn-upload__title">Добавить фото</p>
            </button>
            <input type="file" class="file-input" accept="image/*" multiple style="display: none">
            <textarea class="add-post__text" placeholder="Добавьте подпись..."> <?= $post['content'] ?> </textarea>
            <button class="btn-share">Сохранить изменения</button>
        </div>
        
        <div class="user-wrapper">
            <div class="user-icon">
                <?php
                echo $user_email
                ?>
            </div>
            <button type="button" class="exit">
                <img src="src/logout.png" alt="Exit" class="exit__icon">
            </button>
        </div>
    </div>  
</body>

</html>