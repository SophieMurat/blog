<?php

namespace projet\blog\model;

require_once("model/Manager.php");
require_once("model/User.php");

class UsersManager extends Manager
{
    public function setUser(User $user){
        $req = $this->db->prepare('INSERT INTO users(user_name, password, role, login) 
        VALUES(?, ?, "user", ?)');
        $req->execute(array($user->user_name(), $user->password(), $user->login()));// booleen donc peut pas faire fetch
        /*$req->debugDumpParams();
        die();*/
        var_dump($user);
        var_dump($req);
    }

    public function login($login){
        $req = $this->db->prepare('SELECT id,user_name,password,role, login FROM users 
        WHERE login=? ');
        $req->execute(array($login));
        var_dump($req);
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