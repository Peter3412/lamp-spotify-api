<?php
//Start session
session_start();
$_SESSION['ip'] = ""; // put your webserver address here
$_SESSION['client_id'] = ""; // put your client id here -- spotify provided
$_SESSION['client_secret'] = ""; // put your client secret here -- spotify provided
$_SESSION['current_user_id'] = NULL;
header("Location: login.php"); 
exit();
?>