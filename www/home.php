<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Homepage</h1>
	<ul>
		<li><a href="index.php">Sign Up</a></li>
		<li><a href="newindex.php">Sign In</a></li>
	</ul>
</body>
</html>
<?php
session_start();
if (isset($_SESSION['Username'])) {
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
}