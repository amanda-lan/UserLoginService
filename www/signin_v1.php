<!DOCTYPE html>
<html>
<body>
<?php
require_once "db.php";
if (isset($_POST['form_submitted'])) {
	$u_name = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$u_password = filter_var($_POST["password"], FILTER_SANITIZE_EMAIL);
	if (empty($u_name)) {
		die("Please enter your username");
	}
	if (empty($u_password)) {
		die("Please enter your password");
	}
	// $temp = "u_name";
	$dbresult = DB::queryUser("SELECT Username, Password FROM Users WHERE Username = :", "u_name", $u_name);
	$dbusername = $dbresult[0]['Username'];
	//check if username and password match the database value
	if ($dbusername == $u_name) {
		$dbpassword = $dbresult[0]['Password'];
		if (password_verify($u_password, $dbpassword)) {
			echo 'Welcome ' . $u_name . '<br>';
			session_start();
			$_SESSION['Username'] = $u_name;
			echo 'SESSION IS SET ' . $_SESSION['Username'] . '<br>';
			if (isset($_POST['rememberme'])) {
				// Set cookie variables
				$value = base64_encode($u_name . "," . $dbpassword);
				setcookie('rememberme', $value, time() + 846000);
				echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
			}
			header('Location: home.php');
			exit;
		} else {
			echo 'Invalid password.';
		}
	} else {
		echo "User does not exist.";
	}
} else {
	header("Location: index.php");
	exit;
}
