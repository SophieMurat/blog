<?php

namespace projet\blog\model;

require_once("model/Manager.php");
require_once("model/User.php");

class UsersManager extends Manager
{
    public function setUser(User $user){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(user_name, password, role, login) 
        VALUES(?, ?, "user", ?)');
        $req->execute(array($user->user_name(), $user->password(), $user->login()));// booleen donc peut pas faire fetch
        /*$req->debugDumpParams();
        die();*/
    }

    public function login($login){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id,user_name,password,role, login FROM users 
        WHERE login=? ');
        $req->execute(array($login));
        $userData=$req->fetch(\PDO::FETCH_ASSOC);
        
        if (!$userData){
            return false;
        }
        else
        {
            return new User($userData);
        }
    }
}