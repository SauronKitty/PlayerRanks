<?php

class SettingsManager {
    private $aSettings;

    public function __construct(){
        $this->aSettings['dir_raw_database']        = "./Raw/playerranks.db";
        $this->aSettings['dir_database_database']   = "./Database/Database.php";
        $this->aSettings['dir_managers_player']     = "./Managers/PlayerManager.php";
        $this->aSettings['dir_managers_settings']   = "./Managers/SettingsManager.php";
        $this->aSettings['dir_playerdata_list']     = "./PlayerData/PlayerQueue.php";
        $this->aSettings['dir_playerdata_node']     = "./PlayerData/PlayerNode.php";
        $this->aSettings['dir_scoring_manager']     = "./Scoring/ScoreCalculator.php";
    }

    public function getConfig($_sSetting){
        return($this->aSettings[$_sSetting]);
    }

    public function setConfig($_sSetting, $_mNewValue){
        $this->aSettings[$_sSetting] = $_mNewValue;
    }
}