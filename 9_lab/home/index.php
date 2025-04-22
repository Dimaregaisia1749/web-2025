<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>

<body>
    <div class="navigation">
        <a href="http://localhost:8001/home/">
            <img src="src/home_active.png" alt="Home" class="navigation-image">
        </a>
        <a href="http://localhost:8001/profile/?id=1">
            <img src="src/profile.png" alt="Profile" class="navigation-image">
        </a>
        <img src="src/plus.png" alt="Plus" class="navigation-image">
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
</body>

</html>