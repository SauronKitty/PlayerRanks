<?php
require("./Managers/SettingsManager.php");

$hSettingsManager = new SettingsManager();
require($hSettingsManager->getConfig('dir_database_database'));
require($hSettingsManager->getConfig('dir_managers_player'));
require($hSettingsManager->getConfig('dir_playerdata_list'));

// Begin

$hPlayerManager = new PlayerManager();

echo $hPlayerManager->getList()->pop()->getKills();
echo $hPlayerManager->getList()->pop()->getName();