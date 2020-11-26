<?php
require_once('classes/Game.class.php');
session_start();

$map = array_fill(0, 15000, 0);
$ships = $_SESSION['game']->ships;
$ships = $_SESSION['game']->getShipsRun();
$size = 0;
foreach ($ships as $ship)
    $size += $ship[2] * $ship[3];
echo "<div class='grid'>";
for ($i = 0; $i < 15000 - $size; $i++)
    echo "<div></div>";
foreach ($ships as $key => $ship) {
    $x = $ship[0] + 1;
    $y = $ship[1] + 1;
    $w = $ship[2];
    $h = $ship[3];
    if ($key % 2 == 0)
        echo "<div onclick='selectShip({$key},0)' class='orange scale' style='grid-column: {$x} / span {$w}; grid-row: {$y} / span {$h};'></div>";
    else
        echo "<div onclick='selectShip({$key},1)' class='blue scale' style='grid-column: {$x} / span {$w}; grid-row: {$y} / span {$h};'></div>";
}
echo "</div>";

?>
<script>
var actv = '';
    var actv = '<?php echo $_SESSION['active_ship']; ?>';
    if (actv != '') {
        $.get('control_panel.php', {}, function (data) {
            if (actv % 2 == 0)
                $('.left').html(data);
            else
                $('.right').html(data);
        });
    }

    function selectShip(key, place) {
        console.log(<?php echo $_SESSION['phase']; ?>);
        if (<?php echo $_SESSION['phase']; ?> <= 0 && key % 2 != <?php echo $_SESSION['last']; ?> % 2) {
            $.get('control_panel.php', {id:key}, function (data) {
                if (place == 0) {
                    $('.left').html(data);
                    $('.right').html('');
                }
                else {
                    $('.right').html(data);
                    $('.left').html('');
                }
            });
        }
    }
</script>