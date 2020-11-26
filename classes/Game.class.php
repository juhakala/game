<?php
require_once('Dice.class.php');
require_once('Ship.class.php');
Class Game {
    public $dice;
    public $ships = array();
    public $turn_list = array();
    public $used_list = array();
    public $col_map;
    function __construct($arr, $values) {
        $this->dice = new Dice();
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
        $this->newTurn();
    }
    function newTurn() {
        $this->turn_list = array();
        $this->used_list = array();
        foreach ($this->ships as $key => $ship) {
            $this->turn_list[$key] = ($ship->name);
        }
        ksort($this->turn_list);
        $this->makeCollision();
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
    function makeCollision() {
        $ships = $this->getShipsRun();
        $this->col_map = array_fill(0, 15000, -1);
        foreach ($ships as $key => $ship) {
            for ($i = 0; $i < $ship[3]; $i++) {
                for ($j = 0; $j < $ship[2]; $j++) {
                    $this->col_map[$j + $ship[0] + ($i + $ship[1]) * 150] = $key;
                }
            }
        }
    }
    function checkShipCollision($index) {
        if ($this->ships[$index]->checkCollision($this->col_map, $index))
            return (1);
        return (0);
    }
    
}