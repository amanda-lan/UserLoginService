<?php
session_start();
echo 'Byebye ' . $_SESSION['Username'] . '!' . '<br>';
session_destroy();
setcookie('rememberme', '', time() - 864000);
?>
