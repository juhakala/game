<?php

require_once('classes/Game.class.php');
session_start();

$ships = $_SESSION['game']->getShipsValues();
if (isset($_GET['id'])) {
    $_SESSION['active_ship'] = $_GET['id'];
    echo 'session active ships is ' .$_SESSION['active_ship'];
}
if (isset($_SESSION['active_ship']) && $_SESSION['active_ship'] != "") {
    $ship = $ships[$_SESSION['active_ship']];
    ?>
    <div class='controlPanel'>
        <?php print_r($ship); ?>
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
                console.log('activate button ' + data);
            });
        }
    </script>
<?php }