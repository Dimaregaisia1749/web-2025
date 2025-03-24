<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<body>
    <form method="post" action="">
        <div>
            <label for="input1">Первое поле:</label>
            <input type="text" name="input1" id="input1" placeholder="Введите значение">
            <button type="submit" name="submit1">Показать первое</button>
        </div>
        <div>
            <label for="input2">Второе поле:</label>
            <input type="text" name="input2" id="input2" placeholder="Введите значение">
            <button type="submit" name="submit2">Показать второе</button>
        </div>
    </form>
    <p>
        <?php
        if (isset($_POST['submit1']) or isset($_POST['submit2'])) {
            echo "Первое: " . htmlspecialchars($_POST['input1']). "\n";
        }
        ?>
    </p>
    <p>
        <?php
        if (isset($_POST['submit1']) or isset($_POST['submit2'])) {
            echo "Второе: " . htmlspecialchars($_POST['input2']) . "\n";
        }
        ?>
    </p>
</body>
</html>
