<?php

include "index.php";

$dbusername = "root";
$dbpassword = "lw0105~LW";

$dsn = "mysql:host=localhost;dbname=UserLoginDB;charset=utf8mb4";
$options = [
  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
];

try {
    $conn = new PDO($dsn, $dbusername, $dbpassword，$options);
    /* set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec($sql);*/
   if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    
    $u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
    $u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
    $u_cpassword = filter_var($_POST["ConfirmPassword"], FILTER_SANITIZE_STRING);

    if (empty($u_name)){
        die("Please enter your username");
    }
    if (empty($u_password)){
        die("Please enter your password");
    }
    if (empty($u_cpassword)){
        die("Please confirm your password");
    } 
    if ($u_password != $u_cpassword){
        die("Your password does not match, please enter again");
    }    
    
    $statement = $conn->prepare("INSERT INTO Users (Username, Password, CPassword) VALUES(:u_name, :u_Password, :u_CPassword)"); //prepare sql insert query
    //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
    /*$statement->bind_param('sss', $u_name, $u_Password, $u_CPassword); //bind values and execute insert query*/

    $statement->bindParam(':u_name', $u_name);
    $statement->bindParam(':u_Password', $u_password);
    $statement->bindParam(':u_CPassword', $u_cpassword);
    $statement->execute()；
    
    /*if(){
        echo "Hello " . $u_name. "!, your message has been saved!";
    }else{
        echo $mysqli->error; //show mysql error if any
    }*/
    }
    echo "Connection successfully"; 
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }

?>
