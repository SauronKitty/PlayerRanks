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
    private $iPlayerScore;


    public function __construct(){
        $this->setName(null);
        $this->setKills(0);
        $this->setDeaths(0);
        $this->setPlayTime(0);
        $this->setShots(0);
        $this->setHits(0);
        $this->setHeadshots(0);
        $this->setFriendlyFire(0);
        $this->setTeamProtects(0);
        $this->setTeamHeals(0);
        $this->setTeamDefibs(0);
        $this->setTeamRevives(0);
        $this->setKillsSpitter(0);
        $this->setKillsCharger(0);
        $this->setKillsSmoker(0);
        $this->setKillsHunter(0);
        $this->setKillsJockey(0);
        $this->setKillsBoomer(0);
        $this->setPlayerScore(0);
    }

    // Set/get the player's name
    public function setName($_sPlayerName){
        $this->sPlayerName = $_sPlayerName;
    }

    public function getName(){
        return($this->sPlayerName);
    }

    // Set/get the total number of kills made by a player
    public function setKills($_iPlayerKills){
        $this->iPlayerKills = $_iPlayerKills;
    }

    public function getKills(){
        return($this->iPlayerKills);
    }

    // Set/get the total number of times a player has died
    public function setDeaths($_iPlayerDeaths){
        $this->iPlayerDeaths = $_iPlayerDeaths;
    }

    public function getDeaths(){
        return($this->iPlayerDeaths);
    }

    // Set/get a player's total playtime
    public function setPlayTime($_iPlayerTime){
        $this->iPlayerTime = $_iPlayerTime;
    }

    public function getPlayTime(){
        return($this->iPlayerTime);
    }

    // Set/get number of shots fired by a player
    public function setShots($_iPlayerShots){
        $this->iPlayerShots = $_iPlayerShots;
    }

    public function getShots(){
        return($this->iPlayerShots);
    }

    // Set/get the number of shots that actually hit a target
    public function setHits($_iPlayerHits){
            $this->iPlayerHits = $_iPlayerHits;
    }

    public function getHits(){
        return($this->iPlayerHits);
    }

    // Set/get the number of headshots made by a player
    public function setHeadshots($_iPlayerHeadshots){
        $this->iPlayerHeadshots = $_iPlayerHeadshots;
    }

    public function getHeadshots(){
        return($this->iPlayerHeadshots);
    }

    // Set/get the number of times a player has hurt a member of their team
    public function setFriendlyFire($_iPlayerFriendlyFire){
        $this->iPlayerFriendlyFire = $_iPlayerFriendlyFire;
    }

    public function getFriendlyFire(){
        return($this->iPlayerFriendlyFire);
    }

    // Set/get the number of times a player has protected a team member
    public function setTeamProtects($_iPlayeTeamProtects){
        $this->iPlayerTeamProtects = $_iPlayeTeamProtects;
    }

    public function getTeamProtects(){
        return($this->iPlayerTeamProtects);
    }

    // Set/get the number of times a player has healed a team member
    public function setTeamHeals($_iPlayerTeamHeals){
        $this->iPlayerTeamHeals = $_iPlayerTeamHeals;
    }

    public function getTeamHeals(){
        return($this->iPlayerTeamHeals);
    }

    // Set/get the number of times a player has defibed a team member
    public function setTeamDefibs($_iPlayerTeamDefibs){
        $this->iPlayerTeamDefibs = $_iPlayerTeamDefibs;
    }

    public function getTeamDefibs(){
        return($this->iPlayerTeamDefibs);
    }

    // Set/get the number of times a player has revived an incapacitated team member
    public function setTeamRevives($_iPlayerTeamRevives){
        $this->iPlayerTeamRevives = $_iPlayerTeamRevives;
    }

    public function getTeamRevives(){
        return($this->iPlayerTeamRevives);
    }

    // Set/get the number of times a player has killed a spitter
    public function setKillsSpitter($_iPlayerKillsSpitter){
        $this->iPlayerKillsSpitter = $_iPlayerKillsSpitter;
    }

    public function getKillsSpitter(){
        return($this->iPlayerKillsSpitter);
    }

    // Set/get the number of times a player has killed a charger
    public function setKillsCharger($_iPlayerKillsCharger){
        $this->iPlayerKillsCharger = $_iPlayerKillsCharger;
    }

    public function getKillsCharger(){
        return($this->iPlayerKillsCharger);
    }

    // Set/get the number of times a player has killed a smoker
    public function setKillsSmoker($_iPlayerKillsSmoker){
        $this->iPlayerKillsSmoker = $_iPlayerKillsSmoker;
    }

    public function getKillsSmoker(){
        return($this->iPlayerKillsSmoker);
    }

    // Set/get the number of times a player has killed a hunter
    public function setKillsHunter($_iPlayerKillsHunter){
        $this->iPlayerKillsHunter = $_iPlayerKillsHunter;
    }

    public function getKillsHunter(){
        return($this->iPlayerKillsHunter);
    }

    // Set/get the number of times a player has killed a jockey
    public function setKillsJockey($_iPlayerKillsJockey){
        $this->iPlayerKillsJockey = $_iPlayerKillsJockey;
    }

    public function getKillsJockey(){
        return($this->iPlayerKillsJockey);
    }

    // Set/get the number of times a player has killed a boomer
    public function setKillsBoomer($_iPlayerKillsBoomer){
        $this->iPlayerKillsBoomer = $_iPlayerKillsBoomer;
    }

    public function getKillsBoomer(){
        return($this->iPlayerKillsBoomer);
    }

    // Set/get the player's score
    public function setPlayerScore($_iPlayerScore){
        $this->iPlayerScore = $_iPlayerScore;
    }

    public function getPlayerScore(){
        return($this->iPlayerScore);
    }
}