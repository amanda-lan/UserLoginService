<?php
session_start();
if(!isset($_SESSION['Username'])){
 	header('Location: newindex.php');
}else{
	echo 'Welcome ' . $_SESSION['Username'] . '<br>';
}
// logout
if(isset($_POST['Logout'])){
	session_destroy();
 	// Remove cookie variables
 	$days = 30;
 	setcookie ('rememberme','', time() - ($days * 24 * 60 * 60 * 1000));
 	//setcookie ('rememberme','', time() - 60);
 	echo 'Logout <br>';
 	header('Location: newindex.php');
}
?>

<h1>Homepage</h1>
<form method='post' action="">
<input type="submit" value="Logout" name="Logout">
</form>