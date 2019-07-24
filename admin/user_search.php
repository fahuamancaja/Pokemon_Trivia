<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connections.php');

$user = ($_POST['user']);

$result=pull_user($user);


//    var_dump($info);
//    echo implode("oid", (array)$info);

$newArr = array();
$show_users = "";
    
    foreach ($result as $info){
    $newArr[$info->user][] = (array)$info;
    $show_users.= implode(" ", (array)$info);
    $show_users.= "</br>";
};

?>
<html>
<head>
    <title>Poke Users</title>
    </head>
    <body>
        <p>These are the users found:</p>
        <?php echo $show_users ;?>
        <form method="post" action="r_point.php">
<div id="r_user">
    <label for="user" class="r_user">Name: </label><input class="input" type="text" name="r_user"/><br>
</div>
<div class="buttons">
    <button type="submit" class="button">Submit</button>
</div>
        </form>
    </body>
    
</html>