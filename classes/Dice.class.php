<?php

Class Dice {
	public $values = ([0]);
	public $total = 0;
	function throwDice($n) {
		$this->total = 0;
		$this->values = array();
		for ($i = 0; $i < $n; $i++) {
			$this->values[$i] = rand(1, 6);
			$this->total += $this->values[$i];
		}
		return ($this->values);
	}
	function getTotal() { return $this->total; }
	function getValues() { return $this->values; }
}