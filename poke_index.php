<?php
    //Error Checks
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	
    //Continue coding session throughout pages
	session_start();
    
    //Connecting to Database
	require_once('dbconnectpoke.php');

    //Check is there is a current session, if there is, then go to poke_test.php
	if(isset($_SESSION['user'])) {
		header('Location: poke_test.php');
	}

    //Check if the user exists based on input
	if(isset($_POST['username']) && isset($_POST['password'])) {
        
        //Sanitize Input
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        //SHA256 Encrypt password
		$password = hash('sha256' , $_POST['password']);
        //Store $username as session's username
        $_SESSION['username'] = $username;
        //findOne sanitized user and encrypted password to user in poke_users
		$result = $db->poke_users->findOne([
		'user'=>$_SESSION['username'],
		'password'=>$password
		]);

        //If it didn't findOne, do nothing
		if(!$result) {

		} 
        //If it did find one, the session user will be the id of user of poke_users and you will go to poke_test.php
        else {
			$_SESSION['user'] = $result->_id;
			header('Location: poke_test.php');
		}
	}

?>

<html>
<head>
	<title>Pokemon Login</title>
    <link rel="stylesheet" type="text/css" href="poke_index.css">

<body>
    <div class="loginbox">
    <img src="/images/icons/pokeball.png" class="avatar">
        <h1>Login Here</h1>
    
	<form method="post" action="poke_index.php">

		<p for="username">Username: </p><input type="text" name="username" /><br>
		<p for="password">Password: </p><input type="password" name="password" /><br>
		<input type="submit" value="Login">

	
	<a href="poke_register.php">No account? Register here.</a>
        </form>
        </div>
</body>
</head>
</html>
