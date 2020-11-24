<?php
require_once('classes/Game.class.php');
session_start();

if (isset($_GET['name']) && $_GET['name'] === 'reset') {
    $_SESSION['game'] = "";
    $_SESSION['active_ship'] = "";
}
if (!isset($_SESSION['game']) || $_SESSION['game'] == "") {
    $ini = parse_ini_file('config.ini', true);
    $ships = $ini['ships_run'];
    $values = $ini['ships_values'];
    $_SESSION['game'] = new Game($ships, $values);
    $_SESSION['phase'] = 0;
    echo $_SESSION['phase'];
} else if (isset($_GET['name']) && $_GET['name'] === 'phase') {
    if ($_SESSION['phase'] <= 0) {
        $_SESSION['phase'] = 1;
        $_SESSION['game']->ships[2]->run[0] += 2;
    }
    echo $_SESSION['phase'];
}