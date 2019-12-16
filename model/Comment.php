<?php

namespace projet\blog\model;
require_once("model/Entity.php");

class Comment extends Entity
{
    private $id;
    private $comment;
    private $comment_date;
    private $user_id;
    private $post_id;
    private $author;
    private $comment_date_fr;
    private $nbr_comments;
    private $post_title;


    // Liste des getters

    public function getId(){
        return $this->id;
    }
    public function getComment(){
        return $this->comment;
    }
    public function getComment_date(){
        return $this->comment_date;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function getPost_id(){
        return $this->post_id;
    }
    public function getAuthor(){
        return $this->author;
    }
    public function getComment_date_fr(){
        return $this->comment_date_fr;
    }
    public function getNbr_comments(){
        return $this->nbr_comments;
    }
    public function getPost_title(){
        return $this->post_title;
    }

    // liste des setters

    public function setId($id){
        $id=(int) $id;
        if($id>0)
        {
            $this->id=$id;
        }
    }
    public function setComment($comment){
        if(is_string($comment)){
            $this->comment=$comment;
        }
    }
    public function setComment_date($comment_date){
        $this->comment_date=$comment_date;
    }
    public function setUser_id($user_id){
        $user_id=(int) $user_id;
        if($user_id>0){
            $this->user_id=$user_id;
        }    
    }
    public function setPost_id($post_id){
        $post_id=(int) $post_id;
        if($post_id>0){
            $this->post_id=$post_id;
        }    
    }
    public function setAuthor($author){
        if(is_string($author)){
            $this->author=$author;
        }
    }
    public function setComment_date_fr($comment_date_fr){
        $this->comment_date_fr=$comment_date_fr;
    }
}