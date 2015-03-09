<?php
require("../PlayerData/PlayerNode.php");

class ScoreManager {
    private $pPlayer;

    public function __construct(){
        $this->pPlayer = new PlayerNode();
        //$this->pPlayer = null;
    }

    public function setPlayer($_pPlayer){
        $this->pPlayer = $_pPlayer;
    }

    private function getKillToDeathRation(){
        $iKills = $this->pPlayer->getKills();
        $iDeaths = $this->pPlayer->getDeaths();

        return($iKills/$iDeaths);
    }

    private function getHeadShotToKillsRatio(){
        $iHeadshots = $this->pPlayer->getHeadshots();
        $iKills = $this->pPlayer->getKills();

        return($iHeadshots/$iKills);
    }

    private function getKillsPerMinute(){
        $iPlayTime = $this->pPlayer->getPlayTime();
        $iPlayTime = $iPlayTime/60; // Convert seconds to minutes
        $iKills = $this->pPlayer->getKills();

        return($iKills/$iPlayTime);
    }

    private function getTeamAssists(){
        $iDefibs = $this->pPlayer->getTeamDefibs();
        $iHeals = $this->pPlayer->getTeamHeals();
        $iRevives = $this->pPlayer->getTeamRevives(); // Help up incapacitated players
        $iPlayTime = $this->pPlayer->getPlayTime();
        $iPlayTime = $iPlayTime/60;

        $iTotalAssists = $iDefibs + $iHeals + $iRevives;
        return($iTotalAssists/$iPlayTime);
    }

    private function getAccuracy(){
        $iShots = $this->pPlayer->getShots();
        $iHits = $this->pPlayer->getHits();

        return($iHits/$iShots);
    }

    private function calculateScore(){

    }
}