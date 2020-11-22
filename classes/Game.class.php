<?php
require_once('Ship.class.php');
Class Game {
    public $ships = array();
    function __construct($arr) {
        $ally = 0;
        $enemy = 1;
        foreach($arr as $key => $ship) {
            if (strpos($key, 'ally') !== false) {
                $this->ships[$ally] = new Ship($ship);
                $ally += 2;
            }
            else {
                $this->ships[$enemy] = new Ship($ship);
                $enemy += 2;
            }
        }
    }
    function getShipsRun() {
        $arr = array();
        foreach ($this->ships as $key => $ship)
            $arr[$key] = $ship->getRun();
        return $arr;
    }
}