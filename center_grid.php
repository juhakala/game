<?php
session_start();
$map = array_fill(0, 15000, 0);
$ships = $_SESSION['game'];
$size = 0;
foreach ($ships as $ship) {
    $size += $ship[2] * $ship[3];
}

echo "<div class='grid'>";
for ($i = 0; $i < 15000 - $size; $i++) {
    echo "<div></div>";
}

$here = 0;
foreach ($ships as $key => $ship) {
    $x = $ship[0] + 1;
    $y = $ship[1] + 1;
    $w = $ship[2];
    $h = $ship[3];
    if ($key % 2 == 0)
        echo "<div class='orange scale' style='grid-column: {$x} / span {$w}; grid-row: {$y} / span {$h};'></div>";
    else
        echo "<div class='blue scale' style='grid-column: {$x} / span {$w}; grid-row: {$y} / span {$h};'></div>";
}
echo "</div>";

?>
