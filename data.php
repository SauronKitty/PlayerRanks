<?php
$iTimeStart = microtime(true);

require("./Managers/SettingsManager.php");
$hSettingsManager = new SettingsManager();

require($hSettingsManager->getConfig('dir_playerdata_node'));
require($hSettingsManager->getConfig('dir_playerdata_list'));
require($hSettingsManager->getConfig('dir_database_database'));
require($hSettingsManager->getConfig('dir_scoring_manager'));
require($hSettingsManager->getConfig('dir_managers_player'));

// Begin

main();

function main(){
    printPlayerRanks();
    //printExecTime($_iTimeStart);
}

function printPlayerRanks(){
    $hPlayerManager = new PlayerManager();
    $hPlayerQueue = $hPlayerManager->getQueue();

    $iCounter = 1;
    header('Content-Type: application/json');

    $aDataArray = array();
    while ($hPlayerQueue->valid()) {
        $aPlayerData = array(
            'PlayerName'    => $hPlayerQueue->current()->getName(),
            'Profile'       => getGameMeLink($hPlayerQueue->current()->getGameMeId()),
            'Score'         => $hPlayerQueue->current()->getPlayerScore(),
        );

        array_push($aDataArray, $aPlayerData);
        $hPlayerQueue->next();
        $iCounter++;
    }
     echo json_encode($aDataArray);
}

function getGameMeLink($_iPlayerGameMeId){
    return("http://evilmania.gameme.com/playerinfo/".$_iPlayerGameMeId);
}