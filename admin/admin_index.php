<?php
    //Error Checks
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	
    //Continue coding session throughout pages
	session_start();
    
    //Connecting to Database

    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
	$db = $client->poke;

    //Check is there is a current session, if there is, then go to poke_test.php
	if(isset($_SESSION['user'])) {
		header('Location: admin_console.php');
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


    $result = $db->poke_admin->findOne([
    'user'=>$_SESSION['username'],
    'password'=>$password,
    ]);

        //If it didn't findOne, do nothing
		if(!$result) {

		} 
        //If it did find one, the session user will be the id of user of poke_users and you will go to poke_test.php
        else {
			$_SESSION['user'] = $result->_id;
			header('Location: admin_console.php');
		}
	}

?>

<html>
<head>
	<title>Admin Login</title>

<body>
    <div class="loginbox">
        <h1>Login Here</h1>
    
	<form method="post" action="admin_index.php">

		<p for="username">Username: </p><input type="text" name="username" /><br>
		<p for="password">Password: </p><input type="password" name="password" /><br>
		<input type="submit" value="Login">
        </form>
        </div>
</body>
</head>
</html>
