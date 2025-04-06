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
    $jsonData = file_get_contents('../users.json');
    $jsonData = json_decode($jsonData, true);
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
            'max_range' => 1000000
        ]
    ]);
    if (($id === false) || !isset($jsonData[$id])) {
        header("Location: http://localhost:8001/home/");
    }
    $user = $jsonData[$id];
    require_once '../validation.php';
    $validationResults = validateUserJson($jsonData);
    if (count($validationResults) > 0) {
        foreach ($validationResults as $post) {
            echo "<p>$post \n</p>";
        }
    } else {
        include 'profile_template.php';
    }
    ?>
</body>

</html>