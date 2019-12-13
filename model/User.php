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

    /*public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Hydratation of the setters
     *
     * @param array $data
     */
    /*public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
                
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
            // On appelle le setter.
            $this->$method($value);
            }
        }

        /*if(isset($data['id']))
        {
            $this->setId($data['id']);
        }
        if(isset($data['user_name']))
        {
            $this->setUserName($data['user_name']);
        }
        if(isset($data['password']))
        {
            $this->setPassword($data['password']);
        }
        if(isset($data['role']))
        {
            $this->setRole($data['role']);
        }
        if(isset($data['login']))
        {
            $this->setLogin($data['login']);
        }
    }*/

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
