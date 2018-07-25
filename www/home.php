<?php
//require_once "pdoconnection.php";
//require_once "signin.php";

//check user login or not
if(!isset($_SESSION['Username'])){
	echo 'SESSION IS NOT SET ' . $_SESSION['Username'] . '<br>';
 	//header('Location: index.php');
}

// logout
if(isset($_POST['Logout'])){
	session_destroy();

 // Remove cookie variables
 	$days = 30;
 	setcookie ('rememberme','', time() - ($days * 24 * 60 * 60 * 1000));
 	echo 'Logout <br>';
 	//header('Location: index.php');
}
?>

<h1>Homepage</h1>
<form method='post' action="">
 <input type="submit" value="Logout" name="Logout">
</form>