<?php
require_once "db.php";
session_start();
if (isset($_SESSION['Username'])) {
	header('Location: logout.php');
	exit;
} else if (isset($_COOKIE['rememberme'])) {
	$up = explode(',', base64_decode($_COOKIE['rememberme']));
	$u_name = $up[0];
	echo "Username:" . $up[0] . "<br>";
	$hashed_password = $up[1];
	echo "Password:" . $up[1] . "<br>";
	$stmt = $conn->prepare('SELECT Password FROM Users WHERE Username = :u_name');
	$stmt->bindParam(':u_name', $u_name);
	$stmt->execute();
	$dbpassword = $stmt->fetchColumn(0);
	echo $dbpassword . "<br>";
	if ($hashed_password == $dbpassword) {
		$_SESSION['Username'] = $u_name;
		header('Location: logout.php');
		exit;
	} else {
		echo "Wanining: Someone try to steal your account!";
		setcookie('rememberme', '', time() - 864000);
	}
}
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (isset($_POST['form_submitted'])) {
	$u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING);
	$u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
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
			if (isset($_POST['rememberme'])) {
				// Set cookie variables
				$value = base64_encode($u_name . "," . $dbpassword);
				setcookie('rememberme', $value, time() + 846000);
			}
			echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
			//Set session variables
			$_SESSION['Username'] = $u_name;
			echo 'SESSION IS SET ' . $_SESSION['Username'] . '<br>';
			header('Location: logout.php');
			exit;
		} else {
			echo 'Invalid password.';
		}
	} else {
		echo "User does not exist.";
	}
} else {
	?>
		<form action="signin.php" method="post">
            Username: <input type="text" placeholder="Enter Username" name="Username"><br>
            Password: <input type="password" placeholder="Enter Password" name="Password"><br>
            <label><input type="checkbox" name="rememberme"> Remember me</label><br>
            <input type="hidden" name="form_submitted" value="1"/>
            <input type="submit" name="Sign Up" value="Sign Up" />
        </form>
<?php
}
