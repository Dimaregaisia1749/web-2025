<?php
require_once '../api/login/auth_scripts.php';
$user = getUserInfo();
$user_id = $user['id'];
$user_email = $user['email'];
?>

<!DOCTYPE html>
<html lang="ru">
<script src="../scripts/user_logo.js" defer></script>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="styles.css">
    <title>Profile</title>
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
                    <img src="src/profile_active.png" alt="Profile" class="nav__icon">
                </a>
            </div>
            <div class="nav__item">
                <a href="http://localhost:8001/addpost/" class="nav__link">
                    <img src="src/plus.png" alt="Add" class="nav__icon">
                </a>
            </div>
        </div>

        <?php
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
            'filter' => FILTER_CALLBACK,
            'options' => function ($value) {
                return (strlen($value) >= 1 && strlen($value) <= 100000) ? $value : false;
            }
        ]);
        
        if ($id === null) {
            $id = $user_id;
        }
        include 'profile_template.php';
        ?>

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