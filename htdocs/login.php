<?PHP
require "header.php";
?>

<html>

<head>

<title> Sign-In </title>

<link rel="stylesheet" type="text/css" href="styles.css">

</head>


<body>	

<fieldset style="width:30%"> <legend> LOG-IN HERE </legend>
<form method ="POST" action="connect.php">
User <br> <input type="text" name="user" size="40"><br>
Password <input type="password" name="password" size="40"><br>
<input id="button" type="submit" name="submit" value="Log-In">

</form>
</fieldset>
</body>
</html>
