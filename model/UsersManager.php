<?php

namespace projet\blog\model;

require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function setUser($userName, $password, $login){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(user_name, password, role, login) 
        VALUES(?, ?, "user", ?)');
        $req->execute(array($userName, $password, $login));
        /*$req->debugDumpParams();
        die();*/
    }

    public function login($login){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id,user_name,password,role, login FROM users 
        WHERE login=? ');
        $req->execute(array($login));
        $userData=$req->fetch();
        return $userData;
    }


}