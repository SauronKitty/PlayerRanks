<?php

class PlayerNode{
    // Player Data
    private $sPlayerName;
    private $iPlayerKills;
    private $iPlayerDeaths;
    private $iPlayerTime;
    private $iPlayerShots;
    private $iPlayerHits;
    private $iPlayerHeadshots;
    private $iPlayerFriendlyFire;
    private $iPlayerTeamProtects;
    private $iPlayerTeamHeals;
    private $iPlayerTeamDefibs;
    private $iPlayerTeamRevives;
    private $iPlayerKillsSpitter;
    private $iPlayerKillsCharger;
    private $iPlayerKillsSmoker;
    private $iPlayerKillsHunter;
    private $iPlayerKillsJockey;
    private $iPlayerKillsBoomer;

    private $pNext;

    public function __construct(){
        $this->sPlayerName          = null;
        $this->iPlayerKills         = 0;
        $this->iPlayerDeaths        = 0;
        $this->iPlayerTime          = 0;
        $this->iPlayerShots         = 0;
        $this->iPlayerHits          = 0;
        $this->iPlayerHeadshots     = 0;
        $this->iPlayerFriendlyFire  = 0;
        $this->iPlayerTeamProtects  = 0;
        $this->iPlayerTeamHeals     = 0;
        $this->iPlayerTeamDefibs    = 0;
        $this->iPlayerTeamRevives   = 0;
        $this->iPlayerKillsSpitter  = 0;
        $this->iPlayerKillsCharger  = 0;
        $this->iPlayerKillsSmoker   = 0;
        $this->iPlayerKillsHunter   = 0;
        $this->iPlayerKillsJockey   = 0;
        $this->iPlayerKillsBoomer   = 0;
    }

    public function setName($_sPlayerName){
        $this->sPlayerName = $_sPlayerName;
    }

    public function getName(){
        return($this->sPlayerName);
    }

    public function setKills($_iPlayerKills){
        $this->iPlayerKills = $_iPlayerKills;
    }

    public function getKills(){
        return($this->iPlayerKills);
    }

    public function setNext($_pNext){
        $this->pNext = $_pNext;
    }

    public function getNext(){
        return($this->pNext);
    }
}