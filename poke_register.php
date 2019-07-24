<?php
    //Error Checks
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Continue coding session throughout pages 
	session_start();

    //Connecting to Database - Will eventually create
	require_once('dbconnectpoke.php');

    //Check is there is a current session
	if(isset($_SESSION['user'])) {
		header('Location: poke_test.php');
	}

    //If username and password is typed by user
	if(isset($_POST['username']) && isset($_POST['password'])) {
        //Sanitize username of user
        $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING);
        //Sha256 encrypt password
		$password = hash('sha256' , $_POST['password']);
        //Save $username as Session username
        $_SESSION['username'] = $username;
        //Input the username and password for new user and 0 points
		$result = $db->poke_users->insertOne([
		'user'=>$username, 
		'password'=>$password,
        'point'=>'0'
		]);
		//After inputting the data go to poke_index.php
		header('Location: poke_index.php');
	}
?>

<html>
<head>
	<title>Pokemon Register</title>
    <link rel="stylesheet" type="text/css" href="poke_register.css">
<body>
    <div class="regbox">
    <img src="/images/icons/pokeball.png" class="avatar">
        <h1>Register Here</h1>    
	<form method="post" action="poke_register.php">
		<p for="username">Username: </p><input type="text" name="username" /><br>
		<p for="password">Password: </p><input type="password" name="password" /><br>
		<input type="submit" value="Sign Up">
	
	<a href="poke_index.php">Already have an account? Login here.</a>
    </form>
    </div>
</body>
</head>    
</html>
