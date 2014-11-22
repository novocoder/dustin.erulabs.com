<?PHP


?>
<html>

<head>


<link rel="stylesheet" type="text/css" href="styles.css">

</head>





<body>

<b>

<font size=9><center>Find Summoner Stuff Hurr</center></font>
<script src="script.js"></script>


<form action="index.php" method="post">
	Name:
	<br>
	<input type="text" name="name">
	<br>
	<input type="submit" value="submit">
</form>

Hello
<?php
if ($_POST["name"] ==''){
	echo "Summoner";
} else {
	echo $_POST["name"];
}

?>
<br><Br><br>
<pre>
<?PHP


require 'championlist.php';

#print_r($champions);
	

require 'vendor/autoload.php';
use LeagueWrap\Api;

$api = new Api('9249495a-ec4c-4026-bb9c-a7648103bd41');

$summonerAPI = $api->summoner();
$gameAPI = $api->game();

$name = $_POST['name'];

$summoner = $summonerAPI->info($name);

$recentGames = $gameAPI->recent($summoner->id);







function fixlolnum($lolnumber) {
	if ($lolnumber == ''){
	  echo "0";
	} else {
	  echo $lolnumber;
	}
}


function fixlolname($lolname) {
	$lolname = str_replace(" ", "", $lolname);
	$lolname = str_replace("'", "", $lolname);
	return $lolname;
}


foreach ($recentGames->games as $gameNum => $game) {

	$championId = $game->championId;
	
	$championName = $champions[$championId];
	
	echo "<!---#$championId--->";

	echo "<img src='/images/" . fixlolname($championName) . "Square.png'>";	

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
	  echo "Victory";
	}
	else {
	  echo "Defeat";

	}
	echo "<br><br>\n\n";
}


#print_r($recentGames->games[0]->stats);
?>
</pre>
</body>
</html>
