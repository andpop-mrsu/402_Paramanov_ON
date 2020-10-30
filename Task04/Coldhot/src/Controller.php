<?php 
  namespace OlegParamonov\Coldhot\Controller;
  use function OlegParamonov\Coldhot\View\showGame;

function mainMenu()
{
    while (true) {
        $command = \cli\prompt("Введите ключ");
        if ($command == "--new") {
            startGame();
        } elseif ($command == "--list") {
            listGames();
        } else {
            \cli\line("Неверный ключ");
        }
    }
}    

function startGame()
{
    showGame();

    $db = openDatabase();

    date_default_timezone_set("Europe/Moscow");
    $gameData = date("d") . "." . date("m") . "." . date("Y");
    $gameTime = date("H") . ":" . date("i") . ":" . date("s");
    $playerName = getenv("username");

    $array = array(0, 1, 2, 3, 4, 5, 7, 8, 9);
    shuffle($array);
    $currentNumber = array($array[0], $array[1], $array[2]);
    $hiddenNumber = implode('', $currentNumber);
    $number = 0;

    $db->exec("INSERT INTO gamesInfo (
        gameData, 
        gameTime,
        playerName,
        hiddenNumber,
        result
        ) VALUES (
        '$gameData', 
        '$gameTime',
        '$playerName',
        '$hiddenNumber',
        'Не закончено'
        )");

    $idGame = $db->querySingle("SELECT idGame FROM gamesInfo ORDER BY idGame DESC LIMIT 1");

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

function listGames()
{
    $db = openDatabase();
    $query = $db->query('SELECT * FROM gamesInfo');
    while ($row = $query->fetchArray()) {
        \cli\line("ID $row[0])\n Дата: $row[1]\n Время: $row[2]\n Имя: $row[3]\n Загаданное число: $row[4]\n Результат: $row[5]");
    }
}

function createDatabase()
{
    $db = new \SQLite3('gamedb.db');

    $gamesInfoTable = "CREATE TABLE gamesInfo(
        idGame INTEGER PRIMARY KEY,
        gameData DATE,
        gameTime TIME,
        playerName TEXT,
        hiddenNumber TEXT,
        result TEXT
    )";
    $db->exec($gamesInfoTable);

    $stepsInfoTable = "CREATE TABLE stepsInfo(
        idGame INTEGER,
        result INTEGER
    )";
    $db->exec($stepsInfoTable);

    return $db;
}

function openDatabase()
{
    if (!file_exists("gamedb.db")) {
        $db = createDatabase();
    } else {
        $db = new \SQLite3('gamedb.db');
    }
    return $db;
}

function updateDB($idGame, $result)
{
    $db = openDatabase();
    $db->exec("UPDATE gamesInfo
        SET result = '$result'
        WHERE idGame = '$idGame'");
}