<?php require_once 'scripts.php'; ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Задания</title>
</head>

<body>
    <div>
        <p>Является ли год високосным</p>
        <form method="post">
            <input type="text" name="input1" placeholder="год">
            <button type="submit" name="submit1">Ввести</button>
        </form>
        <?php
        one()
        ?>
        <p>_______________________</p>
    </div>
    <div>
        <p>Цифра -> слово</p>
        <form method="post">
            <input type="text" name="input2" placeholder="цифра">
            <button type="submit" name="submit2">Ввести</button>
        </form>
        <?php
        two()
        ?>
        <p>_______________________</p>
    </div>
    <div>
        <p>Знак зодиака</p>
        <form method="post">
            <input type="text" name="input3" placeholder="ДД.ММ.ГГГГ">
            <button type="submit" name="submit3">Ввести</button>
        </form>
        <?php
        three()
        ?>
        <p>_______________________</p>
    </div>
    <div>
        <p>Счастливые билеты</p>
        <form method="post">
            <input type="text" name="input4" placeholder="от">
            <input type="text" name="input5" placeholder="до">
            <button type="submit" name="submit5">Ввести</button>
        </form>
        <?php
        four()
        ?>
        <p>_______________________</p>
    </div>
    <div>
        <p>Факториал</p>
        <form method="post">
            <input type="text" name="input6" placeholder="число">
            <button type="submit" name="submit6">Ввести</button>
        </form>
        <?php
        six()
        ?>
        <p>_______________________</p>
    </div>
    <div>
        <p>Обратная польская нотация</p>
        <form method="post">
            <input type="text" name="input7" placeholder="выражение">
            <button type="submit" name="submit7">Ввести</button>
        </form>
        <?php
        seven()
        ?>
        <p>_______________________</p>
    </div>
</body>

</html>