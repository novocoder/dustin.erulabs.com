<?PHP
$comments = db_select("SELECT * FROM comments");

foreach ($comments as $comment) {

	echo $comment["name"];
	echo "<br>";
	echo $comment["words"];
	echo "<br><br>";

}

?>
