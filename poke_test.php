<?php
    //Continue session
    session_start();

    //Connect to Database
    require_once('dbconnectpoke.php');

    //Random number created from 1 to 151
    $rand = mt_rand(1,151);

    //Random number is saved into a variable
    $number = "$rand";

    //Pulls out point from user
    $pointfdb = $db->poke_users->findOne(
      [
      'user' => $_SESSION['username']
      ],
      [
          'projection' => [
              'point' => 1,
          ],
      ]
    );
    //Saved points to $totalpoint
    $totalpoint = $pointfdb->point;

	if(!isset($_SESSION['user'])) {
		header('Location: poke_index.php');
	}
?>

<html>
    <head>
	   <title>Pokemon Test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="poke_test.css" rel="stylesheet">  
        <link href="poke_static.css" rel="stylesheet">
    </head>
    <body>
        <form method="post" action="poke_result.php">
        <fieldset>
            <legend class="pktitle">Pokemon Trivia</legend>
            <h1 class="test_text">Who's that Pokemon!</h1>
            <div id="pokemongb">
                <label for="pokemon" class="label">Pokemon: </label><input class="input" type="text" name="pokemon"/><br>
            </div>
            <input type="hidden" name="number" value="<?php echo $number?>">
      
            <div class="buttons">
                <img src="images/ball/mvball.gif" alt="ball">
                <button type="submit" class="button">Button</button>
            </div>
            <div id="pokemon_shadow">
                <img src="<?php include 'poke_image.php';?>" class="pokemon_shadow">
            </div>
            <div id="invbadge">
                <img src="<?php include 'poke_badge_back.php';?>" class ="invbadge">
            </div>          
            <div id="badge">
                <img src="<?php include 'poke_badge_match.php';?>" class ="badge">
            </div>
            <div id="orientation_warning">
                <label class="orientmessage">If Playing on Mobile Device, please Rotate for best Viewing</label>
            </div>
        </fieldset>
        </form>
    </body>
</html>
