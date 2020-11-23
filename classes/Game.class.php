<?php
require_once('Ship.class.php');
Class Game {
    public $ships = array();
    function __construct($arr, $values) {
        $ally = 0;
        $enemy = 1;
        foreach($arr as $key => $ship) {
            if (strpos($key, 'ally') !== false) {
                $this->ships[$ally] = new Ship($ship, $values[$key]);
                $ally += 2;
            }
            else {
                $this->ships[$enemy] = new Ship($ship, $values[$key]);
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
    function getShipsValues() {
        $arr = array();
        foreach ($this->ships as $key => $ship)
            $arr[$key] = $ship->getValues();
        return $arr;
    }
    
}