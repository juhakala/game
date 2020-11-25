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
} else if (isset($_GET['name'])) { 
    if ($_GET['name'] === 'phase') {
        if ($_SESSION['phase'] <= 0)
            $_SESSION['phase'] = 1;
        else if ($_SESSION['phase'] == 1) {
            $_SESSION['phase'] = 2;
            $_SESSION['game']->ships[$_SESSION['active_ship']]->updatePhase([$_GET[0], $_GET[1], $_GET[2], $_GET[3]]);
        }
        echo $_SESSION['phase'];
    } else if ($_GET['name'] === 'repair') {
        $_SESSION['game']->dice->throwDice($_SESSION['game']->ships[$_SESSION['active_ship']]->phase[0]);
        $_SESSION['game']->ships[$_SESSION['active_ship']]->phase[0] *= -1;
        echo $_SESSION['game']->dice->getTotal();
    } else if ($_GET['name'] === 'movement') {
        if ($_GET['val'] !== 'F' && $_SESSION['game']->ships[$_SESSION['active_ship']]->movement[1] < 1) {
            $w = floor($_SESSION['game']->ships[$_SESSION['active_ship']]->run[2] / 2);
            $h = floor($_SESSION['game']->ships[$_SESSION['active_ship']]->run[3] / 2);
            $x = $_SESSION['game']->ships[$_SESSION['active_ship']]->run[0] + $w - $h;
            $y = $_SESSION['game']->ships[$_SESSION['active_ship']]->run[1] + $h - $w;
            $dir = $_SESSION['game']->ships[$_SESSION['active_ship']]->values[4];
            if ($_GET['val'] == 'L') {
                $d = $dir == 1 ? -2 : -1;
                $d = $dir == 2 ? 1 : $d;
                $d = $dir == -1 ? 2 : $d;
            }
            else if ($_GET['val'] == 'R') {
                $d = $dir == 1 ? 2 : 1;
                $d = $dir == 2 ? -1 : $d;
                $d = $dir == -1 ? -2 : $d;
            }
            $_SESSION['game']->ships[$_SESSION['active_ship']]->turn($d, $x, $y);
        } else if ($_GET['val'] === 'F')
            $_SESSION['game']->ships[$_SESSION['active_ship']]->moveForward();
        $_SESSION['game']->ships[$_SESSION['active_ship']]->movement[0] = 1;
        if ($_SESSION['game']->ships[$_SESSION['active_ship']]->phase[2] == 0)
            $_SESSION['phase'] = 3;
        echo $_GET['val'];
    } else if ($_SESSION['phase'] == 3) {
        // shootie mac shootiephase
        $_SESSION['phase'] = 4;
    } else if ($_SESSION['phase'] == 4) {
        $_SESSION['game']->used_list[] = $_SESSION['game']->turn_list[$_SESSION['active_ship']]; 
        unset($_SESSION['game']->turn_list[$_SESSION['active_ship']]);
        print_r($_SESSION['game']->turn_list);
        print_r($_SESSION['game']->used_list);
        $_SESSION['active_ship'] = "";
        $_SESSION['phase'] = 0;
    }
}

//echo $_SESSION['game']->ships[2]->values[5];