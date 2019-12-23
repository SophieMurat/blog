<?php

namespace projet\blog\model;
require_once("model/Entity.php");

class User extends Entity
{
    private $_id;
    private $_user_name;
    private $_password;
    private $_role;
    private $_login;

    // Liste des getters

    public function id(){
        return $this->_id;
    }
    public function user_name(){
        return $this->_user_name;
    }
    public function login(){
        return $this->_login;
    }
    public function password(){
        return $this->_password;
    }
    public function role(){
        return $this->_role;
    }
    // Liste des setters

    public function setId($id)
    {
        $id = (int) $id;
        if($id>0)
        {
            $this->_id =$id;
        }
    }
    public function setUser_name($userName)
    {
        if(is_string($userName)){
            $this->_user_name=$userName;
        }
    }
    public function setLogin($login)
    {
        if(is_string($login)){
            $this->_login=$login;
        }
    }
    public function setPassword($password){
        if(is_string($password)){
            $this->_password=$password;
        }
    }
    public function setRole($role)
    {
        if(is_string($role)){
            $this->_role=$role;
        }
    }
}
