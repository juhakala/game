<?php
session_start();
require_once('classes/Game.class.php');
$ini = parse_ini_file('config.ini');
$ships = array($ini['ally1'], $ini['ally2'], $ini['ally3'], $ini['ally4'],
                $ini['enemy1'], $ini['enemy2'], $ini['enemy3'], $ini['enemy4']);
$_SESSION['game'] = new Game($ships);
//print_r($_SESSION['game']);