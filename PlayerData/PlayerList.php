<?php

class PlayerList {
    private $pHead;
    private $pTail;
    private $iLength;

    public function __construct(){
        $this->pHead = null;
        $this->pTail = $this->pHead;
        $this->iLength = 0;
    }

    public function addPlayer($_sPlayerName, $_iPlayerScore){
        $pTemporary = new PlayerNode($_sPlayerName, $_iPlayerScore, null);

        if($this->iLength == 0) {
            $this->pHead = $pTemporary;
            $this->pTail = $pTemporary;
        }
        else
            $this->pTail->setNext($pTemporary);

        $this->iLength++;
        return;
    }


}