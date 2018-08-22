<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";
session_start();
if (isset($_SESSION['Username'])) {
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
	?>
	<nav>
		<ul>
		<li><a href="home.php">Home</a></li>
		</ul>
	</nav>
	<form method="get" action="home.php">
		<input type="submit" name="Logout" value="Logout">
	</form>
<?php
} else if (isset($_COOKIE['rememberme'])) {
	$up = explode(',', base64_decode($_COOKIE['rememberme']));
	$u_name = $up[0];
	//echo "Username:" . $up[0] . "<br>";
	$hashed_password = $up[1];
	//echo "Password:" . $up[1] . "<br>";
	$dbresult = DB::queryUser("SELECT Username, Password FROM Users WHERE Username = :", "u_name", $u_name);
	$dbusername = $dbresult[0]['Username'];
	$dbpassword = $dbresult[0]['Password'];
	//echo $dbpassword . "<br>";
	if ($hashed_password == $dbpassword) {
		$_SESSION['Username'] = $u_name;
		echo 'Welcome ' . $_SESSION['Username'] . '<br>';
	}
	?>
	<nav>
		<ul>
		<li><a href="home.php">Home</a></li>
		</ul>
	</nav>
	<form method="get" action="home.php">
		<input type="submit" name="Logout" value="Logout">
	</form>
<?php
} else if (!isset($_SESSION['Username']) && !isset($_COOKIE['rememberme'])) {
	?>
	<nav>
		<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="signin.php">Sign In</a></li>
		</ul>
	</nav>
</body>
</html>
<?php
} else {
	echo "Wanining: Someone try to steal your account!";
	setcookie('rememberme', '', time() - 864000);
}
if (isset($_GET["Logout"])) {
	session_destroy();
	setcookie('rememberme', '', time() - 864000);
	header("Location: index.php");
	exit;
}
?>