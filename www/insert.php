<?php

include "index.php";
include "pdoconnection.php";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    
    $u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
    $u_password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
   // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
    $u_cpassword = filter_var($_POST["ConfirmPassword"], FILTER_SANITIZE_STRING);
    //$u_cpassword = password_hash($u_cpassword, PASSWORD_DEFAULT);

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
    $u_password = password_hash($u_password, PASSWORD_DEFAULT);
    $statement->bindParam(':u_name', $u_name);
    $statement->bindParam(':u_Password', $u_password);
    $statement->bindParam(':u_CPassword', $u_cpassword);
    $statement->execute();
    
    echo "Hello " . $u_name. "!, your message has been saved!";
   
   }

?>
