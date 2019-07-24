<?php

//Error Checks
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Pulls out point from user and saves it to $totalpoint
function pull_point(){
    require 'vendor/autoload.php';
	$client = new MongoDB\Client("mongodb://localhost:27017");
	$db = $client->connections;
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
    return $totalpoint;
}

//find a user that matches the $_SESSION{'username'} and $password
function pull_user($user){
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->poke;
    $result = $db->poke_users->find([
    'user'=>$user,
    ],
    [
        'projection' =>[
            'oid' =>1,
            'user' =>1,
            'point' =>1,
        ],
    ]
);
  return $result;  
}

//insert point for user
function insert_point($r_user){
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->poke;
    $insertPoint = $db->poke_users->updateOne([
        '_id' => new MongoDB\BSON\ObjectID("$r_user"),
      ],
      [ 
            '$set' =>
            [ 
                'point' => '0'
            ]
      ]
    );
}
//Input the username and password for new user and 0 points
function insert_newuser(){
    $result = $db->poke_users->insertOne([
    'user'=>$username, 
    'password'=>$password,
    'point'=>'0'
    ]);
}
//Find user bases on password and username
function pull_admin($username,$password){
    require 'vendor/autoload.php';
	$client = new MongoDB\Client("mongodb://localhost:27017");
	$db = $client->poke;
    $result = $db->poke_admin->findOne([
    'user'=>$username,
    'password'=>$password,
    ]);
    return $result;
}
?>
