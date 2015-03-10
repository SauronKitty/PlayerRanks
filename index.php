<?php
$iTimeStart = microtime(true);

require("./Managers/SettingsManager.php");

$hSettingsManager = new SettingsManager();
require($hSettingsManager->getConfig('dir_database_database'));
require($hSettingsManager->getConfig('dir_managers_player'));
require($hSettingsManager->getConfig('dir_playerdata_list'));
require($hSettingsManager->getConfig('dir_scoring_manager'));

// Begin

$hPlayerManager = new PlayerManager();
$hPlayerQueue = $hPlayerManager->getQueue();

$iCounter = 1;
header('Content-Type: text/html; charset=utf-8');
while($hPlayerQueue->valid()){
    print"$iCounter - Name: ".$hPlayerQueue->current()->getName()." | Score: ".$hPlayerQueue->current()->getPlayerScore()."<br>\n";
    $hPlayerQueue->next();
    $iCounter++;
}

$iTimeEnd = microtime(true);

$iTimeExec = ($iTimeEnd - $iTimeStart);
echo "$iTimeExec\n";