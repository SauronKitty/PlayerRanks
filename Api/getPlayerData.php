<?php
require("../Managers/SettingsManager.php");
$hSettingsManager = new SettingsManager();

require($hSettingsManager->getConfig('dir_playerdata_node'));
require($hSettingsManager->getConfig('dir_database_database'));
require($hSettingsManager->getConfig('dir_scoring_manager'));
require($hSettingsManager->getConfig('dir_managers_player'));

// Begin

main();

function main(){
    printPlayerData();
}

function printPlayerData(){
    $hPlayerManager = new PlayerManager();

    $aPlayerData = parseData(0, $hPlayerManager->getPlayerByName("JC57"));
    echo json_encode($aPlayerData);
    return;
}

function &parseData($_iPlayerRank, PlayerNode &$_pPlayerNode){
    $aPlayerData = array(
        'PlayerRank'    => $_iPlayerRank,
        'PlayerName'    => $_pPlayerNode->getName(),
        'SteamId'       => $_pPlayerNode->getSteamId(),
        'Profile'       => "<a href=\"".getGameMeLink($_pPlayerNode->getGameMeId())."\">Stats</a>",
        'Score'         => $_pPlayerNode->getPlayerScore()
    );
    return($aPlayerData);
}

function getGameMeLink($_iPlayerGameMeId){
    return("http://evilmania.gameme.com/playerinfo/".$_iPlayerGameMeId);
}