<?php

class PlayerManager {
    private $pPlayerQueue;

    public function __construct(){
        $hDatabase = new Database("./Raw/playerranks.db");
        $this->pPlayerQueue = new PlayerQueue();
        $this->populateQueue($hDatabase);
    }

    private function populateQueue(Database &$_hDatabase){
        $hResponse = $_hDatabase->execQuery("SELECT * From Players");
        foreach($hResponse as $hRow){
            $hPlayerNode = new PlayerNode();

            // Parse each database row into a PlayerNode
            $hPlayerNode->setName($hRow['PlayerName']);
            $hPlayerNode->setSteamId($hRow['PlayerSteam']);
            $hPlayerNode->setGameMeId($hRow['PlayerId']);
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

            // ScoreCalculator will take the $hPlayerNode by refrence and automatically calculate the score
            // based on the data passed earlier. ScoreCalculator will automatically also call the
            // $hPlayerNode->setPlayerScore() and update the node's score
            new ScoreCalculator($hPlayerNode);
            // Insert $hPlayerNode into the PriorityQueue with the calculated score as the Node's priority
            $this->pPlayerQueue->addPlayer($hPlayerNode, $hPlayerNode->getPlayerScore());
        }
    }

    public function getQueue(){
        $hQueueRefrence = &$this->pPlayerQueue->getQueue();
        return($hQueueRefrence);
    }
}