<?php
function timeAgo($timeDiff)
{
    if ($timeDiff < 0) {
        return "Пост из будущего";
    }

    $units = [
        ['секунд', 60],
        ['минут', 60],
        ['час', 24],
        ['день', 7],
        ['недел', 4.35],
        ['месяц', 12],
        ['год', 100]
    ];

    foreach ($units as $unit) {
        if ($timeDiff < $unit[1]) {
            return formatTime($timeDiff, $unit[0]);
        }
        $timeDiff /= $unit[1];
    }

    return "Давно";
}

function formatTime($value, $unit)
{
    $value = floor($value);
    $forms = [
        'секунд' => ['секунду', 'секунды', 'секунд'],
        'минут' => ['минуту', 'минуты', 'минут'],
        'час' => ['час', 'часа', 'часов'],
        'день' => ['день', 'дня', 'дней'],
        'недел' => ['неделю', 'недели', 'недель'],
        'месяц' => ['месяц', 'месяца', 'месяцев'],
        'год' => ['год', 'года', 'лет']
    ];

    return $value . " " . pluralForm($value, $forms[$unit]) . " назад";
}

function pluralForm($n, $forms)
{
    return ($n % 10 == 1 && $n % 100 != 11) ? $forms[0] :
           ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[1] : $forms[2]);
}
?>