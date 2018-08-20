
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign-up Page</title>
    </head>
    <body>

    </body>
</html>
<?php
require_once "db.php";
if (isset($_POST['form_submitted'])) {
	//Check it is comming from a form
	$u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
	// $u_password = password_hash($u_password, PASSWORD_DEFAULT);
	$u_cpassword = filter_var($_POST["ConfirmPassword"], FILTER_SANITIZE_STRING);
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
		$_SESSION['Username'] = $u_name;
	}
} else {
	?>
            <form action="signup.php" method="post">
            Username: <input type="text" placeholder="Enter Username" name="Username"><br>
            Password: <input type="password" placeholder="Enter Password" name="Password"><br>
            Confirm Password: <input type="password" placeholder="Repeat Password" name="ConfirmPassword"><br>
            <input type="hidden" name="form_submitted" value="1"/>
            <input type="submit" name="Sign Up" value="Sign Up" />
    </form>
<?php
}
