<?php
//session_start();
require_once('classes/Game.class.php');
$ini = parse_ini_file('config.ini', true);
$ships = $ini['ships'];
$_SESSION['game'] = new Game($ships);
//print_r($_SESSION['game']->ships);