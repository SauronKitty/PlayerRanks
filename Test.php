<?php
require("PlayerData/PlayerList.php");

$pObject = new PlayerList();
$pObject->addPlayer("Meow");
echo $pObject->getList()->pop()->getName();