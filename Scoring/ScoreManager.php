<?php

class ScoreManager {
    private $pPlayer;
    private $iPlayerScore;

    public function __construct(PlayerNode $_pPlayer){
        $this->setPlayer($_pPlayer);
        $this->calculateScore();
    }

    public function setPlayer(PlayerNode $_pPlayer){
        $this->pPlayer = $_pPlayer;
    }

    public function getScore(){
        return($this->iPlayerScore);
    }

    private function getKillToDeathRatio(){
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

    private function getInfecedKills(){
        $iSpitterKills = $this->pPlayer->getKillsSpitter();
        $iChargerKills = $this->pPlayer->getKillsCharger();
        $iSmokerKills = $this->pPlayer->getKillsSmoker();
        $iHunterKills = $this->pPlayer->getKillsHunter();
        $iJockeyKills = $this->pPlayer->getKillsJockey();
        $iBoomerKills = $this->pPlayer->getKillsBoomer();

        $iTotalKills = $iSpitterKills + $iChargerKills + $iSmokerKills + $iHunterKills + $iJockeyKills + $iBoomerKills;
        return($iTotalKills);
    }

    private function calculateScore(){
        $iKillsPerMinute = $this->getKillsPerMinute();
        $iKillsToDeaths = $this->getKillToDeathRatio();
        $iHeadShotRatio = $this->getHeadShotToKillsRatio();
        $iTeamAssists = $this->getTeamAssists();
        $iAccuracy = $this->getAccuracy();
        $iInfectedKills = $this->getInfecedKills();
        $iPlayTime = $this->pPlayer->getPlayTime();
        $iPlayTime = $iPlayTime/60; // Convert to minutes

        // Apply Modifications
        $iKillsToDeaths /= 100;
        $iInfectedKills /= $iPlayTime;
        $iKillsPerMinute *= 33.4;

        $iScore = $iKillsPerMinute +
            ($iKillsToDeaths + $iTeamAssists + $iAccuracy + $iHeadShotRatio + $iInfectedKills)*500;
        $this->iPlayerScore = (int)$iScore;
    }
}