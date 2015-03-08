<?php
class PlayerManager {
    private $hDatabase;
    private $pPlayerList;

    public function __construct(){
        $this->hDatabase = new Database("./Raw/playerranks.db");
        $this->pPlayerList = new PlayerList();
        $this->populateList();
    }

    private function populateList(){
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

            $this->pPlayerList->addPlayer($hPlayerNode);
        }
    }

    public function getList(){
        return($this->pPlayerList->getList());
    }
}