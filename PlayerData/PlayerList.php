<?php

class PlayerList{
    private $pList;

    public function __construct(){
        $this->pList = new SplDoublyLinkedList();
    }

//    public function addPlayer($_sPlayerName, $_iPlayerScore){
//        $pTemporary = new PlayerNode($_sPlayerName, $_iPlayerScore, null);
//
//        if($this->iLength == 0) {
//            $this->pHead = $pTemporary;
//            $this->pTail = $pTemporary;
//        }
//        else
//            $this->pTail->setNext($pTemporary);
//
//        $this->iLength++;
//        return;
//    }

//

}