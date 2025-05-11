<!DOCTYPE html>
<html lang="ru">

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
                <a href="#" class="nav__link">
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
</body>

</html>