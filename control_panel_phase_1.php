<?php
for ($i = 0; $i < 4; $i++) {
	$val = $_SESSION['game']->ships[$_SESSION['active_ship']]->phase[$i] ?>
	<div class="input-group">
  		<input class='btn-plus-minus' type="button" value="-" id="button-minus" data-field="quantity<?php echo $i ?>">
  		<input class='show' id="show<?php echo $i; ?>" type="number" step="1" max="" value="<?php echo $val; ?>" name="quantity<?php echo $i ?>">
  		<input class='btn-plus-minus' type="button" value="+" id="button-plus" data-field="quantity<?php echo $i ?>">
	</div>
<?php }
if ($_SESSION['phase'] == 1)
    echo "<div onclick='submitShip()' class='btn-activate'>submit</div>";
else 
	echo "<div class='btn-activate btn-activated'>submit</div>";
if ($_SESSION['phase'] > 1) {
	echo "<div class='repair-cont'>";
	if ($_SESSION['game']->ships[$_SESSION['active_ship']]->phase[0] > 0) {
		echo "<div onclick='throwRepair()' class='btn-activate'>RepairDice</div>";
	} else if ($_SESSION['game']->ships[$_SESSION['active_ship']]->phase[0] < 0) {
		echo "<div class='btn-activate btn-activated btn-repair'>RepairDice</div>";
		$dices = $_SESSION['game']->dice->getValues();
		foreach ($dices as $dice) {
			echo "<div class='dice-roll'><span>{$dice}</span></div>";
		}
	}
	echo "</div>";
	if ($_SESSION['game']->ships[$_SESSION['active_ship']]->phase[2] > 0) {
	?>
	<div class="movement-group">
		<input class='btn-plus-minus move' type="button" onclick="ft_movement('F')" value='F'>
		<input class='btn-plus-minus move' type="button" onclick="ft_movement('L')" value='L'>
		<input class='btn-plus-minus move' type="button" onclick="ft_movement('R')" value='R'>
	</div> <?php } else { ?>
	<div class="movement-group">
		<input class='btn-plus-minus move move-over' type="button" value='F'>
		<input class='btn-plus-minus move move-over' type="button" value='L'>
		<input class='btn-plus-minus move move-over' type="button" value='R'>
	</div>
<?php
	}
	if ($_SESSION['phase'] > 2) {
		if ($_SESSION['phase'] === 3) {
			?><input class='btn-plus-minus move' type="button" onclick="ft_shoot()" value='Shootie'><?php
		} else {
			?><input class='btn-plus-minus move move-over' type="button" value='Shootie'><?php
		} if ($_SESSION['phase'] === 4) {
			?><br><input class='btn-plus-minus move' type="button" onclick="ft_finish()" value='Finish'><?php
		}
	}
}
?>
<script>

var pp_max = <?php echo $_SESSION['game']->ships[$_SESSION['active_ship']]->values[1]; ?>;
var ship_id = <?php echo $_SESSION['active_ship']; ?>;

function incrementValue(e) {
	if (pp_max > 0) {
		pp_max--;
  		e.preventDefault();
  		var fieldName = $(e.target).data('field');
  		var parent = $(e.target).closest('div');
  		var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  		if (!isNaN(currentVal))
    		parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
  		else
    		parent.find('input[name=' + fieldName + ']').val(0);
  	}
}

function decrementValue(e) {
  	e.preventDefault();
  	var fieldName = $(e.target).data('field');
  	var parent = $(e.target).closest('div');
  	var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

  	if (!isNaN(currentVal) && currentVal > 0) {
    	parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
		pp_max++;
  	} else
    	parent.find('input[name=' + fieldName + ']').val(0);
}

if (<?php echo $_SESSION['phase']; ?> == 1) { 
	$('.input-group').on('click', '#button-plus', function(e) {
  		incrementValue(e);
	});
	$('.input-group').on('click', '#button-minus', function(e) {
  		decrementValue(e);
	});
}
function submitShip() {
    $.get('new_game.php', {
		name:'phase',
		id:ship_id,
		0:document.getElementById("show0").value,
		1:document.getElementById("show1").value,
		2:document.getElementById("show2").value,
		3:document.getElementById("show3").value
		}, function (data) {
        	$(".controlPanel").load("control_panel.php");
        	console.log('submit button ' + data);
    });
}

function throwRepair() {
	$.get('new_game.php', {name:'repair'}, function (data) {
		$(".controlPanel").load("control_panel.php");
		console.log('repair: ' + data);
	});
}
function ft_movement(value) {
	$.get('new_game.php', {name:'movement', val:value}, function (data) {
		$(".center").load("center_grid.php");
		console.log('movement: ' + data);
	});
}
function ft_shoot() {
	$.get('new_game.php', {name:'shoot'}, function (data) {
		$(".center").load("center_grid.php");
		console.log('shooting: ' + data);
	});
}
function ft_finish() {
	$.get('new_game.php', {name:'finish'}, function (data) {
		$(".center").load("center_grid.php");
		$.get('ship_lists.php', {}, function (data) {
        	$('.shipList').html(data);
    	});
		console.log('finish: ' + data);
	});
}
</script>