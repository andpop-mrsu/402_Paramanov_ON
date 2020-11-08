<?php

namespace OlegParamonov\Coldhot\Model;

use RedBeanPHP\R as R;

use function OlegParamonov\Coldhot\View\showGame;

function startGameDB($gameData, $gameTime, $playerName, $hiddenNumber)
{
    openDatabase();

    R::exec(
        "INSERT INTO gamesInfo (
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
        )"
    );

    return R::getcell("SELECT idGame FROM gamesInfo ORDER BY idGame DESC LIMIT 1");
}

function listGames()
{
    openDatabase();
    $query = R::getAll('SELECT * FROM gamesInfo');
    foreach ($query as $row) {
        \cli\line("ID $row[idGame]");
        \cli\line("Дата: $row[gameData]");
        \cli\line("Время: $row[gameTime]");
        \cli\line("Имя: $row[playerName]");
        \cli\line("Загаданное число: $row[hiddenNumber]");
        \cli\line("Результат: $row[result]");
    }
}

function createDatabase()
{
    R::setup("sqlite:gamedb.db");

    $gamesInfoTable = "CREATE TABLE gamesInfo(
        idGame INTEGER PRIMARY KEY,
        gameData DATE,
        gameTime TIME,
        playerName TEXT,
        hiddenNumber TEXT,
        result TEXT
    )";
    R::exec($gamesInfoTable);

    $stepsInfoTable = "CREATE TABLE stepsInfo(
        idGame INTEGER,
        result INTEGER
    )";
    R::exec($stepsInfoTable);
}

function openDatabase()
{
    if (!file_exists("gamedb.db")) {
        createDatabase();
    } else {
        R::setup("sqlite:gamedb.db");
    }
}

function updateDB($idGame, $result)
{
    R::exec(
        "UPDATE gamesInfo
        SET result = '$result'
        WHERE idGame = '$idGame'"
    );
}
