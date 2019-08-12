<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection_methods.php');

$user = ($_POST['user']);
$pwd = hash('sha256' , $_POST['password']);
$p_point = ($_POST['point']);

//Insert new user -> insert_new_user
$push_user = new subConnections(['username'=>$user , 'password'=>$pwd , 'point'=>$p_point]);

$new_user = $push_user->insert_new_user();

?>
<html>
<head>
    <title>User Added</title>
</head>

    <body>
    User has been added <br/>
        <?php var_dump($new_user) ;?><br/>
    </body>
</html>