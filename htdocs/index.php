<?PHP
$connection = mysqli_connect('localhost','dustinsite','qweasd','dustindb');
if($connection == false) {
	echo mysqli_connect_error();
}
function db_select($query) {
        global $connection;
	$rows = array();
        $result = mysqli_query($connection,$query);

        // If query failed, return `false`
        if($result === false) {
            return false;
        }

        // If query was successful, retrieve all the rows into an array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<b>
<br>

<div style="text-align:right;">
<?php
$results = db_select("SELECT * FROM visitDATA");
#print_r($results);


//Have you visited before?
$found = false;
$totalvisits = 1;
foreach ($results as $visitorDATA){
	$totalvisits = $totalvisits + $visitorDATA["visits"];

//print_r ($visitorDATA);
//	echo $visitorDATA["ip"];
//	echo "<br>";
//if this record is for your address 
	if ($visitorDATA["ip"] == $_SERVER['REMOTE_ADDR']){
		$found = true;
		$visits = $visitorDATA["visits"];
	}
}

if ($found){
	$visits = $visits+1;
	//update
	$update = mysqli_query($connection, "UPDATE `visitDATA` SET `visits`=".$visits." WHERE `ip`='".$_SERVER['REMOTE_ADDR']."'");
} else {
	//insert
	$visits = 1;
	$insert = mysqli_query($connection, "INSERT INTO `visitDATA` (`ip`,`visits`) VALUES ('". $_SERVER['REMOTE_ADDR'] ."',1)");
}



//echo $_SERVER['REMOTE_ADDR'];
echo "Your visits: ".$visits;
echo "<br>";
echo "Unique visits: " . count($results);
echo "<br>";
echo "Total: ".$totalvisits;
?>

</div>


<h1>

<font size=9><center>What Do You Seek, Summoner?</center></font>

</h1>

<script src="script.js"></script>
<br><br>



<form action="index.php" method="post">

	Search A Summoner:

	<br>
		<input type="text" name="name">
	
		<input type="submit" value="submit">
		


</form>
<hr>
Boobie sir,
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



$summoner = $summonerAPI->info($name);

$recentGames = $gameAPI->recent($summoner->id);
echo " - Level: ";
echo $summoner->summonerLevel;
?>
<br><br>

</div>

<?php

echo "<img src='http://avatar.leagueoflegends.com/na/". ($name) . ".png' >"  ;	

echo "<br><br>Summoner stats: <pre>";
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
    echo "w/l: ". $gameType->wins . "/" . $gameType->losses."<br>";
  }
}

echo "</pre>";

echo "<hr>";
echo "<br>";
echo "<br>";

/*Places a "0" in return
if there is no value */


function fixlolnum($lolnumber) {
	if ($lolnumber == ''){
	  echo "0";
	} else {
	  echo $lolnumber;
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
<?php


// 	Get details on LASTEST game
//
$games = $recentGames->games;
$game=array_shift($games);
$championId = $game->championId;
$championName = $champions[$championId];
	$championDeaths = $game->stats->numDeaths;
	$championKills = $game->stats->championsKilled;
	
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

#print_r($summoner);
echo "<br><br>\n\n";

#print_r($recentGames->games[0]->stats);
?>
<br>

<hr>
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

#$test = 19;
#if ($test == 19) {	
	
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
</body>
</html>
