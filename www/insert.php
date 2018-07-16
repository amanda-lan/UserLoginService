<?php

include "index.php";

//phpinfo();
$servername = "localhost";
$username = "root";
$password = "lw0105~LW";

try {
    $conn = new PDO("mysql:host=$servername;dbname=UserLoginDB", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    
    $u_name = filter_var($_POST["Username"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
    $u_Password = filter_var($_POST["Password"], FILTER_SANITIZE_EMAIL);
    $u_CPassword = filter_var($_POST["ConfirmPassword"], FILTER_SANITIZE_STRING);

    if (empty($u_name)){
        die("Please enter your username");
    }
    if (empty($u_Password)){
        die("Please enter your password");
    }
        
    if (empty($u_CPassword)){
        die("Please confirm your password");
    } 
    if ($u_Password != $u_CPassword){
        die("Your password does not match, please enter again");
    }    
    
    $statement = $conn->prepare("INSERT INTO Users (Username, Password, CPassword) VALUES(:u_name, :u_Password, :u_CPassword)"); //prepare sql insert query
    //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
    /*$statement->bind_param('sss', $u_name, $u_Password, $u_CPassword); //bind values and execute insert query*/

    $statement->bindParam(':u_name', $u_name);
    $statement->bindParam(':u_Password', $u_Password);
    $statement->bindParam(':u_CPassword', $u_CPassword);

    
    if($statement->execute()){
        print "Hello " . $u_name. "!, your message has been saved!";
    }else{
        print $mysqli->error; //show mysql error if any
    }
}

//$conn->exec($sql);
    echo "Connection successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>
