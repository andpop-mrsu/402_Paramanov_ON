<?php

    namespace OlegParamonov\Coldhot\Controller;

    use RedBeanPHP\R as R;

    use function OlegParamonov\Coldhot\View\showGame;
    use function OlegParamonov\Coldhot\Model\startGameDB;
    use function OlegParamonov\Coldhot\Model\listGames;
    use function OlegParamonov\Coldhot\Model\createDatabase;
    use function OlegParamonov\Coldhot\Model\openDatabase;
    use function OlegParamonov\Coldhot\Model\updateDB;

function mainMenu($key)
{
    if ($key[1] == "--new") {
        startGame();
    } elseif ($key[1] == "--list") {
        listGames();
    } else {
        \cli\line("Неверный ключ");
    }
}

function startGame()
{
    showGame();

    date_default_timezone_set("Europe/Moscow");
    $gameData = date("d") . "." . date("m") . "." . date("Y");
    $gameTime = date("H") . ":" . date("i") . ":" . date("s");
    $playerName = getenv("username");

    $array = array(0, 1, 2, 3, 4, 5, 7, 8, 9);
    shuffle($array);
    $currentNumber = array($array[0], $array[1], $array[2]);
    $hiddenNumber = implode('', $currentNumber);
    $number = 0;

    $idGame = startGameDB($gameData, $gameTime, $playerName, $hiddenNumber);

    while ($number != $currentNumber) {
        $number = readline("Введите трехзначное число : ");
        if (is_numeric($number)) {
            if (strlen($number) != 3) {
                echo "Ошибка! Число должно быть трехзначным\n";
            } else {
                $numberArray = str_split($number);
                if ($numberArray == $currentNumber) {
                    echo "Вы выиграли!\n";
                    $result = "Победа";
                    updateDB($idGame, $result);
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
