<?php
session_start();
if (!isset($_SESSION['game']) || $_SESSION['game'] != "")
    require_once('new_game.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/center_grid.css">
    </head>
    <body>
        <div>
            <div class='control left'>
            </div>
            <div class='control right'>
            </div>
            <div class='center'>
                <?php include('center_grid.php'); ?>
            </div>
        </div>
    </body>
</html>