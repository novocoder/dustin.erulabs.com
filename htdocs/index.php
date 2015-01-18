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

echo "NA Server Status: ";

/* our simple php ping function */
function ping($host)
	  {
		 exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
	 return $rval === 0;
	  }

$host = '216.52.241.254';
$up = ping($host);

/* optionally display either a red or green image to signify the server status */


	 echo '<img src="'.($up ? 'on' : 'off').'.jpg" alt="'.($up ? 'up' : 'down').'" />';

?>

<br>	

<?php


// VISITOR COUNTER///

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

Hello,

<?php

	if (!isset($_POST["name"])){
		echo "Summoner";
	} else {
		echo $_POST["name"];
		require 'characterDisplay.php';
}         

$connection = mysqli_connect('localhost','dustinsite','qweasd','dustindb');
function sanitize($input) {
	//$output = mysql_real_escape_string($input, $connection);
	return $input;
	return $output;
}	

if (isset($_POST["commentname"]) && isset($_POST["words"])) {

	$insert = mysqli_query($connection, "INSERT INTO `comments` (`name`,`words`) VALUES ('".sanitize($_POST['commentname'])."','".sanitize($_POST['words'])."')");
}	
require 'comments.php';


?>
<form action="index.php" method="post">
	Name:
	<br>
		<input type="text" name="commentname">
		<br>
		Comment:
		<br>
		<input type="text" name="words">
		<br>
		<input type="submit" value="submit">
</form>
</body>
</html>
