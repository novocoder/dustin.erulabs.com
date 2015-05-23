<html>
<head>

</head>

<body>
	


<?PHP
require 'championlist.php';
#print_r($champions);
require 'vendor/autoload.php';
use LeagueWrap\Api;
require '../secretFile.php';
$api = new Api($LEAGUE_APIKEY);
$summonerAPI = $api->summoner();
$gameAPI = $api->game();
$statsAPI = $api->stats();
$staticDataApi = $api->staticdata();
$name = $_POST['name'];
$summoner = $summonerAPI->info($name);
$recentGames = $gameAPI->recent($summoner->id);
echo " - Level: " . $summoner->summonerLevel;
 
?>

<br><br>

<div id="summstats" >
<?php
$insert = mysqli_query($connection, "INSERT INTO `recentSearches` (`name`) VALUES ('".$name."')");
$summoner = $summonerAPI->info($name);
$recentGames = $gameAPI->recent($summoner->id);
echo "<img src='http://avatar.leagueoflegends.com/na/". ($name) . ".png' >" .  	
	  "<br><br><h2> Summoner stats:</h2><br>";
//
// Get the stats summary by summoner ID
$myStats = $statsAPI->summary($summoner->id);
$gameTypes = $myStats->playerStatSummaries;
// Debug mode: print out the stats array
#print_r($gameTypes);
foreach($gameTypes as $gameType) {
	   if ($gameType->playerStatSummaryType == 'Unranked' or
	   $gameType->playerStatSummaryType == 'RankedSolo5x5' or
	   $gameType->playerStatSummaryType == 'RankedTeam3x3' or
	   $gameType->playerStatSummaryType == 'unranked3x3' or
	   $gameType->playerStatSummaryType == 'RankedTeam5x5') {
  	   echo "Total ".$gameType->playerStatSummaryType."
 	   <font color=red><right>Kills</font></right>: ";
 	   echo $gameType->aggregatedStats->totalChampionKills . "<br>";
       echo "Wins: ". $gameType->wins . "     Losses: " . $gameType->losses."<br>";
  }
}
/*Places a "0" in return
if there is no value */
function fixlolnum($lolnumber) {
	if ($lolnumber == ''){
	  return "0";
	} else {
	  return $lolnumber;
	}
}
/*Fixes Character names with spaces,
periods, and other special characters */
function fixlolname($lolname) {
	$lolname = str_replace(" ", "", $lolname);
	$lolname = str_replace("'", "", $lolname);
	$lolname = str_replace(".", "", $lolname);
	return $lolname;
}
?>
</div>
<br><br>
<?php
$games = $recentGames->games;
$championId = $game->championId;
$championName = $champions[$championId];
$championDeaths = $game->stats->numDeaths;
$championKills = $game->stats->championsKilled;
$gameDate = $game->createDate;
//Date of Game Played//
//$epoch = $gameDate
//$dt = new DateTime("@$epoch");
//echo $dt->format('y-m-d H:i:s');
//$epoch = $gameDate;
//$dt = new DateTime("@$epoch");
//echo $dt->format('M/d/Y');
//\\\\\\\\\\\\\\\\\\\\\\//
$won = $game->stats->win;
$cs = fixlolnum($game->stats->minionsKilled) + fixlolnum($game->stats->neutralMinionsKilled);
#print_r($summoner);
echo "\n\n";
#print_r($recentGames->games[0]->stats);
?>
</div>
<hr>
Recent Games:
<br><br>
<div class="gamecard">;
<table>

<?PHP

foreach ($games as $gameNum => $game) {

	$championId = $game->championId;
	$championDeaths = $game->stats->numDeaths;
	$championKills = $game->stats->championsKilled;
	$championName = $champions[$championId];



	// echo "<!---#$championId--->";
	$thumb = "<tr><img src='images/" . fixlolname($championName[0]) . "Square.png' ><tr> "  ;	

echo $thumb;	
	
	
	echo $championName[0];
	
	echo " - ";
	$kda = fixlolnum($game->stats->championsKilled) . "/" . fixlolnum($game->stats->numDeaths) . "/" . fixlolnum($game->stats->assists);

echo $kda;	
	
	echo " - ";
	
	
	$won = $game->stats->win;
	if ($won == 1){
	  echo "<font color='green'>Victory</font>";
	}
	else {
	  echo "<font color='red'>Defeat</font>";
	}
	
	
// Extended Stats & Game "comment"//
	if ($championDeaths > $championKills) {
	echo " ...Goddamn feeder";
	}
	if ($championKills > $championDeaths +4 && $won == 1 ) {
	echo " ...Good job";
	} 
	if ($championKills > $championDeaths +8 && $won == 1 ) {
	echo "<font color='yellow'> - NICE! -</font>";
	}
	
	

	echo "Total Damage: " . fixlolnum($game->stats->totalDamageDealt);

	echo "	Damage to Champions: " . fixlolnum($game->stats->totalDamageDealtToChampions);

	echo "	Gold:	" . fixlolnum($game->stats->goldEarned);


	$cs = "	Minions Killed:	" . fixlolnum($game->stats->minionsKilled) + fixlolnum($game->stats->neutralMinionsKilled);
	echo "$cs";
	echo "	Wards Placed:	" . fixlolnum($game->stats->wardPlaced);


	


}
echo "</table>";	
echo "</div>";

#print_r($recentGames->games[0]->stats);
#
#foreach ($champions as $championId => $championName) {
#	echo "<img src='/images/" . fixlolname($championName) . "Square.png'>";	
#}
#echo '<pre>';
#print_r($staticDataApi->getItems());
#echo '</pre>';
?>
</body>
</html>
