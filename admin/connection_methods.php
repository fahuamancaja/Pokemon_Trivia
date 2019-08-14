<?php
//Created a class with subclasses to protect and extend Connections 
class Connections {
    //Variables created for class and subclass
    protected $username;
    protected $password;
    protected $id;
    protected $point;
    
    //function to access database when needed
    protected function root_con() {
        require 'vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $db = $client->poke;
        return $db;
    }
}
//All sub classes that will request or change data
class subConnections extends Connections {
    
    //Every time an instance is created the values will be passed in and assigned to class variables
    public function __construct($args=[]) {
        $this->username = $args['username'] ?? NULL;
        $this->password = $args['password'] ?? NULL;
        $this->id = $args['id'] ?? NULL;
        $this->point = $args['point'] ?? NULL;
    }
    
    //pulls user info from mongo
    public function pull_user(){
        $result = $this->root_con()->poke_users->find([
            'user'=>$this->username,
            ],
            [
                'projection' =>[
                    'oid' =>1,
                    'user' =>1,
                    'point' =>1,
                ],
            ]
        );

        $newArr = array();
        $show_users = "";

        foreach ($result as $info){
            $newArr[$info->user][] = (array)$info;
            $show_users.= implode(" ", (array)$info);
            $show_users.= "</br>";
        }
        return $show_users;
    }
    
    //pulls only the number of points for user
    public function pull_point(){
        $pointfdb = $this->root_con()->poke_users->findOne(
          [
          '_id' => new MongoDB\BSON\ObjectID("$this->id"),
          ],
          [
              'projection' => [
                  'point' => 1,
              ],
          ]
        );
        //Saved points to $totalpoint
        $info = $pointfdb->point;
        return $info;    
    }
    
    //Places point value for specific user
    public function insert_point(){    
        $insertPoint = $this->root_con()->poke_users->updateOne([
            '_id' => new MongoDB\BSON\ObjectID("$this->id"),
          ],
          [ 
                '$set' =>
                [ 
                    'point' => $this->point
                ]
          ]
        );
        return $insertPoint;
    }
    
    //Creates a new user
    public function insert_new_user(){
        $result = $this->root_con()->poke_users->insertOne([
        'user'=>$this->username, 
        'password'=>$this->password,
        'point'=>$this->point,
        ]);
        return $result;
    }
    
    //Removes user completely from the database
    public function delete_user(){
        $result = $this->root_con()->poke_users->findOneAndDelete(
          [
          '_id' => new MongoDB\BSON\ObjectID("$this->id"),
          ],
          [
            'projection' => [
            'user' => 1,
            'password' => 1,
            'point' => 1,
            ],
          ]
        );
        return $result;
    }
    
}
?>