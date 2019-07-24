<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Connect to Database
    require_once('connections.php');
$_SESSION['username'] = "jin";
$_POST['password'] = "jin";
$_SESSION['password'] = hash('sha256' , $_POST['password']);
$score = pull_point();
echo $score;
$result = pull_user();
print_r($result);
$totalpoint = '40';
insert_point($totalpoint);
?>