<?php

require_once "newindex.php";
require_once "pdoconnection.php";

if( isset($_SESSION['Username']) ){

    echo 'OLD SESSION ' . $_SESSION['Username'] . '<br>';
   // header('Location: home.php');
   // exit;
}else if( isset($_COOKIE['rememberme'] )){
    echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
    $u_name = $_COOKIE['rememberme'];
    $_SESSION['Username'] = $u_name; 
    //header('Location: home.php');
   // exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    
    $u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
    $u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
   // $u_password = password_hash($u_password, PASSWORD_DEFAULT);

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

    if ($dbusername == $u_name){
        $statement = $conn->prepare("SELECT Password FROM Users WHERE Username = :u_name");
        $statement->bindParam(':u_name', $u_name);
        $statement->execute();
        $dbpassword = $statement->fetchColumn(0);
        echo $dbpassword . "<br>";

        if (password_verify($u_password, $dbpassword)) {
            echo 'Welcome ' . $u_name .'<br>';
            if( isset($_POST['rememberme']) && $_POST['rememberme'] == 'YES'){
            // Set cookie variables
            $days = 30;
            $value = $u_name;
            setcookie ('rememberme', $value, time() + ($days * 24 * 60 * 60 * 1000));
            }
            echo 'COOKIE IS SET ' . $_COOKIE['rememberme'] . '<br>';
            $_SESSION['Username'] = $u_name;
            echo 'SESSION IS SET ' . $_SESSION['Username'] . '<br>';
            //header('Location: home.php');
            //exit; 
        } else { 
            echo 'Invalid password.';
        }

    } else {
        echo "User does not exist.";

    }
}
?>
