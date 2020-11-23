<?php

require_once('classes/Game.class.php');
session_start();

$ships = $_SESSION['game']->getShipsValues();
$ship = $ships[$_GET['id']];
print_r($ship);
?>
<div class='controlPanel'>
    <p>placeholder for nice control panel</p>
    <p>name, size, hull points, engine power(pp), speed, handling, shield, weapons(list/array)</p>
    <p>activate confirm button that turns to submit button when pressed</p>
    <?php
    if ($_SESSION['phase'] <= 0)
        echo "<div onclick='activateShip()' class='btn-activate'>activate</div>";
    else 
        echo "<div class='btn-activate btn-activated'>activate</div>";
    ?>
</div>
<script>
    function activateShip() {
        $.get('new_game.php', {name:'phase'}, function (data) {
            $(".controlPanel").load("control_panel.php");
            $(".center").load("center_grid.php");
            console.log(data);
        });
    }
</script>