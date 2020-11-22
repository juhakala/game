<?php
require_once('Ship.class.php');
Class Game {
    public $ships = array();
    function __construct($arr) {
        foreach($arr as $key => $ship) {
            $ally = 0;
            $enemy = 1;
            echo $ship ."\n";
            echo $key ."\n";
            if (strpos('ally', $key) !== false) {
                $this->ships[$ally] = new Ship($ship);
                $ally += 2;
                echo "here\n";
            }
            else {
                $this->ships[$enemy] = new Ship($ship);
                $enemy += 2;
                echo "enemy\n";
            }
            //print_r($this->ships[$ally]);
        }
    }
    function getShips() { return $ships; }
}