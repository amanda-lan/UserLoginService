<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['Username'])) {
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
} else {
	?>
	<nav>
		<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="signup.php">Sign Up</a></li>
		<li><a href="signin.php">Sign In</a></li>
		</ul>
	</nav>
<?php
}
?>
</body>
</html>