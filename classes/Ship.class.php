<?php

Class Ship {
    public $name = 'kyolevi';
    public $run;        // x, y, w, h
    public $values;     // atm => hp, pp, speed, weapons, dir, handling, name
    public $phase = ([0, 0, 0, 0]); //repair, shield, speed, weapon
    public $movement = ([0, 0]);   // stationary, handling
    function __construct($run,$values) {
        $arr = explode(',', $run);
        $this->run = [$arr[0], $arr[1], $arr[2], $arr[3]];
        $arr = explode(',', $values);
        $this->values = [$arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5]];
        $this->name = $arr[6];
    }
    function updatePhase($arr) {
        $this->phase = ([$arr[0], $arr[1], $arr[2] + $this->values[2], $arr[3] + $this->values[3]]);
    }
    function turn($dir, $x, $y) {
        $this->run = ([$x, $y, $this->run[3], $this->run[2]]);
        $this->values[4] = $dir;
        $this->movement[1] = $this->values[5];
        if ($this->movement[0] != 0)
            $this->phase[2]--;
    }
    function moveForward() {
        $this->phase[2]--;
        $this->movement[1]--;
        if ($this->values[4] == 1)
            $this->run[0] += 1;
        else if ($this->values[4] == 2)
            $this->run[1] += 1;
        else if ($this->values[4] == -1)
            $this->run[0] -= 1;
        else if ($this->values[4] == -2)
            $this->run[1] -= 1;
    }
    function getRun() { return $this->run; }
    function getValues() { return $this->values; }
}   