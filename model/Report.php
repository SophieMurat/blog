<?php

namespace projet\blog\model;
require_once("model/Entity.php");

class Report extends Entity{
    private $id;
    private $comment_id;
    private $userId_reporter;

    // liste des getters

    public function getId(){
        return $this->id;
    }
    public function getComment_id(){
        return $this->comment_id;
    }
    public function getUserId_reporter(){
        return $this->userId_reporter;
    }

    // liste des setters

    public function setId($id)
    {
        $id =(int) $id;
        if($id>0)
        {
            $this->id=$id;
        }
    }
    public function setComment_id($comment_id)
    {
        $comment_id =(int) $comment_id;
        if($comment_id>0)
        {
            $this->comment_id=$comment_id;
        }
    }
    public function setUserId_reporter($userId_reporter)
    {
        $userId_reporter =(int) $userId_reporter;
        if($userId_reporter>0)
        {
            $this->userId_reporter=$userId_reporter;
        }
    }
}