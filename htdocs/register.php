
<?php

require 'header.php';

?>

<html>
<head>

<title> Register </title> 


</head>


<body>
	<fieldset style="width:30%"> <legend> SIGN-UP HERE </legend>
	<form name="form1" action="" method="post">
	First Name <br><input type="text" name="t1"><br>
	Last Name <br><input type="text" name="t2"><br>
	Username <br><input type="text" name="t3"><br>
	Password <br><input type="text" name="t4"><br><br>
	<input type="submit" name="submit1" value="register">
	</form>
</body>

</html>

<?php
if(isset($_POST["submit"]))
{
	$pwd=md5 ($_POST["t4"]);
	mysql_connect("localhost","root","");
	mysql_select_db("dustindb");
	mysql_query("INSERT INTO users VALUES('$_POST[t1]','$_POST[t2]','$_POST[t3]','')");
}

?>