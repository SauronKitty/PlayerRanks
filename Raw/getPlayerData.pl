#!/usr/bin/perl -w

use XML::Simple;
use LWP::Simple;

use DBI;

use utf8;
#use Text::Unidecode;

&main();

sub main(){
	my $hPlayerList = &getPlayerList();
	my $hDatabase = &connectToDatabase();
	&createTables($hDatabase);

	foreach $_ (keys $hPlayerList->{'playerlist'}->{'player'}){
		my $hPlayerData = &getPlayerData($_, $hPlayerList);
		&pushRow($hPlayerData, $hDatabase);
	}

	&disconnectFromDatabase($hDatabase);
}

sub pushRow(){
	my($hPlayerData, $hDatabase) = @_;

	my $sPlayerName         = &getPlayerName($hPlayerData);
	my $sPlayerSteamId      = &getPlayerSteamId($hPlayerData);
	my $iPlayerId           = &getPlayerId($hPlayerData);
	my $iSpitterKills       = &getPlayerSpitterKills($hPlayerData);
	my $iChargerKills       = &getPlayerChargerKills($hPlayerData);
	my $iSmokerKills        = &getPlayerSmokerKills($hPlayerData);
	my $iHunterKills        = &getPlayerHunterKills($hPlayerData);
	my $iJockeyKills        = &getPlayerJockeyKills($hPlayerData);
	my $iBoomerKills        = &getPlayerBoomerKills($hPlayerData);
	my $iPlayerShots        = &getPlayerShots($hPlayerData);
	my $iPlayerHits         = &getPlayerHits($hPlayerData);
	my $iPlayerFriendlyFire = &getPlayerAction_FriendlyFire($hPlayerData);
	my $iPlayerProtects     = &getPlayerAction_ProtectTeam($hPlayerData);
	my $iPlayerDefibs       = &getPlayerAction_Defib($hPlayerData);
	my $iPlayerHeals        = &getPlayerAction_Heal($hPlayerData);
	my $iPlayerRevives      = &getPlayerAction_Revive($hPlayerData);
	my $iPlayerPlayTime     = &getPlayerTime($hPlayerData);
	my $iPlayerHeadshots    = &getPlayerHeadshots($hPlayerData);
	my $iPlayerKills        = &getPlayerKills($hPlayerData);
	my $iPlayerDeaths       = &getPlayerDeaths($hPlayerData);

	my $hStatement = $hDatabase->prepare(
			qq(INSERT INTO Players (
				PlayerName,
				PlayerSteam,
				PlayerId,
				PlayerKills,
				PlayerDeaths,
				PlayerTime,
				PlayerShots,
				PlayerHits,
				PlayerHeadshots,
				PlayerFriendlyFire,
				PlayerTeamProtects,
				PlayerTeamHeals,
				PlayerTeamDefibs,
				PlayerTeamRevives,
				PlayerKillsSpitter,
				PlayerKillsCharger,
				PlayerKillsSmoker,
				PlayerKillsHunter,
				PlayerKillsJockey,
				PlayerKillsBoomer 
			) VALUES (
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?)));
		$hStatement->execute($sPlayerName, $sPlayerSteamId, $iPlayerId, $iPlayerKills, $iPlayerDeaths, $iPlayerPlayTime,
		$iPlayerShots, $iPlayerHits, $iPlayerHeadshots, $iPlayerFriendlyFire, $iPlayerProtects, $iPlayerHeals, $iPlayerDefibs,
		$iPlayerRevives, $iSpitterKills, $iChargerKills, $iSmokerKills, $iHunterKills, $iJockeyKills, $iBoomerKills);
		return;
}

sub connectToDatabase(){
	unlink("playerranks.db");
	$hDatabase = DBI->connect("dbi:SQLite:dbname=playerranks.db",qq(),qq(),{ RaiseError => 1 },);
	return $hDatabase;
}

sub disconnectFromDatabase(){
	my ($hDatbase) = @_;
	$hDatabase->disconnect();
}

sub createTables(){
	my ($hDatbase) = @_;
	my $hStatement = $hDatbase->prepare("CREATE TABLE Players
	(
		PlayerName varchar(250),
		PlayerSteam varchar(250),
		PlayerId int,
		PlayerKills int,
		PlayerDeaths int,
		PlayerTime int,
		PlayerShots int,
		PlayerHits int,
		PlayerHeadshots int,
		PlayerFriendlyFire int,
		PlayerTeamProtects int,
		PlayerTeamHeals int,
		PlayerTeamDefibs int,
		PlayerTeamRevives int,
		PlayerKillsSpitter int,
		PlayerKillsCharger int,
		PlayerKillsSmoker int,
		PlayerKillsHunter int,
		PlayerKillsJockey int,
		PlayerKillsBoomer int 
		);");
	$hStatement->execute();
}

# Player List

sub getPlayerList(){
	my $sData = get "http://evilmania.gameme.com/api/playerlist/l4dii2?limit=150";

	my $hXML = XML::Simple->new();
	my $hashRefrence = $hXML->XMLin($sData, KeyAttr => {player => 'uniqueid'});

	return($hashRefrence)
}

# Player Data

sub getPlayerData(){
	my ($sPlayerID, $hPlayerList) = @_;
	my $sData = get "http://evilmania.gameme.com/api/playerinfo/l4dii2/".$sPlayerID."/extended";

	$sData =~ s/\<awards\>.*\<\/awards\>//ig;

	my $hXML = XML::Simple->new();
	my $hashRefrence = $hXML->XMLin($sData, KeyAttr => {action => 'code'});

	return($hashRefrence)
}

sub getPlayerId(){
    my ($hPlayerData) = @_;
    return($hPlayerData->{'playerinfo'}->{'player'}->{'id'});
}

sub getPlayerSteamId(){
    my ($hPlayerData) = @_;
    return($hPlayerData->{'playerinfo'}->{'player'}->{'uniqueid'});
}

sub getPlayerName(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'name'});

}

sub getPlayerKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'kills'});
}

sub getPlayerDeaths(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'deaths'});
}

sub getPlayerTime(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'time'});
}

sub getPlayerShots(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'shots'});
}

sub getPlayerHits(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'hits'});	
}

sub getPlayerHeadshots(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'hs'});
}

sub getPlayerAction_FriendlyFire(){
 	my ($hPlayerData) = @_;
 	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'friendly_fire'}->{'achieved'});
}

sub getPlayerSpitterKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_spitter'}->{'achieved'});
}

sub getPlayerChargerKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_charger'}->{'achieved'});
}

sub getPlayerSmokerKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_gas'}->{'achieved'});
}

sub getPlayerHunterKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_hunter'}->{'achieved'});
}

sub getPlayerJockeyKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_jockey'}->{'achieved'});
}

sub getPlayerBoomerKills(){
	my ($hPlayerData) = @_;
	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'killed_exploding'}->{'achieved'});
}

sub getPlayerAction_ProtectTeam(){
 	my ($hPlayerData) = @_;
 	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'protect_teammate'}->{'achieved'});
}

sub getPlayerAction_Defib(){
	 my ($hPlayerData) = @_;
 	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'defibrillated_teammate'}->{'achieved'});
}

sub getPlayerAction_Heal(){
 	my ($hPlayerData) = @_;
 	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'healed_teammate'}->{'achieved'});
}

sub getPlayerAction_Revive(){
 	my ($hPlayerData) = @_;
 	return($hPlayerData->{'playerinfo'}->{'player'}->{'actions'}->{'action'}->{'revived_teammate'}->{'achieved'});
}

# Generate Scores

sub generateSIKillsScore(){
	my ($hPlayerData) = @_;
	return((&calcTotalSIKills($hPlayerData)/&secondsToMinutes(&getPlayerTime($hPlayerData)))*500);
}

# Other

sub secondsToMinutes(){
	my ($iSeconds) = @_;
	return($iSeconds/60);
}