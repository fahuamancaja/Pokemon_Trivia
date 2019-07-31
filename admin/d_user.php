<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection_methods.php');

$i_user = ($_POST['delete_user']);

//Delete user ->delete_user
$delete_user = new subConnections();
$delete_user->return_id($i_user);

$d_user = $delete_user->delete_user();


?>
<html>
<head>
    <title>User Deleted</title>
</head>

    <body>
    User has been deleted <br/>
        <?php var_dump($d_user) ;?><br/>
    </body>
</html>