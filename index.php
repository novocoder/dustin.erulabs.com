<?PHP

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<b>
<br>
<font size=9><center>Find Summoner Stuff Hurr</center></font>
<script src="script.js"></script>
<br><br>
<form action="index.php" method="post">

	Search A Summoner:

	<br>
		<input type="text" name="name">
	
		<input type="submit" value="submit">


</form>



<hr>
Hello,
<?php

	if (!isset($_POST["name"])){
		echo "Summoner";
	} else {
		echo $_POST["name"];
}         


require 'championlist.php';
#print_r($champions);

require 'vendor/autoload.php';
use LeagueWrap\Api;

$api = new Api('9249495a-ec4c-4026-bb9c-a7648103bd41');

$summonerAPI = $api->summoner();
$gameAPI = $api->game();
$statsAPI = $api->stats();
$staticDataApi = $api->staticdata();

$name = $_POST['name'];

if($name == "") {
  exit("Enter Summoner Name");
}


$summoner = $summonerAPI->info($name);

$recentGames = $gameAPI->recent($summoner->id);
echo " - Level: ";
echo $summoner->summonerLevel;

echo "<br>Summoner stats: <pre>";
// Get the stats summary by summoner ID
$myStats = $statsAPI->summary($summoner->id);

$gameTypes = $myStats->playerStatSummaries;

// Debug mode: print out the stats array
//print_r($gameTypes);

foreach($gameTypes as $gameType) {
  if ($gameType->playerStatSummaryType == 'Unranked' or
  $gameType->playerStatSummaryType == 'RankedSolo5x5') {
    echo "Total ".$gameType->playerStatSummaryType." kills: ";
    echo $gameType->aggregatedStats->totalChampionKills . "<br>";
  }
}

echo "</pre>";

echo "<hr>";
echo "<br>";
echo "<br>";

/*Places a "0" in return if there is no value */


function fixlolnum($lolnumber) {
	if ($lolnumber == ''){
	  echo "0";
	} else {
	  echo $lolnumber;
	}
}



/*Fixes Character names with spaces, periods, and other special characters */

function fixlolname($lolname) {
	$lolname = str_replace(" ", "", $lolname);
	$lolname = str_replace("'", "", $lolname);
	$lolname = str_replace(".", "", $lolname);
	return $lolname;
}


// 	Get details on LAST game
//
$games = $recentGames->games;
$game=array_shift($games);
$championId = $game->championId;
$championName = $champions[$championId];
	
echo "<!---#$championId--->";
echo "<img src='/images/" . fixlolname($championName) . "Square.png'>   ";	
echo $championName;
echo " - ";

fixlolnum($game->stats->championsKilled);
echo "/";
fixlolnum($game->stats->numDeaths);
echo "/";
fixlolnum($game->stats->assists);
	
echo " - ";
$won = $game->stats->win;

if ($won == 1){
  echo "<font color='green'>Victory</font>";
}
else {
  echo "<font color='red'>Defeat</font>";
}

#print_r($summoner);
echo "<br><br>\n\n";

#print_r($recentGames->games[0]->stats);
?>
<br>
<?PHP

//
// Get details on the next 9 previous games
foreach ($games as $gameNum => $game) {

	$championId = $game->championId;
	
	$championName = $champions[$championId];
	
	echo "<!---#$championId--->";

	echo "<img src='/images/" . fixlolname($championName) . "Square.png' > "  ;	

	echo $championName;

	echo " - ";

	fixlolnum($game->stats->championsKilled);
	echo "/";
	fixlolnum($game->stats->numDeaths);
	echo "/";
	fixlolnum($game->stats->assists);
	
	
	echo " - ";

	$won = $game->stats->win;

	if ($won == 1){
	  echo "<font color='green'>Victory</font>";
	}
	else {
	  echo "<font color='red'>Losed</font>";

	}
	echo "<br><br>\n\n";
}
	

#print_r($recentGames->games[0]->stats);

#foreach ($champions as $championId => $championName) {
#	echo "<img src='/images/" . fixlolname($championName) . "Square.png'>";	
#}

echo '<pre>';
//print_r($staticDataApi->getItems());
echo '</pre>';


?>
</body>
</html>
