<?php

namespace projet\blog\model;

require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function setUser($userName, $password, $login){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(user_name, password, role, login) 
        VALUES(?, ?, 0, ?)');
        $req->execute(array($userName, $password, $login));
    }


}