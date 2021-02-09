<?php

namespace App\Test;

use App\Vector;

function runTest()
{
    $v1 = new Vector(2, 6, 1);
    echo "v1 = " . $v1 . "\n"; // (2, 6, 1)
    
    $v2 = new Vector(1, 5, -4);
    echo "v2 = " . $v2 . "\n"; // (1, 5, -4)

    $vectorAddition = $v1->add($v2);
    $vectorDifference = $v1->sub($v2);
    $vectorNumberProduct = $v1->product(2);
    $scalarProduct = $v1->scalarProduct($v2);
    $vectorProduct = $v1->vectorProduct($v2);

    echo "Сумма векторов\n";
    echo $vectorAddition; // (3; 11; -3)
    echo "\nРазность векторов\n";
    echo $vectorDifference; // (1; 1; 5)
    echo "\nПроизведение вектора на число\n";
    echo $vectorNumberProduct; // (4; 12; 2)
    echo "\nСкалярное произведение векторов\n";
    echo $scalarProduct; // 28
    echo "\nВекторное произведение\n";
    echo $vectorProduct; // (29; -9; -4)
}
