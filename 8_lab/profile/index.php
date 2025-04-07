<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="styles.css">
    <title>Profile</title>
</head>

<body>
    <div class="navigation">
        <a href="http://localhost:8001/home/">
            <img src="src/home.png" alt="Home" class="navigation-image">
        </a>
        <a href="http://localhost:8001/profile/?id=1">
            <img src="src/profile_active.png" alt="Profile" class="navigation-image">
        </a>
        <img src="src/plus.png" alt="Plus" class="navigation-image">
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
</body>

</html>