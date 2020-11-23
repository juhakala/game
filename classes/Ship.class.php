<?php

Class Ship {
    public $run;        // x, y, w, h
    public $values;     // atm => hp, pp, speed, weapons, dir
    public $val;
    function __construct($run,$values) {
        $arr = explode(',', $run);
        $this->run = [$arr[0], $arr[1], $arr[2], $arr[3]];
        $arr = explode(',', $values);
        $this->values = [$arr[0], $arr[1], $arr[2], $arr[3], $arr[4]];
    }
    function getRun() { return $this->run; }
    function getValues() { return $this->values; }
}