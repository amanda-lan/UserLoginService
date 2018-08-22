<?php
require_once "db.php";
if (isset($_POST['form_submitted'])) {
	//Check it is comming from a form
	$u_name = filter_var($_POST["username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_password = filter_var($_POST["password"], FILTER_SANITIZE_EMAIL);
	// $u_password = password_hash($u_password, PASSWORD_DEFAULT);
	$u_cpassword = filter_var($_POST["confirm-password"], FILTER_SANITIZE_STRING);
	//$u_cpassword = password_hash($u_cpassword, PASSWORD_DEFAULT);

	if (empty($u_name)) {
		die("Please enter your username");
	}
	if (empty($u_password)) {
		die("Please enter your password");
	}
	if (empty($u_cpassword)) {
		die("Please confirm your password");
	}
	if ($u_password != $u_cpassword) {
		die("Your password does not match, please enter again");
	} else {

	}

	$dbresult = DB::queryUser("SELECT Username FROM Users WHERE Username = :", "u_name", $u_name);
	if ($dbresult) {
		echo "Username has already exist!" . "<br>";
	} else {
		$hashed_password = password_hash($u_password, PASSWORD_DEFAULT);
		DB::insertNewUser($u_name, $hashed_password, $u_cpassword);
		echo "Hello " . $u_name . "! Your message has been saved!";
		session_start();
		$_SESSION['Username'] = $u_name;
		header("Location: home.php");
		exit;
	}
} else {
	header("Location: index.php");
	exit;
}
