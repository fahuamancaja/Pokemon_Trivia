<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connections.php');
//	if(!isset($_SESSION['user'])) {
//		header('Location: admin_index.php');
//	}
?>
<html>
    <title>Admin Console</title>
    <body>
    <form method="post" action="user_search.php">
<div id="user">
    <label for="user" class="user">Name: </label><input class="input" type="text" name="user"/><br>
</div>
<div class="buttons">
    <button type="submit" class="button">Submit</button>
</div>
        </form>
    </body>
</html>