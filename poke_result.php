<?php

    //Checks for Errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Connects to dbconnectpoke.php to Mongodb
    session_start();

    //$usern = $_SESSION[username];
    require_once('dbconnectpoke.php');

	if(!isset($_SESSION['user'])) {
		header('Location: poke_index.php');
	}

    //Recalls number from poke_test page
    $number = $_POST['number'];

    //Checks random number with pokemon in database
    $result = $db->poke_test->findOne(
      [
      'number' => $number,
      ],
      [
        'projection' =>
          [
            'name' => 1,
          ],
      ]
    );

    //Takes results to get string containing pokemon to put in $pname
    $pname = $result->name;

    //Takes the answer from poke_test and puts in in cariable poke
    $poke = ($_POST['pokemon']);

    //Creates seperate value for pokemon check
    $pcheck = $pname;

    //Check for correct answer and count point
    if ($pcheck == $poke) {
      $answer = "Correct!";
      $newpoint = "1";
    }else{
      $answer = "Incorrect";
      $newpoint = "0";
    }

    //Pulls out old point from user
    $pointfdb = $db->poke_users->findOne(
      [
          'user' => $_SESSION['username']
      ],
      [
          'projection' => 
          [
              'point' => 1,
          ],
      ]
    );
    //Take out user point and put it into $oldpoint
    $oldpoint = $pointfdb->point;

    //Adds old and new added point to score into variable.
    $totalpoint = $newpoint + $oldpoint;

    //Inserts data into MongoDB poke_users
    if(isset($totalpoint)) {
      $insertPoint = $db->poke_users->updateOne([
        'user' => $_SESSION['username']
      ],
      [ 
            '$set' =>
            [ 
                'point' => $totalpoint
            ]
      ]
      );
    }
?>

<html>
    <head>
        <title>Pokemon Test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="poke_result.css" rel="stylesheet">
        <link href="poke_static.css" rel="stylesheet">
    </head>
    <body>

    <legend class="pktitle">Pokemon Result</legend>
    <h1 class ="result_text"><?php echo $answer; ?><br>It's <?php echo $pname ?>!</h1>
    
    <div id="pokemon_image">
        <img src="<?php include 'poke_image.php';?>" class="pokemon_image">
    </div>
    <div id="invbadge">
        <img src="<?php include 'poke_badge_back.php';?>" class ="invbadge">
    </div>          
    <div id="badge">
        <img src="<?php include 'poke_badge_match.php';?>" class ="badge">
    </div>
    <div class="buttons">
        <img src="images/ball/mvball.gif" alt="ball">
        <input type="button" value="Next Question" onclick="window.location.href = 'poke_test.php';" class="button"/>
    </div>
            <div id="orientation_warning">
                <label class="orientmessage">If Playing on Mobile Device, please Rotate for best Viewing</label>
            </div>
</body>
</html>
