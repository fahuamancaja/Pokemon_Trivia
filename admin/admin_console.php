<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    session_start();
	if(!isset($_SESSION['user'])) {
		header('Location: admin_index.php');
	}
?>
<html>  
    <title>Admin Console</title>
    <link rel="stylesheet" type="text/css" href="admin_console.css">
    <body>
        <h1>Admin Console</h1>
        <div class="regbox1">
        <form method="post" action="u_search.php">
            <p for="user">Name to Search: </p><input type="text" name="user_search"/><br/>
            <input type="submit" value="Submit">
        </form>
        </div>
        <div class="regbox2">
        <form method="post" action="d_user.php">
            <p for="delete_user">ID to Delete: </p>
            <input type="text" name="delete_user"/><br/>
            <input type="submit" value="Submit">
        </form>
        </div>
        <div class="regbox3">
        <form method="post" action="r_point.php">
            <p for="user">ID to Alter Points From: </p>
            <input type="text" name="point_user"/><br/>
            <p for="point">Number of Points: </p>
            <input type="text" name="point"/><br/>
            <input type="submit" value="Submit">
        </form>
        </div>
        <div class="regbox4">
        <form method="post" action="i_user.php">
            <p for="user">New User: </p>
            <input type="text" name="user"/><br/>
            <p for="password">Password for user: </p>
            <input type="text" name="password"/><br/>    
            <p for="point" class="point">Number of Points given: </p>
            <input type="text" name="point"/><br/>
            <input type="submit" value="Submit">
        </form>
        </div>
    </body>
</html>