
<?php
require_once "pdoconnection.php";
session_start();
if (isset($_SESSION['Username'])) {
	header('Location: home.php');
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
		header('Location: home.php');
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
<form action="signin.php" method="post">
  <div class="form-group">
    <label for="Username">Username:</label>
    <input type="text" class="form-control" placeholder="Username/Email" name="Username">
  </div>
  <div class="form-group">
    <label for="Password">Password:</label>
    <input type="password" class="form-control" placeholder="Password" name="Password">
  </div>
  <div class="checkbox">
    <label><input type="checkbox" name="rememberme"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Log-in</button>
</form>
</body>
</html>