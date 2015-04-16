<?PHP

require 'header.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'dustindb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
/*
$ID = $_POST['user'];
$Password = $_POST['password'];
*/
function SignIn()
{
session_start(); //starts seesion for page 
if(!empty($_POST['user'])) // Checks the user name from form. is it empty?
{
	$query = mysql_query("SELECT * FROM users where names = '$_POST[user]' AND password = '$_POST[password]'") or die(mysql_error());
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['names']) AND !empty($row['password']))
	{
		$_SESSION['names'] = $row['password'];
		echo "SUCCESS!!!";
	
	}
	else
	{
		echo "Login Info Is Incorrect!";
	}
}
}
if(isset($_POST['submit']))
{
	SignIn();
}

?>
