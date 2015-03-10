<?php
require("./Managers/SettingsManager.php");

$hSettingsManager = new SettingsManager();
require($hSettingsManager->getConfig('dir_database_database'));
require($hSettingsManager->getConfig('dir_managers_player'));
require($hSettingsManager->getConfig('dir_playerdata_list'));
require($hSettingsManager->getConfig('dir_scoring_manager'));

// Begin

$hPlayerManager = new PlayerManager();
$hPlayerList = $hPlayerManager->getList();

$hPlayerList->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);


$hPlayerQueue = new SplPriorityQueue();
for($hPlayerList->rewind(); $hPlayerList->valid(); $hPlayerList->next()){
    $hScoreManager = new ScoreManager($hPlayerList->current());
    $hPlayerList->current()->setPlayerScore($hScoreManager->getScore());
    $hPlayerQueue->insert($hPlayerList->current(), $hScoreManager->getScore());
}

$hPlayerQueue->top();
$iCounter = 1;
while($hPlayerQueue->valid()){
    print"$iCounter - Name: ".$hPlayerQueue->current()->getName()." | Score: ".$hPlayerQueue->current()->getPlayerScore()."<br>\n";
    $hPlayerQueue->next();
    $iCounter++;
}