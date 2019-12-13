<?php

namespace projet\blog\model;

class Post
{
    private $_id;
    private $_title;
    private $_post_date;
    private $_content;
    private $_user_id;
    /*private $_author;
    private $_post_date_fr;*/

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * Hydratation of the setters
     *
     * @param array $data
     */
    public function hydrate(array $data)
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
    }

    // liste des getters

    public function getId(){
        return $this->_id;
    }
    public function getTitle(){
        return $this->_title;
    }
    public function getPost_date(){
        return $this->_post_date;
    }
    public function getContent(){
        return $this->_content;
    }
    public function getUser_id(){
        return $this->_user_id;
    }
    /*public function getAuthor(){
        return $this->_author;
    }
    public function getPost_date_fr(){
        return $this->_post_date_fr;
    }*/

    // liste de setters

    public function setId($id)
    {
        $id =(int) $id;
        if($id>0)
        {
            $this->_id=$id;
        }
    }
    public function setTitle($title){
        if(is_string($title)){
            $this->_title=$title;
        }
    }
    public function setPost_date($post_date){
        $this->_post_date=$post_date;
    }
    public function setContent($content){
        if(is_string($content)){
            $this->_content=$content;
        }
    }
    public function setUser_id($_user_id){
        $this->_user_id=$user_id;
    }
    /*public function setAuthor($author){
        $this->_author;
    }
    public function setPost_date_fr($post_date_fr){
        $this->_post_date_fr;
    }*/
}