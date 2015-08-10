
<?php

require 'header.php';

?>

<html>
<head>

<title> Register </title> 


</head>


<body>
	<p>
		<fieldset style="width:30%">
		<legend> SIGN-UP HERE </legend>
		<form id="register" action="register.php" method="post"
			accept-charset="UTF-8">
			
			<input type="hidden" name="submitted" id="submitted" value="1"/>
	
		<label for="email" >Email Address*:</label>
			<input type="text" name="email" id="email" maxlength="50"/>
		<label for="username" >Username*:</label>
			<input type="text" name="username" id="username" maxlength="25"/>
		<label for="password" >Password*:</label>
			<input type="password" name="password" id="password" maxlength="50" />
		<input type="submit" name="Submit" value="Submit" />
		
		
				
		Username <br><input type="text" name="t3"><br>
		Password <br><input type="text" name="t4"><br><br>
		<input type="submit" name="submit1" value="register">
		</form>
	</p>
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