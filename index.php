<?php
require_once('classes/Game.class.php');
//session_start();
require_once('new_game.php');
//$_SESSION['game']->ships[0]->run[0] = 50;

?>
<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/center_grid.css">
        <link rel="stylesheet" href="css/control_panel.css">
        <link rel="stylesheet" href="css/control_panel_phase_1.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="wrap">
            <div class='control left'>
                <!--control_panel left-->
            </div>
            <div class='control right'>
                <!--control_panel right-->
            </div>
            <div class='center'>
                <!--center_grid included in $.get method-->
            </div>
            <div class='shipList'>

            </div>
        </div>
        <button onclick='phaseReset()'>Reset</button>
    </body>
</html>
<script>
    $.get('center_grid.php', {}, function (data) {
        $('.center').html(data);
    });
    $.get('ship_lists.php', {}, function (data) {
        $('.shipList').html(data);
    });
    // for phase reset to 0 testing
    function phaseReset() {
        $.get('new_game.php', {name:'reset'}, function (data) {
            $(".center").load("center_grid.php");
            console.log(data);
            $('.right').html('');
            $('.left').html('');
        });
    }
    console.log('index' + <?php echo $_SESSION['phase']?>);
</script>