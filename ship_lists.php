<?php

require_once('classes/Game.class.php');
session_start();
?>
<div style='margin-top: 10%;'>
	<?php foreach ($_SESSION['game']->turn_list as $key => $ship) {
		echo "<div>{$key}: {$ship}</div>"; 
	}?>
</div>