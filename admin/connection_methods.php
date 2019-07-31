<?php
class Connections {
    protected $username;
    protected $password;
    protected $id;
    protected $point;
    
    protected function root_con() {
        require 'vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $db = $client->poke;
        return $db;
    }
}
    
class subConnections extends Connections {
    public function return_user($user){
        $this->username = $user;
    }
    public function return_id($i_user){
        $this->id = $i_user;
    }
    public function return_p($p_point){
        $this->point = $p_point;
    }
    public function return_pwd($pwd){
        $this->point = $pwd;
    }
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
    public function insert_new_user(){
        $result = $this->root_con()->poke_users->insertOne([
        'user'=>$this->username, 
        'password'=>$this->password,
        'point'=>$this->point,
        ]);
        return $result;
    }
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