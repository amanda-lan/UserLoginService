<?php
require_once "newindex.php";
require_once "pdoconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    $u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); 
    $u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
    if (empty($u_name)){
        die("Please enter your username");
    }
    if (empty($u_password)){
        die("Please enter your password");
    }
    $statement = $conn->prepare("SELECT Username FROM Users WHERE Username = :u_name");
    $statement->bindParam(':u_name', $u_name);
    $statement->execute();
    $dbusername = $statement->fetchColumn(0);
    //check if username and password match the database value 
    if ($dbusername == $u_name){
        $statement = $conn->prepare("SELECT Password FROM Users WHERE Username = :u_name");
        $statement->bindParam(':u_name', $u_name);
        $statement->execute();
        $dbpassword = $statement->fetchColumn(0);
        echo $dbpassword . "<br>";

        if (password_verify($u_password, $dbpassword)) {
            echo 'Welcome ' . $u_name .'<br>';
            if( isset($_POST['rememberme'])){
            // Set cookie variables
            $value = base64_encode($u_name . "," . $dbpassword);
            setcookie ('rememberme',$value, time() + 846000);
            } 
            echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
            //Set session variables
            $_SESSION['Username'] = $u_name;
            echo 'SESSION IS SET ' . $_SESSION['Username'] . '<br>';
            header('Location: home.php');
            exit; 
        } else { 
            echo 'Invalid password.';
        }
        } else {
        echo "User does not exist.";
    }
}
?>
