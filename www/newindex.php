
<?php
// Starting session
session_start();
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
    <label><input type="checkbox" name="rememberme" value="YES"> Remember me</label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>