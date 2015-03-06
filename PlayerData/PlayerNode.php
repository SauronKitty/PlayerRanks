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

    // Set/get the player's name
    public function setName($_sPlayerName){
        if(is_string($_sPlayerName)) {
            $this->sPlayerName = $_sPlayerName;
            return true;
        }
        else return false;
    }

    public function getName(){
        return($this->sPlayerName);
    }

    // Set/get the total number of kills made by a player
    public function setKills($_iPlayerKills){
        if(is_int($_iPlayerKills)) {
            $this->iPlayerKills = $_iPlayerKills;
            return true;
        }
        else return false;
    }

    public function getKills(){
        return($this->iPlayerKills);
    }

    // Set/get the total number of times a player has died
    public function setDeaths($_iPlayerDeaths){
        if(is_int($_iPlayerDeaths)) {
            $this->iPlayerDeaths = $_iPlayerDeaths;
            return true;
        }
        else return false;
    }

    public function getDeaths(){
        return($this->iPlayerDeaths);
    }

    // Set/get a player's total playtime
    public function setPlayTime($_iPlayerTime){
        if(is_int($_iPlayerTime)){
            $this->iPlayerTime = $_iPlayerTime;
            return true;
        }
        else return false;
    }

    public function getPlayTime(){
        return($this->iPlayerTime);
    }

    // Set/get number of shots fired by a player
    public function setShots($_iPlayerShots){
        if(is_int($_iPlayerShots)){
            $this->iPlayerShots = $_iPlayerShots;
            return true;
        }
        else return false;
    }

    public function getShots(){
        return($this->iPlayerShots);
    }

    // Set/get the number of shots that actually hit a target
    public function setHits($_iPlayerHits){
        if(is_int($_iPlayerHits)){
            $this->iPlayerHits = $_iPlayerHits;
            return true;
        }
        return false;
    }

    public function getHits(){
        return($this->iPlayerHits);
    }

    // Set/get the number of headshots made by a player
    public function setHeadshots($_iPlayerHeadshots){
        if(is_int($_iPlayerHeadshots)){
            $this->iPlayerHeadshots = $_iPlayerHeadshots;
            return true;
        }
        else return false;
    }

    public function getHeadshots(){
        return($this->iPlayerHeadshots);
    }

    // Set/get the number of times a player has hurt a member of their team
    public function setFriendlyFire($_iPlayerFriendlyFire){
        if(is_int($_iPlayerFriendlyFire)){
            $this->iPlayerFriendlyFire = $_iPlayerFriendlyFire;
            return true;
        }
        else return false;
    }

    public function getFriendlyFire(){
        return($this->iPlayerFriendlyFire);
    }

    // Set/get the number of times a player has protected a team member
    public function setTeamProtects($_iPlayeTeamProtects){
        if(is_int($_iPlayeTeamProtects)){
            $this->iPlayerTeamProtects = $_iPlayeTeamProtects;
            return true;
        }
        else return false;
    }

    public function getTeamProtects(){
        return($this->iPlayerTeamProtects);
    }

    // Set/get the number of times a player has healed a team member
    public function setTeamHeals($_iPlayerTeamHeals){
        if(is_int($_iPlayerTeamHeals)){
            $this->iPlayerTeamHeals = $_iPlayerTeamHeals;
            return true;
        }
        else return false;
    }

    public function getTeamHeals(){
        return($this->iPlayerTeamHeals);
    }

    // Set/get the number of times a player has defibed a team member
    public function setTeamDefibs($_iPlayerTeamDefibs){
        if(is_int($_iPlayerTeamDefibs)){
            $this->iPlayerTeamDefibs = $_iPlayerTeamDefibs;
            return true;
        }
        else return false;
    }

    public function getTeamDefibs(){
        return($this->iPlayerTeamDefibs);
    }

    // Set/get the number of times a player has revived an incapacitated team member
    public function setTeamRevives($_iPlayerTeamRevives){
        if(is_int($_iPlayerTeamRevives)){
            $this->iPlayerTeamRevives = $_iPlayerTeamRevives;
            return true;
        }
        else return false;
    }

    public function getTeamRevives(){
        return($this->iPlayerTeamRevives);
    }

    // Set/get the number of times a player has killed a spitter
    public function setKillsSpitter($_iPlayerKillsSpitter){
        if(is_int($_iPlayerKillsSpitter)){
            $this->iPlayerKillsSpitter = $_iPlayerKillsSpitter;
            return true;
        }
        else return false;
    }

    public function getKillsSpitter(){
        return($this->iPlayerKillsSpitter);
    }

    // Set/get the number of times a player has killed a charger
    public function setKillsCharger($_iPlayerKillsCharger){
        if(is_int($_iPlayerKillsCharger)){
            $this->iPlayerKillsCharger = $_iPlayerKillsCharger;
            return true;
        }
        else return false;
    }

    public function getKillsCharger(){
        return($this->iPlayerKillsCharger);
    }

    // Set/get the number of times a player has killed a smoker
    public function setKillsSmoker($_iPlayerKillsSmoker){
        if(is_int($_iPlayerKillsSmoker)){
            $this->iPlayerKillsSmoker = $_iPlayerKillsSmoker;
            return true;
        }
        else return false;
    }

    public function getKillsSmoker(){
        return($this->iPlayerKillsSmoker);
    }

    // Set/get the number of times a player has killed a hunter
    public function setKillsHunter($_iPlayerKillsHunter){
        if(is_int($_iPlayerKillsHunter)){
            $this->iPlayerKillsHunter = $_iPlayerKillsHunter;
            return true;
        }
        else return false;
    }

    public function getKillsHunter(){
        return($this->iPlayerKillsHunter);
    }

    // Set/get the number of times a player has killed a jockey
    public function setKillsJockey($_iPlayerKillsJockey){
        if(is_int($_iPlayerKillsJockey)){
            $this->iPlayerKillsJockey = $_iPlayerKillsJockey;
            return true;
        }
        else return false;
    }

    public function getKillsJockey(){
        return($this->iPlayerKillsJockey);
    }

    // Set/get the number of times a player has killed a boomer
    public function setKillsBoomer($_iPlayerKillsBoomer){
        if(is_int($_iPlayerKillsBoomer)){
            $this->iPlayerKillsBoomer = $_iPlayerKillsBoomer;
            return true;
        }
        else return false;
    }

    public function getKillsBoomer(){
        return($this->iPlayerKillsBoomer);
    }

    // Set/get the next node
    public function setNext($_pNext){
        $this->pNext = $_pNext;
    }

    public function getNext(){
        return($this->pNext);
    }
}