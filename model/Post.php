<?php

namespace projet\blog\model;
require_once("model/Entity.php");

class Post extends Entity
{
    private $id;
    private $title;
    private $post_date;
    private $content;
    private $user_id;
    private $author;
    private $post_date_fr;

    /*public function __construct()
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
    }*/

    // liste des getters

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getPost_date(){
        return $this->post_date;
    }
    public function getContent(){
        return $this->content;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getPost_date_fr(){
        return $this->post_date_fr;
    }

    // liste de setters

    public function setId($id)
    {
        $id =(int) $id;
        if($id>0)
        {
            $this->id=$id;
        }
    }
    public function setTitle($title){
        if(is_string($title)){
            $this->title=$title;
        }
    }
    public function setPost_date($post_date){
        $this->post_date=$post_date;
    }
    public function setContent($content){
        if(is_string($content)){
            $this->content=$content;
        }
    }
    public function setUser_id($_user_id){
        $this->user_id=$user_id;
    }
    /*public function setAuthor($author){
        $this->_author;
    }
    public function setPost_date_fr($post_date_fr){
        $this->_post_date_fr;
    }*/
}