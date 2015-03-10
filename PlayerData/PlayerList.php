<?php
require("PlayerNode.php");

class PlayerList{
    private $pQueue;

    public function __construct(){
        $this->pQueue = new SplPriorityQueue();
    }

    public function addPlayer($_pPlayerNode, $_iPlayerScore){
        $this->pQueue->insert($_pPlayerNode, $_iPlayerScore);
    }

    public function getQueue(){
        $pPlayerQueue = $this->pQueue;
        $pPlayerQueue->top();
        return($pPlayerQueue);
    }

}