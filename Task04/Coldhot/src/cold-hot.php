<?php

echo "Холодно-горячо";

array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
shuffle($array);
if ($array[0] == 0) shuffle($array);
$number = array($array[0], $array[1], $array[2]); 
echo "<br> Загаданное число: " . (implode('', $number)) . " ";

if (isset($_POST["ugadat"])) { 
    $chislo = $_POST["chislo"];
    if ($chislo < 100 or $chislo > 999) { 
        echo "<br> Ошибка! Ваше число не трехзначное!"; 
        exit;
    } 
    $chislo_arr = str_split($chislo);
    echo "<br> Введенное число: " . (implode('', $chislo_arr) . " ");

    if ($number == $chislo_arr) {
        echo "<br> Вы отгадали!";
        exit;
    }

    $hot_array = array_intersect_assoc($chislo_arr, $number);
    $heat_array = array_intersect($chislo_arr, $number);
    if (count($hot_array) != 0) {
     echo ("<br> Горячо!");
    }  
    elseif (count($heat_array) != 0) {
        echo ("<br> Тепло!"); 
    } 
    else echo "<br> Холодно!";
}

?>
<html>
    <head>
        <title>Cold-hot</title>
    </head>
</html>
<body>
    <form method="post">
        <input type="text" value="" name="chislo" /> 
        <input type="submit" name="ugadat" value="Угадать" /><br/>
    </form>
</body>
</html>