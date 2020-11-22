<?php

Class Ship {
    public $run;
    public $values;
    function __construct($arr) {
        $arr = explode(',', $arr);
        $this->run = [$arr[0], $arr[1], $arr[2], $arr[3]];
    }
    function getRun() { return $this->run; }
}