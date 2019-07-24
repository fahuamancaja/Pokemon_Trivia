<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connections.php');

$r_user = ($_POST['r_user']);
insert_point($r_user);

?>
<html>
<head>
    <title>Removed Points</title>
</head>

    <body>
    User's point have been removed
    </body>
</html>