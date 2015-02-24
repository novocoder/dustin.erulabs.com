
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
echo " - Level: ";
echo $summoner->summonerLevel;
?>
<br><br>


<div id="summstats" >
<?php

$insert = mysqli_query($connection, "INSERT INTO `recentSearches` (`name`) VALUES ('".$name."')");

$summoner = $summonerAPI->info($name);
$recentGames = $gameAPI->recent($summoner->id);

echo "<img src='http://avatar.leagueoflegends.com/na/". ($name) . ".png' >"  ;	

echo "<br><br><h2> Summoner stats:</h2><br>";

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
<?php

echo "<hr>";
echo "<pre>";
echo "Latest Game: ";
echo "<br><br>";

// 	Get details on LASTEST game
//
$games = $recentGames->games;
$game=array_shift($games);
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

echo "<br>";
echo "<!---#$championId--->";
echo "<img src='/images/" . fixlolname($championName) . "Square.png'>   ";	
echo $championName;
echo " - ";

echo fixlolnum($game->stats->championsKilled);
echo "/";
echo fixlolnum($game->stats->numDeaths);
echo "/";
echo fixlolnum($game->stats->assists);

echo " - ";

$won = $game->stats->win;

if ($won == 1){
  echo "<font color='green'>Victory</font>";
}
else {
  echo "<font color='red'>Defeat</font>";
}
	if ($championDeaths > $championKills) {
	echo " ...Goddamn feeder";
	}
	if ($championKills > $championDeaths +4 && $won == 1 ) {
	echo " ...Good job";
	} 
	if ($championKills > $championDeaths +8 && $won == 1 ) {
	echo "<font color='yellow'> - NICE! -</font>";
	}
echo "<br><br><br>";
echo "                        Stats:";

echo "<br><br><br>";


// Expanded Stats




echo "                               	     Total Damage:  ";
echo fixlolnum($game->stats->totalDamageDealt);
echo "     Damage to Champions:  ";
echo fixlolnum($game->stats->totalDamageDealtToChampions);
echo "     Gold:  ";
echo fixlolnum($game->stats->goldEarned);
echo"      Minions Killed:  ";
$cs = fixlolnum($game->stats->minionsKilled) + fixlolnum($game->stats->neutralMinionsKilled);
echo "     Wards Placed:  ";
echo fixlolnum($game->stats->wardPlaced);



echo $cs;

#print_r($summoner);
echo "\n\n";

#print_r($recentGames->games[0]->stats);
?>
<hr>

Recent Games:
</pre>
<?PHP

//
// Get details on the next9 previous games
foreach ($games as $gameNum => $game) {

	$championId = $game->championId;
	
	$championDeaths = $game->stats->numDeaths;
	$championKills = $game->stats->championsKilled;

	$championName = $champions[$championId];
	echo "<!---#$championId--->";

	echo "<img src='images/" . fixlolname($championName) . "Square.png' > "  ;	

	echo $championName;

	echo " - ";

	echo fixlolnum($game->stats->championsKilled);
		echo "/";
	echo fixlolnum($game->stats->numDeaths);
		echo "/";
	echo fixlolnum($game->stats->assists);
	
	
	echo " - ";

	$won = $game->stats->win;

	if ($won == 1){
	  echo "<font color='green'>Victory</font>";
	}
	else {
	  echo "<font color='red'>Defeat</font>";

	}


// Game Result Comments//

	if ($championDeaths > $championKills) {
	echo " ...Goddamn feeder";
	}
	if ($championKills > $championDeaths +4 && $won == 1 ) {
	echo " ...Good job";
	} 
	if ($championKills > $championDeaths +8 && $won == 1 ) {
	echo "<font color='yellow'> - NICE! -</font>";
	}
	echo "<br><br>\n\n\n";

}
#print_r($recentGames->games[0]->stats);
#
#foreach ($champions as $championId => $championName) {
#	echo "<img src='/images/" . fixlolname($championName) . "Square.png'>";	
#}

echo '<pre>';
//print_r($staticDataApi->getItems());
echo '</pre>';

?>

