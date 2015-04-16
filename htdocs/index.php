<?PHP

require 'header.php';

?>

Hello,

<?php
	if (!isset($_POST["name"])){
		echo "Summoner";
	} else {
		echo $_POST["name"];
		require 'characterDisplay.php';
}         

function sanitize($input) {
	global $connection;
	$output = mysqli_real_escape_string($connection, $input);
	return $output;
}	

if (isset($_POST["commentname"]) && isset($_POST["words"])) {

	$insert = mysqli_query($connection, "INSERT INTO `comments` (`name`,`words`) VALUES ('".sanitize($_POST['commentname'])."','".sanitize($_POST['words'])."')");
}

echo "<br><br>Comments:<br><br>";
	


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
