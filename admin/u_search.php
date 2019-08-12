<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection_methods.php');

$user = ($_POST['user_search']);

//Searching users by username -> function pull_user
$user_info = new subConnections(['username'=>$user]);

$show_users = $user_info->pull_user();

?>
<html>
<head>
    <title>Poke Users</title>
    </head>
    <body>
        <p>These are the users found:</p>
        <?php echo $show_users ;?>

    </body>
    
</html>