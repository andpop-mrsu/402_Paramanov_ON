<?php

namespace OlegParamonov\Coldhot\Controller;

use function OlegParamonov\Coldhot\View\showGame;

function startGame()
{
    showGame();

    $array = array(0, 1, 2, 3, 4, 5, 7, 8, 9);
    shuffle($array);
    $currentNumber = array($array[0], $array[1], $array[2]);
    $number = 0;

    while ($number != $currentNumber) {
        $number = readline("Введите трехзначное число : ");
        if (is_numeric($number)) {
            if (strlen($number) != 3) {
                echo "Ошибка! Число должно быть трехзначным\n";
            } else {
                $numberArray = str_split($number);
                if ($numberArray == $currentNumber) {
                    echo "Вы выиграли!\n";
                    exit;
                } else {
                    $hot_array = array_intersect_assoc($numberArray, $currentNumber);
                    $heat_array = array_intersect($numberArray, $currentNumber);
                    if (count($hot_array) != 0) {
                        echo("Горячо!\n");
                    } elseif (count($heat_array) != 0) {
                        echo("Тепло!\n");
                    } else {
                        echo "Холодно!\n";
                    }
                }
            }
        } else {
            echo "Ошибка! Введите число.\n";
        }
    }
}
