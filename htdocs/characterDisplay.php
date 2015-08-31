<html>
<head>

</head>

<body>
	


<?PHP
require 'championlist.php';
require 'sumitems.php';
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
echo " - Level  " . $summoner->summonerLevel . "<br>";
 
?>

<br><b>

<div id="summstats" >
	
<?php

$insert = mysqli_query($connection, "INSERT INTO `recentSearches` (`name`) VALUES ('".$name."')");
$summoner = $summonerAPI->info($name);
$recentGames = $gameAPI->recent($summoner->id);
echo "<img src='http://avatar.leagueoflegends.com/na/". ($name) 
. ".png' >" .  	
	  "<br><br><h2> Summoner Stats</h2><br>";
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

// print_r($recentGames->games[0]->stats);
?>


<h2>Recent Games</h2>
<br><br>
	
<div class="gamearea">
		

<?PHP
		
foreach ($games as $gameNum => $game) {
	
	
		
$championId = $game->championId;
$championDeaths = $game->stats->numDeaths;
$championKills = $game->stats->championsKilled;
$championName = $champions[$championId];

// $i = 0
// while $i lt 6
// do 
// $item_num = [.$game->stats->item$i]
// if $game->stats->item$i = $null
// {echo image/lame.png}
// $i++

$item_nums = [$game->stats->item0,$game->stats->item1,$game->stats->item2,$game->stats->item3,$game->stats->item4,$game->stats->item5];
// . $game->stats->item1 . $game->stats->item2 . $game->stats->item3 . $game->stats->item4 . $game->stats->item5;
$kda = fixlolnum($game->stats->championsKilled) . "/" . fixlolnum($game->stats->numDeaths) . "/" . fixlolnum($game->stats->assists);
$cs = fixlolnum($game->stats->minionsKilled) + fixlolnum($game->stats->neutralMinionsKilled);
$thumb = "<tr><img src='images/" . fixlolname($championName[0]) . "Square.png' ><tr> "  ;		 

// echo "<!---#$championId--->";

$won = $game->stats->win;


echo "<div class='cardstats'>";	
	
		echo "<div class='kda'>" . $kda . "</div>";
	
		if ($won == 1){
		  echo "<div class='victory'>" . " Victory" . "</div>";
		} else {
		  echo "<div class='defeat'>" . " Defeat" . "</div>";
		};
		
			echo "<div class='name'>" . $championName[0] . "</div>";
			
			if ($championDeaths > $championKills) {
			echo " ...Goddamn feeder";
			}
			if ($championKills > $championDeaths +4 && $won == 1 ) {
			echo " ...Good job";
			} 
			if ($championKills > $championDeaths +8 && $won == 1 ) {
			echo "<font color='yellow'> - NICE! -</font>";
			};
		
		
echo " <br>";
	
echo "<div class='thumbnail'>" . $thumb . "<br></div>";	
	
		
echo "<div class='items'>"; 	
$blanks = [];
foreach ($item_nums as $item) {
		$item_list = $sumitems[$item];
		
		$icons = [];
		if (!array_key_exists($item,$sumitems) || $item == null) {
			
			array_push($blanks,$item);
		
		}else{
			
			echo "<img src='images/" . $item_list[0] . "Square.gif' >";
};


};

foreach($blanks as $blank) {
	echo "<img src='images/blankSquare.png'>";
};		
echo "</div>";		


		
		
echo "<div class='extendedbackground'>";
 
echo "<table class='keystats'>";

	echo "<tr><td class='keystat'> Gold:  " . fixlolnum($game->stats->goldEarned) .  "</td>";
	echo "<td class='keystat'> CS:  " . $cs .  "</td>";
	echo "<td class='keystat'> Turrets:  " . fixlolnum($game->stats->turretsKilled) .  "</td>";
	echo "<td class='keystat'> Wards Placed:  " . fixlolnum($game->stats->wardPlaced) .  "</td></tr>";
echo "</table>";

	echo "<table class='text'>";	
		
		echo "<tr><td class='stat'> Damage Dealt: </td>"  . "<td class='value'>" . fixlolnum($game->stats->totalDamageDealt) . "</td></tr>";
		echo "<tr><td class='stat'> Damage to Champions: </td>" . "<td class='value'>" . fixlolnum($game->stats->totalDamageDealtToChampions) .  "</td></tr>";
		echo "<tr><td class='stat'> Damage Taken: </td>" . "<td class='value'>" . fixlolnum($game->stats->totalDamageTaken) .  "</td></tr>";
		echo "<tr><td class='stat'> AD Damage Dealt: </td>" . "<td class='value'>" . fixlolnum($game->stats->physicalDamageDealtPlayer) .  "</td></tr>";
		echo "<tr><td class='stat'> AP Damage Dealt: </td>" . "<td class='value'>" . fixlolnum($game->stats->magicDamageDealtPlayer) .  "</td></tr>";
		echo "<tr><td class='stat'> Healed: </td>" . "<td class='value'>" . fixlolnum($game->stats->totalHeal) .  "</td></tr>";
			
	echo "</table>";
	
	
	echo "<table class='text2'>";	
		
		echo "<tr><td class='stat'> Largest Mult-Kill: </td>"  . "<td class='value'>" . fixlolnum($game->stats->largestMultiKill) . "</td></tr>";
		echo "<tr><td class='stat'> Largest Killing Spree: </td>" . "<td class='value'>" . fixlolnum($game->stats->largestKillingSpree) .  "</td></tr>";
		echo "<tr><td class='stat'> Number of Killing Sprees: </td>" . "<td class='value'>" . fixlolnum($game->stats->killingSprees) .  "</td></tr>";
		echo "<tr><td class='stat'> AD Damage Taken: </td>" . "<td class='value'>" . fixlolnum($game->stats->physicalDamageTaken) .  "</td></tr>";
		echo "<tr><td class='stat'> AP Damage Taken: </td>" . "<td class='value'>" . fixlolnum($game->stats->magicDamageTaken) .  "</td></tr>";
		echo "<tr><td class='stat'> Enemy Jungle Kills: </td>" . "<td class='value'>" . fixlolnum($game->stats->neutralMinionsKilledEnemyJungle) .  "</td></tr>";


			
	echo "</table>";
	
	
			
echo "</div>";

echo "</div></div>";	
	
	
};
	
?>


</body>
</html>
