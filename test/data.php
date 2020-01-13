<?php

$array = [
    [100, 50],
    [40, 60],
    [30, 70],
    [90, 10],
    [65, 40],
    [25, 35],
    [50, 90],
    [55, 80],
    [20, 30],
    [70, 25],
    [90, 70],
];

$pangkat = 2;

$c1 = sqrt(pow($array[0][0] - $array[0][0], 2) + pow($array[0][1] - $array[0][1], 2));

$c2 = sqrt(pow($array[1][0] - $array[1][0], 2) + pow($array[1][1] - $array[1][1], 2));

$centroidX;
$centroidY;


$x1 = $array[1][0];
$x0 = $array[0][0];
$y1 = $array[1][1];
$y0 = $array[0][1];
$centroidX = sqrt(pow($x1 - $x0, 2) + pow($y1 - $y0, 2));

// echo number_format($centroidX, 2) . " ";
$x0 = $array[1][0];
$x1 = $array[0][0];
$y0 = $array[1][1];
$y1 = $array[0][1];
$centroidY = sqrt(pow($x1 - $x0, 2) + pow($y1 - $y0, 2));
// echo number_format($centroidY, 2) . " ";
