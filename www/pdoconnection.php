<?php

$dbusername = "root";
$dbpassword = "lw0105~LW";

$dsn = "mysql:host=localhost;dbname=UserLoginDB;charset=utf8mb4";
$options = [
  PDO::ATTR_EMULATE_PREPARES   => false,// turn off emulation mode for "real" prepared statements
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //make the default fetch be an associative array
];

try {
    $conn = new PDO($dsn, $dbusername, $dbpassword, $options);
    echo "Connection successfully"; 
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
    }

?>
