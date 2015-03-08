<?php
require("PlayerNode.php");

class PlayerList{
    private $pList;

    public function __construct(){
        $this->pList = new SplDoublyLinkedList();
    }

    public function addPlayer($_pPlayerNode){
        $this->pList->push($_pPlayerNode);
    }

    public function getList(){
        return($this->pList);
    }

}