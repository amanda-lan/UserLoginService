
<?php
// Starting session
session_start();
if(isset($_SESSION['Username'])){
	//echo 'OLD SESSION ' . $_SESSION['Username'] . '<br>';
    header('Location: home.php');
    exit;
}else if(isset($_COOKIE['rememberme'])){
    //echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
    //$u_name = password_veriffy($_COOKIE['rememberme'],PASSWORD_DEFAULT);
    $up = explode(',' ,base64_decode($_COOKIE['rememberme']));
    $u_name = $up[0];
    $_SESSION['Username'] = $u_name; 
    header('Location: home.php');
    exit;
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
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>