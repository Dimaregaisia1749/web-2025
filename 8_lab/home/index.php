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
        $jsonData = file_get_contents('../posts.json');
        $posts = json_decode($jsonData, true);
        require_once '../validation.php';
        $validationResults = validatePostsJson($posts);
        if (count($validationResults) > 0) {
            foreach ($validationResults as $post) {
                echo "<p>$post \n</p>";
            }
        } else {
            foreach ($posts as $post) {
                include 'post_template.php';
            }
        }
        ?>
    </div>
</body>

</html>