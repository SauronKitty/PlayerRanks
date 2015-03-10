<?php
class PlayerManager {
    private $hDatabase;
    private $pPlayerQueue;

    public function __construct(){
        $this->hDatabase = new Database("./Raw/playerranks.db");
        $this->pPlayerQueue = new PlayerList();
        $this->populateQueue();
    }

    private function populateQueue(){
        $hResponse = $this->hDatabase->execQuery("SELECT * From Players");
        foreach($hResponse as $hRow){
            $hPlayerNode = new PlayerNode();

            $hPlayerNode->setName($hRow['PlayerName']);
            $hPlayerNode->setKills($hRow['PlayerKills']);
            $hPlayerNode->setDeaths($hRow['PlayerDeaths']);
            $hPlayerNode->setPlayTime($hRow['PlayerTime']);
            $hPlayerNode->setShots($hRow['PlayerShots']);
            $hPlayerNode->setHits($hRow['PlayerHits']);
            $hPlayerNode->setHeadshots($hRow['PlayerHeadshots']);
            $hPlayerNode->setFriendlyFire($hRow['PlayerFriendlyFire']);
            $hPlayerNode->setTeamProtects($hRow['PlayerTeamProtects']);
            $hPlayerNode->setTeamHeals($hRow['PlayerTeamHeals']);
            $hPlayerNode->setTeamDefibs($hRow['PlayerTeamDefibs']);
            $hPlayerNode->setTeamRevives($hRow['PlayerTeamRevives']);
            $hPlayerNode->setKillsSpitter($hRow['PlayerKillsSpitter']);
            $hPlayerNode->setKillsCharger(($hRow['PlayerKillsCharger']));
            $hPlayerNode->setKillsSmoker($hRow['PlayerKillsSmoker']);
            $hPlayerNode->setKillsHunter($hRow['PlayerKillsHunter']);
            $hPlayerNode->setKillsJockey($hRow['PlayerKillsJockey']);
            $hPlayerNode->setKillsBoomer($hRow['PlayerKillsBoomer']);

            $hScoreManager = new ScoreManager($hPlayerNode);
            $iPlayerScore = $hScoreManager->getScore();
            $hPlayerNode->setPlayerScore($iPlayerScore);

            $this->pPlayerQueue->addPlayer($hPlayerNode, $iPlayerScore);
        }
    }

    public function getQueue(){
        return($this->pPlayerQueue->getQueue());
    }
}