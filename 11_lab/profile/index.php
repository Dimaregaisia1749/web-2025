<!DOCTYPE html>
<html lang="ru">

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
                <a href="http://localhost:8001/profile/?id=1" class="nav__link">
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
        if ($id === false) {
            header("Location: http://localhost:8001/home/");
        }
        include 'profile_template.php';
        ?>
    </div>
</body>

</html>