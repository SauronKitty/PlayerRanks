<?php

class PlayerManager {
    private $pPlayerQueue;
    private $hDatabase;

    public function __construct(){
        $this->pPlayerQueue = null;
        $this->hDatabase = new Database("../Raw/playerranks.db");
    }

    public function populateQueue(){
        $this->pPlayerQueue = new PlayerQueue(); // Create the queue

        $hResponse = $this->hDatabase->getDatabase()->prepare("SELECT * FROM Players");
        if($hResponse->execute())
            foreach($hResponse as $hRow)
                $this->queuePlayer($this->loadPlayer($hRow));

        return;
    }

    public function getPlayerByName($_sPlayerName){
        $hResponse = $this->hDatabase->getDatabase()->prepare("SELECT * FROM Players WHERE PlayerName=?");
        $hResponse->execute(array($_sPlayerName));

        // TODO: Check to make sure reply is not null
        $hResponse = $hResponse->fetch(0);
        return ($this->loadPlayer($hResponse));
        //return null;
    }

    public function getPlayerBySteamId($_sPlayerGameMeId){
        $hResponse = $this->hDatabase->getDatabase()->prepare("SELECT * FROM Players WHERE PlayerId=?");
        $hResponse->execute(array($_sPlayerGameMeId));

        $hResponse = $hResponse->fetch(0);
        return($this->loadPlayer($hResponse));
    }

    public function getPlayerByGameMeId($_sPlayerGameMeId){
        $hResponse = $this->hDatabase->getDatabase()->prepare("SELECT * FROM Players WHERE PlayerSteam=?");
        $hResponse->execute(array($_sPlayerGameMeId));

        $hResponse = $hResponse->fetch(0);
        return($this->loadPlayer($hResponse));
    }

    // Load player data into a PlayerNode and a return a reference to that node
    private function &loadPlayer(&$_hRow){
        $hPlayerNode = new PlayerNode();

        // Parse each database row into a PlayerNode
        $hPlayerNode->setName($_hRow['PlayerName']);
        $hPlayerNode->setSteamId($_hRow['PlayerSteam']);
        $hPlayerNode->setGameMeId($_hRow['PlayerId']);
        $hPlayerNode->setKills($_hRow['PlayerKills']);
        $hPlayerNode->setDeaths($_hRow['PlayerDeaths']);
        $hPlayerNode->setPlayTime($_hRow['PlayerTime']);
        $hPlayerNode->setShots($_hRow['PlayerShots']);
        $hPlayerNode->setHits($_hRow['PlayerHits']);
        $hPlayerNode->setHeadshots($_hRow['PlayerHeadshots']);
        $hPlayerNode->setFriendlyFire($_hRow['PlayerFriendlyFire']);
        $hPlayerNode->setTeamProtects($_hRow['PlayerTeamProtects']);
        $hPlayerNode->setTeamHeals($_hRow['PlayerTeamHeals']);
        $hPlayerNode->setTeamDefibs($_hRow['PlayerTeamDefibs']);
        $hPlayerNode->setTeamRevives($_hRow['PlayerTeamRevives']);
        $hPlayerNode->setKillsSpitter($_hRow['PlayerKillsSpitter']);
        $hPlayerNode->setKillsCharger(($_hRow['PlayerKillsCharger']));
        $hPlayerNode->setKillsSmoker($_hRow['PlayerKillsSmoker']);
        $hPlayerNode->setKillsHunter($_hRow['PlayerKillsHunter']);
        $hPlayerNode->setKillsJockey($_hRow['PlayerKillsJockey']);
        $hPlayerNode->setKillsBoomer($_hRow['PlayerKillsBoomer']);

        // ScoreCalculator will take the $hPlayerNode by reference and automatically calculate the score
        // based on the data passed earlier. ScoreCalculator will automatically also call the
        // $hPlayerNode->setPlayerScore() and update the node's score
        new ScoreCalculator($hPlayerNode);
        return($hPlayerNode);
    }

    private function queuePlayer(PlayerNode &$_hPlayerNode){
        // Insert $hPlayerNode into the PriorityQueue with the calculated score as the Node's priority
        $this->pPlayerQueue->addPlayer($_hPlayerNode, $_hPlayerNode->getPlayerScore());
        return;
    }

    public function getQueue(){
        $hQueueReference = &$this->pPlayerQueue->getQueue();
        return($hQueueReference);
    }
}