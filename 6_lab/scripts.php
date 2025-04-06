<?php 

function isLeapYear(int $a): string
{
    if ($a <=    0) {
        return "Год должен быть больше 0";
    }
    if (($a % 4 === 0 && $a % 100 !== 0) || ($a % 400 === 0)) {
        return "YES";
    }
    return "NO";
}

function intToWord(int $a): string
{
    return match ($a) {
        1 => 'один',
        2 => 'два',
        3 => 'три',
        4 => 'четыре',
        5 => 'пять',
        6 => 'шесть',
        7 => 'семь',
        8 => 'восемь',
        9 => 'девять',
        default => 'некорректный ввод',
    };
}

function getZodiac(int $day, int $month): string
{
    if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 20)) {
        return "Овен";
    }
    if (($month == 4 && $day >= 21) || ($month == 5 && $day <= 20)) {
        return "Телец";
    }      
    if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
        return "Близнецы";
    }
    if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) { 
        return "Рак";
    }
    if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) { 
        return "Лев";
    }
    if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        return "Дева";
    }
    if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
        return "Весы";
    }
    if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
        return "Скорпион";
    }
    if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
        return "Стрелец";
    }
    if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
        return "Козерог";
    }
    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
        return "Водолей";
    }
    if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
        return "Рыбы";
    }
    return "Некорректная дата";
}

function luckyTickets(int $start, int $end): array
{
    $array = [];
    for ($i = $start; $i <= $end; $i++) {
        $digits = str_split($i);
        $sum1 = $digits[0] + $digits[1] + $digits[2];
        $sum2 = $digits[3] + $digits[4] + $digits[5];
        if ($sum1 === $sum2) {
            array_push($array, $i);
        }
    };
    return $array;
}

function fac(int $a): int
{
    if ($a > 1) {
        return fac($a - 1) * $a;
    }
    return 1;
}

function compute(string $a): float
{
    $tokens = explode(' ', $a);
    $stack = [];

    foreach ($tokens as $token) {
        if (is_numeric($token)) {
            $stack[] = (float)$token;
        } else {
            $b = array_pop($stack);
            $a = array_pop($stack);
            if (($a === null) or ($a === null)){
                return INF;
            } 
            switch ($token) {
                case '+':
                    $stack[] = $a + $b;
                    break;
                case '-':
                    $stack[] = $a - $b;
                    break;
                case '*':
                    $stack[] = $a * $b;
                    break;
                case '/':
                    if ($b == 0) {
                        return INF;
                    }
                    $stack[] = $a / $b;
                    break;
                default:
                    return INF;

            }
        }
    }
    return $stack[0];
}

function one()
{
    if (isset($_POST['submit1'])) {
        $ans = isLeapYear((int) $_POST['input1']);
        echo "<p>$ans</p>";
    }
}

function two()
{
    if (isset($_POST['submit2'])) {
        $ans = intToWord((int) $_POST['input2']);
        echo "<p>$ans</p>";
    }
}

function three()
{
    if (isset($_POST['submit3'])) {
        $d = htmlspecialchars($_POST['input3']);
        $date = DateTime::createFromFormat('d.m.Y', $d);
        if (($date !== false) && ($date->format('d.m.Y') === $d)) {
            $ans = getZodiac($date->format('d'), $date->format('m'));
            echo "<p>$ans</p>";
        } else {
            echo "<p>Неверный ввод</p>";
        }
    }
}

function four()
{
    if (isset($_POST['submit5'])) {
        $from = (int) $_POST['input4'];
        $to = (int) $_POST['input5'];
        if ((intdiv($from, 100000) == 0) || ((intdiv($from, 100000) == 0))) {
            echo "<p>Номера не шестизначные</p>";   
        } elseif ($from > $to) {
            echo "<p>Первый номер больше последнего</p>";
        } else {
            $ans = luckyTickets($from, $to);
            foreach ($ans as $item) {
                echo "<p>$item \n</p>";
            }
        }
    }
}

function six()
{
    if (isset($_POST['submit6'])) {
        $a = (int) $_POST['input6'];
        $ans = fac($a);
        echo "<p>$ans \n</p>";
    }
}

function seven()
{
    if (isset($_POST['submit7'])) {
        $a = htmlspecialchars($_POST['input7']);
        $ans = compute($a);
        if ($ans === INF) {
            echo "<p>Ошибочный ввод \n</p>";
        } else {
            echo "<p>$ans \n</p>";
        }
    }
}
?>