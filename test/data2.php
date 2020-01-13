<?php
$array = [
    [null, 7, 6, "Bad"],
    [null, 6, 6, "Bad"],
    [null, 6, 5, "Bad"],
    [null, 1, 3, "Good"],
    [null, 2, 4, "Good"],
    [null, 2, 2, "Good"],
];
$arrayx = [
    [null, 7, 6, "Bad"],
    [null, 6, 6, "Bad"],
    [null, 6, 5, "Bad"],
    [null, 1, 3, "Good"],
    [null, 2, 4, "Good"],
    [null, 2, 2, "Good"],
];


for ($i = 0; $i < count($arrayx); $i++) {
    $arrayx[$i][1] = ($arrayx[$i][1] - 1) * (1 - 0) / ((7 - 1) + 0);
    $arrayx[$i][2] = ($arrayx[$i][2] - 2) * (1 - 0) / ((6 - 2) + 0);
}

$dataBaru = [3, 5];
$distance;
$k = 3;
$good = array();
$bad = array();
