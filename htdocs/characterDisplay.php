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
echo " - Level: " . $summoner->summonerLevel . "<br>";
 
?>

<br><b>

<div id="summstats" >
	
<?php

$insert = mysqli_query($connection, "INSERT INTO `recentSearches` (`name`) VALUES ('".$name."')");
$summoner = $summonerAPI->info($name);
$recentGames = $gameAPI->recent($summoner->id);
echo "<img src='http://avatar.leagueoflegends.com/na/". ($name) 
. ".png' >" .  	
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

// print_r($recentGames->games[0]->stats);
?>
</div>
<hr>
Recent Games:
<br><br>
	
<div class="gamearea">
		
<p>	
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

$thumb = "<tr><img src='images/" . fixlolname($championName[0]) . "Square.png' ><tr> "  ;		 

// echo "<!---#$championId--->";

$won = $game->stats->win;


			
	echo "<div class='cardstats'>";	
		
		// echo "<table>";
			
			
		
		
			echo "<div class='kda'>" . $kda . "</div>";
		
			
			if ($won == 1){
			  echo "<div class='victory'>" . " Victory" . "</div>";
			}
			else {
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
			
			
			
			// echo "</td>";
		
			
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
echo "<div class='extendedstats'><pre>";
		
			 
		
	echo "<ul> <li>" . 'Total Damage: ' . fixlolnum($game->stats->totalDamageDealt) . "</li>";

	echo "<li>" . 'Damage to Champions: ' . fixlolnum($game->stats->totalDamageDealtToChampions) .  "</li>";

	echo "<li>" . 'Gold:	' . fixlolnum($game->stats->goldEarned) .  "</li>";
		
		
	$cs = "Minions Killed:	" . fixlolnum($game->stats->minionsKilled) + fixlolnum($game->stats->neutralMinionsKilled);
	echo "<li>" . "CS: " . $cs .  "</li>";
	echo "<li>" . 'Wards Placed: ' . fixlolnum($game->stats->wardPlaced) .  "</li> </ul>";
			
echo "</pre></div>";


		// foreach($blanks as $blank) {
			
		// 	echo "<img src='images/blankSquare.png'>";
		// };
		
	
			
		echo "</div>";
		// echo "<br>";
		};
		// echo "</table>";	
		

		
		
		#print_r($recentGames->games[0]->stats);
		#
		#foreach ($champions as $championId => $championName) {
		#	echo "<img src='/images/" . fixlolname($championName) . "Square.png'>";	
		#}
		#echo '<pre>';
		#print_r($staticDataApi->getItems());
		#echo '</pre>';
		?>
		</p>
		</div>
</body>
</html>
