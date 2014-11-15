<head>

	<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />

	<script src="/script.js"></script>
		
</head>
<body>

	<h1> Random header 2.0 </h1>
	,<section>
 	<ul>
	<li> stuff </li>
	</ul>


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
