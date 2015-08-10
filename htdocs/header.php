<?PHP
$connection = mysqli_connect('localhost','dustinsite','sh33quil','dustindb');
if($connection == false) {
	echo mysqli_connect_error();
}
function db_select($query) {
        global $connection;
	$rows = array();
        $results = mysqli_query($connection,$query);

        // If query failed, return `false`
        if($results === false) {
            return false;
        }

        // If query was successful, retrieve all the rows into an array
        while ($row = mysqli_fetch_assoc($results)) {
            $rows[] = $row;
        }
        return $rows;
    }
?>
<!DOCTYPE html>
<html>

<head>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<b>
<br>
<!-- STYLE SWITCH!!!!!!!!!

<div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
	    <label class="onoffswitch-label" for="myonoffswitch">
	        <span class="onoffswitch-inner"></span>
		    <span class="onoffswitch-switch"></span>
		        </label>
			    </div> -->
<div style="text-align:right;">



<?php
//NA RIOT SERVER STATUS//
// function ping($host)
// {
//         exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
//         return $rval === 0;
// }


// echo "NA Server Status: ";


// $host = '216.52.241.254';
// $up = ping($host);

// if( $up ) {
//         echo "up";
// }
// else {
//         echo "down";
// }

// ?>

<!--// <br>	-->

<?php


// VISITOR COUNTER///

// $results = db_select("SELECT * FROM visitDATA");
// #print_r($results);


// //Have you visited before?
// $found = false;
// $totalvisits = 1;
// foreach ($results as $visitorDATA){
// 	$totalvisits = $totalvisits + $visitorDATA["visits"];

// //print_r ($visitorDATA);
// //	echo $visitorDATA["ip"];
// //	echo "<br>";
// //if this record is for your address 
// 	if ($visitorDATA["ip"] == $_SERVER['REMOTE_ADDR']){
// 		$found = true;
// 		$visits = $visitorDATA["visits"];
// 	}
// }

// if ($found){
// 	$visits = $visits+1;
// 	//update
// 	$update = mysqli_query($connection, "UPDATE `visitDATA` SET `visits`=".$visits." WHERE `ip`='".$_SERVER['REMOTE_ADDR']."'");
// } else {
// 	//insert
// 	$visits = 1;
// 	$insert = mysqli_query($connection, "INSERT INTO `visitDATA` (`ip`,`visits`) VALUES ('". $_SERVER['REMOTE_ADDR'] ."',1)");
// }



// //echo $_SERVER['REMOTE_ADDR'];
// echo "Your visits: ".$visits;
// echo "<br>";
// echo "Unique visits: " . count($results);
// echo "<br>";
// echo "Total: ".$totalvisits;
?>

<FORM METHOD="LINK" ACTION="login.php">
	<INPUT TYPE="submit" VALUE="Log In">
</FORM>
	<FORM METHOD="LINK" ACTION="register.php">
	<INPUT TYPE="submit" VALUE="Sign-up">
</FORM>
</div>


<h1>

<center>LEAGUE-RIVALS</center>

</h1>

<script src="script.js"></script>
<br><br>




<body>
    <div class="nav">
      <ul>
        <li class="home"><a href="index.php">Home</a></li>
        <li class="profile"><a class="active" href="#">Profile</a></li>
        <li class="games"><a href="gameTypes.php">Games</a></li>
        <li class="stats"><a href="#">Stats</a></li>
        <li class="about"><a href="about.php">About</a></li>
      </ul>
    </div>
</body>



<form class="form_wrapper" action="index.php" method="post">


<?PHP
	echo "Recently Searched: ";
$results = db_select("SELECT DISTINCT name FROM recentSearches ORDER BY id DESC LIMIT 5");
$totalNumberOfNames = count($results);
// If there is one thing in the list - its id is 0. 2... id 1... etc.
$positionOfLastItemInList = $totalNumberOfNames - 1;

foreach ($results as $recentName) {
	echo $recentName['name'];
//if we are not the last item, add ,
	if($recentName['name'] != $results[$positionOfLastItemInList]['name']) {
	echo ", ";
	}
};


?>
	
	<br>
		<input class="search1" type="text" name="name" placeholder="Search Recent Games of Summoner">
	<br>
		<input class="submit" type="submit" value="submit">
		


</form>



