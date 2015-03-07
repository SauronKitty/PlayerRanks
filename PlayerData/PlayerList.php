<?php
require("PlayerNode.php");

class PlayerList{
    private $pList;

    public function __construct(){
        $this->pList = new SplDoublyLinkedList();
    }

    public function addPlayer($_sPlayerName){
        $pTemporary = new PlayerNode();
        if(is_string($_sPlayerName)) {
            $pTemporary->setName($_sPlayerName);
            $this->pList->push($pTemporary);
            return true;
        }
        else return false;
    }

    public function getList(){
        return($this->pList);
    }

}