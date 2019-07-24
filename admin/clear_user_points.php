<?php
function insert_point($totalpoint){
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->poke;
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

$_SESSION['username'] = 'Zynxeh';
insert_point('0');
?>