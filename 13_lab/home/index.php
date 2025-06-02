<?php
require_once '../api/login/auth_scripts.php';
$user_id = getAuth();
?>

<!DOCTYPE html>
<html lang="ru">
<script src="slider.js" defer></script>
<script src="modal_window.js" defer></script>
<script src="expand.js" defer></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="nav">
            <div class="nav__item">
                <a href="http://localhost:8001/home/" class="nav__link">
                    <img src="src/home_active.png" alt="Home" class="nav__icon">
                </a>
            </div>
            <div class="nav__item">
                <a href="http://localhost:8001/profile/?id=1" class="nav__link">
                    <img src="src/profile.png" alt="Profile" class="nav__icon">
                </a>
            </div>
            <div class="nav__item">
                <a href="http://localhost:8001/addpost/" class="nav__link">
                    <img src="src/plus.png" alt="Add" class="nav__icon">
                </a>
            </div>
        </div>

        <div class="posts">
            <?php
            require_once '../data/sql/db_scripts.php';
            $connection = connectDatabase();
            $posts = findAllPosts($connection);
            foreach ($posts as $post) {
                include 'post_template.php';
            }
            ?>
        </div>
    </div>
    
    <div class="modal modal_disabled" id="modal">
        <div class="modal-wrapper">
            <button class="modal__close">X</button>
            <div class="modal__carousel">
                <div class="modal__images"></div>
                <button type="button" class="modal__arrow modal__arrow-left">
                    <img src="src/left.png" alt="Previous" class="modal__arrow-icon">
                </button>
                <button type="button" class="modal__arrow modal__arrow-right">
                    <img src="src/right.png" alt="Next" class="modal__arrow-icon">
                </button>
            </div>
            <div class="modal__counter"></div>
        </div>
    </div>
</div>
</body>

</html>