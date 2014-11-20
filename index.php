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
require 'vendor/autoload.php';
use LeagueWrap\Api;

$api = new Api('9249495a-ec4c-4026-bb9c-a7648103bd41');

$summonerAPI = $api->summoner();

$name = $_GET['name'];

$summoner = $summonerAPI->info($name);

print_r($summoner);

?>
</pre>
</body>
