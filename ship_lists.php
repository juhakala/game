<?php

require_once('classes/Game.class.php');
session_start();
?>
<div style='margin-top: 10%;'>
	<?php foreach ($_SESSION['game']->turn_list as $key => $ship) {
		echo "<div>{$key}: {$ship}</div>"; 
	}?>
</div>

<div style='margin-top: 10%;'>
	<?php foreach ($_SESSION['game']->used_list as $key => $ship) {
		echo "<div style='text-decoration:line-through;'>{$key}: {$ship}</div>"; 
	}?>
</div>