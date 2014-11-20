<head>

	<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />

	<script src="/script.js"></script>
		
</head>
<body>
	



	<h1> Summoner Shit </h1>
	<section>
 	<ul>
	Enter Summoner name for shit
	</ul>

	<br>

	</section>

	<section>	
	<form action="index.php" method="post">
		
	

		
			
		Name: <input type="text" name="name"><br>

			<br>
		
			<input type="submit"><br>

		
		
	</form>


	</section>






<pre>

<?php


// Include the PHP RIOT API library
include('php-riot-api.php');

// Start the library with the 'na' region code
$lolapi = new riotapi('na');

// IF they DIDNT provided a name in the URL, like "/?name=bob", then use dustins name
if ($_POST['name'] == '') {
	$name = 'Reptuar';
// Otherwise, use what they gave us
} else {
	$name = $_POST['name'];
}

// Get the data about that summoner
$person = $lolapi->getSummonerByName($name);

// Extract that persons ID for later use
$id = $person[strtolower($name)]['id'];

// Get info about last game
$game = $lolapi->getGame($id);

// Print the Array of the last game
print_r($game);

// see https://github.com/kevinohashi/php-riot-api
// and https://github.com/kevinohashi/php-riot-api/blob/master/testing.php

?>
</pre>
</body>
