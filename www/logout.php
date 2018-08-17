<!DOCTYPE html>
<html>
<head>
	<title><title>Home Page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css"></title>
</head>
<body>
	<h1>Homepage</h1>
	<form method="get" action="">
		<input type="submit" name="Logout" value="Logout">
	</form>
</body>
</html>
<?php
session_start();
if (!isset($_GET["Logout"])) {
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
} else {
	session_destroy();
	setcookie('rememberme', '', time() - 864000);
	header("Location: home.php");
	exit;
}

/*if (!isset($_SESSION['Username'])) {
header('Location: index.php');
exit;
} else {
echo 'Welcome ' . $_SESSION['Username'] . '<br>';
if (isset($_GET['Logout'])) {
header('Location: logout.php');
exit;
}
}
echo 'Byebye ' . $_SESSION['Username'] . '!' . '<br>';
session_destroy();
setcookie('rememberme', '', time() - 864000);*/
