<?php
session_start();
if (!isset($_SESSION['Username'])) {
	header('Location: newindex.php');
	exit;
} else {
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
}
if (isset($_GET['Logout'])) {
	header('Location: logout.php');
	exit;
}
<h1>Homepage</h1>
<form method='get' action="">
<input type="submit" value="Logout" name="Logout">
</form>
