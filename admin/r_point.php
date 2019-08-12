<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connection_methods.php');

$i_user = ($_POST['point_user']);
$p_point = ($_POST['point']);

$push_point = new subConnections(['id'=>$i_user , 'point'=>$p_point]);

$add_point = $push_point->insert_point();

?>
<html>
<head>
    <title>Points Altered</title>
</head>

    <body>
    User's point have been altered. <br/>
        <?php var_dump($add_point) ;?><br/>
    </body>
</html>