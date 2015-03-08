#!/usr/bin/perl -w

use XML::Simple;
use LWP::Simple;
use Data::Dumper;
use DBI;

use utf8;
use Text::Unidecode;

&main();

@aScores = ();

sub main(){
	my $hPlayerList = &getPlayerList();
	my $hDatabase = &connectToDatabase();
	&createTables($hDatabase);

	foreach $_ (keys $hPlayerList->{'playerlist'}->{'player'}){
		my $hPlayerData = &getPlayerData($_, $hPlayerList);
		&pushRow($hPlayerData, $hDatabase);
		#my @aScore = (&getPlayerName($hPlayerData), &generateScore($hPlayerData));
		#push(@aScores, \@aScore);
	}

	&disconnectFromDatabase($hDatabase);
	# my @aSortedScores = sort { $b->[1] <=> $a->[1] } @aScores;

	# my $iListSize = scalar @aSortedScores;
	# for(my $i=0; $i<$iListSize; $i++){
	# 	print $aSortedScores[$i][0].": ".$aSortedScores[$i][1]."\n";
	# }
}

sub pushRow(){
	my($hPlayerData, $hDatabase) = @_;

	my $sPlayerName = &getPlayerName($hPlayerData);
	my $iSpitterKills = &getPlayerSpitterKills($hPlayerData);
	my $iChargerKills = &getPlayerChargerKills($hPlayerData);
	my $iSmokerKills = &getPlayerSmokerKills($hPlayerData);
	my $iHunterKills = &getPlayerHunterKills($hPlayerData);
	my $iJockeyKills = &getPlayerJockeyKills($hPlayerData);
	my $iBoomerKills = &getPlayerBoomerKills($hPlayerData);
	my $iPlayerShots = &getPlayerShots($hPlayerData);
	my $iPlayerHits = &getPlayerHits($hPlayerData);
	my $iPlayerFriendlyFire = &getPlayerAction_FriendlyFire($hPlayerData);
	my $iPlayerProtects = &getPlayerAction_ProtectTeam($hPlayerData);
	my $iPlayerDefibs = &getPlayerAction_Defib($hPlayerData);
	my $iPlayerHeals = &getPlayerAction_Heal($hPlayerData);
	my $iPlayerRevives = &getPlayerAction_Revive($hPlayerData);
	my $iPlayerPlayTime = &getPlayerTime($hPlayerData);
	my $iPlayerHeadshots = &getPlayerHeadshots($hPlayerData);
	my $iPlayerKills = &getPlayerKills($hPlayerData);
	my $iPlayerDeaths = &getPlayerDeaths($hPlayerData);

	$sPlayerName =~ tr/'//d;

	my $hStatement = $hDatabase->prepare(
			"INSERT INTO Players (
				PlayerName,
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
				\'$sPlayerName\', 
				$iPlayerKills,
				$iPlayerDeaths,
				$iPlayerPlayTime,
				$iPlayerShots,
				$iPlayerHits,
				$iPlayerHeadshots,
				$iPlayerFriendlyFire,
				$iPlayerProtects,
				$iPlayerHeals,
				$iPlayerDefibs,
				$iPlayerRevives,
				$iSpitterKills,
				$iChargerKills,
				$iSmokerKills,
				$iHunterKills,
				$iJockeyKills,
				$iBoomerKills)");
		$hStatement->execute();
		return;
}

sub connectToDatabase(){
	unlink("playerranks.db");
	$hDatabase = DBI->connect("dbi:SQLite:dbname=playerranks.db","","",{ RaiseError => 1 },);
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
	my $sData = get "http://evilmania.gameme.com/api/playerlist/l4dii2?limit=100";
	$sData =~ s/([^[:ascii:]]+)/unidecode($1)/ge;

	my $hXML = XML::Simple->new();
	my $hashRefrence = $hXML->XMLin($sData, KeyAttr => {player => 'uniqueid'});

	return($hashRefrence)
}

# Player Data

sub getPlayerData(){
	my ($sPlayerID, $hPlayerList) = @_;
	my $sData = get "http://evilmania.gameme.com/api/playerinfo/l4dii2/".$sPlayerID."/extended";

	$sData =~ s/([^[:ascii:]]+)/unidecode($1)/ge;
	$sData =~ s/\<awards\>.*\<\/awards\>//ig;

	my $hXML = XML::Simple->new();
	my $hashRefrence = $hXML->XMLin($sData, KeyAttr => {action => 'code'});

	#print Dumper($hashRefrence);

	return($hashRefrence)
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

#

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

sub generateScore(){
	my ($hPlayerData) = @_;
	my $iScoreKillsPerMinute = &calcKillsPerMinute($hPlayerData)*33.34;
	my $iScoreKillsToDeath = &calcKilltoDeathRatio($hPlayerData);
	my $iScoreHeadshots = &calcHeadShotPercentage($hPlayerData);
	my $iScoreTeamAssists = &calcTeamAssists($hPlayerData);
	my $iScoreAccuracy = &calcAccuracy($hPlayerData);

	print &getPlayerName($hPlayerData)."\n";
	print "\t KPM Score: ".$iScoreKillsPerMinute."\n";
	print "\t KD Ratio Score: ".500*$iScoreKillsToDeath."\n";
	print "\t Headshots Score: ".500*$iScoreHeadshots."\n";
	print "\t Team Assists Score: ".500*$iScoreTeamAssists."\n";
	print "\t Accuracy Score: ".500*$iScoreAccuracy."\n";
	print "\t SI Kill Score: ".&generateSIKillsScore($hPlayerData)."\n";

	my $iScore = $iScoreKillsPerMinute + ($iScoreKillsToDeath + $iScoreHeadshots + $iScoreTeamAssists + $iScoreAccuracy)*500;
	return($iScore+&generateSIKillsScore($hPlayerData));

}

# Calculate

sub calcTotalSIKills(){
	my ($hPlayerData) = @_;
	my $iSpitterKills = &getPlayerSpitterKills($hPlayerData);
	my $iChargerKills = &getPlayerChargerKills($hPlayerData);
	my $iSmokerKills = &getPlayerSmokerKills($hPlayerData);
	my $iHunterKills = &getPlayerHunterKills($hPlayerData);
	my $iJockeyKills = &getPlayerJockeyKills($hPlayerData);
	my $iBoomerKills = &getPlayerBoomerKills($hPlayerData);

	return($iSpitterKills+$iChargerKills+$iSmokerKills+$iHunterKills+$iJockeyKills+$iBoomerKills);
}

sub calcAccuracy(){
	my ($hPlayerData) = @_;
	my $iPlayerShots = &getPlayerShots($hPlayerData);
	my $iPlayerHits = &getPlayerHits($hPlayerData);
	return($iPlayerHits/$iPlayerShots);
}

sub calcTeamAssists(){
	my ($hPlayerData) = @_;
	my $iPlayerDefibs = &getPlayerAction_Defib($hPlayerData);
	my $iPlayerHeals = &getPlayerAction_Heal($hPlayerData);
	my $iPlayerRevives = &getPlayerAction_Revive($hPlayerData);
	my $iPlayerPlayTime = &secondsToMinutes(&getPlayerTime($hPlayerData));
	return(($iPlayerDefibs+$iPlayerHeals+$iPlayerRevives)/$iPlayerPlayTime);
}

sub calcKillsPerMinute() {
	my ($hPlayerData) = @_;
	my $iPlayerPlayTime = &secondsToMinutes(&getPlayerTime($hPlayerData));
	my $iPlayerKills = &getPlayerKills($hPlayerData);

	return($iPlayerKills/$iPlayerPlayTime);
}

sub calcHeadShotPercentage(){
	my ($hPlayerData) = @_;
	my $iPlayerHeadshots = &getPlayerHeadshots($hPlayerData);
	my $iPlayerKills = &getPlayerKills($hPlayerData);

	return($iPlayerHeadshots/$iPlayerKills);
}

sub calcKilltoDeathRatio(){
	my ($hPlayerData) = @_;
	my $iPlayerKills = &getPlayerKills($hPlayerData);
	my $iPlayerDeaths = &getPlayerDeaths($hPlayerData);

	return(($iPlayerKills/$iPlayerDeaths)/100);
}

# Other

sub secondsToMinutes(){
	my ($iSeconds) = @_;
	return($iSeconds/60);
}