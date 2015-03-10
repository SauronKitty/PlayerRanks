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

main($iTimeStart);

function main($_iTimeStart){
    printPlayerRanks();
    printExecTime($_iTimeStart);
}

function printPlayerRanks(){
    $hPlayerManager = new PlayerManager();
    $hPlayerQueue = $hPlayerManager->getQueue();

    $iCounter = 1;
    header('Content-Type: text/html; charset=utf-8');
    print("<html><head><title>Ranks (Alpha)</title></head><body><table>");
    print("<thead><tr><th>Position</th><th>Name</th><th>Score</th></tr></thead><tbody>");
    while ($hPlayerQueue->valid()) {
        $sPlayerName = $hPlayerQueue->current()->getName();
        $sProfileLink = getGameMeLink($hPlayerQueue->current()->getGameMeId());
        $iPlayerScore = $hPlayerQueue->current()->getPlayerScore();

        print("<tr>");
        print("<td>$iCounter</td>");
        print("<td><a href=\"$sProfileLink\">$sPlayerName</a></td>");
        print("<td>$iPlayerScore</td>");
        print("</tr>");
        $hPlayerQueue->next();
        $iCounter++;
    }
    print("</tbody></table></body></html>");
}

function getGameMeLink($_iPlayerGameMeId){
    return("http://evilmania.gameme.com/playerinfo/".$_iPlayerGameMeId);
}

function printExecTime($_iTimeStart){
    $iTimeEnd = microtime(true);
    $iTimeExec = ($iTimeEnd - $_iTimeStart);
    print "<hr><center>$iTimeExec</center>\n";
}