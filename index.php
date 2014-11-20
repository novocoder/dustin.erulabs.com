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

<<<<<<< HEAD





=======
>>>>>>> 9428d697c41660560d357a6f6c5c8aeb8c67ac84
<pre>

<?php


<<<<<<< HEAD
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
=======
require 'vendor/autoload.php';
use LeagueWrap\Api;
>>>>>>> 9428d697c41660560d357a6f6c5c8aeb8c67ac84

$api = new Api('9249495a-ec4c-4026-bb9c-a7648103bd41');

$summonerAPI = $api->summoner();

$name = $_GET['name'];

$summoner = $summonerAPI->info($name);

print_r($summoner);

?>
</pre>
</body>
