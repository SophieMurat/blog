<?php

namespace projet\blog\model;

require_once("model/Manager.php");

class PostsManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title,user_name, content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');

        return $req;
    }
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title,user_name, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\')
         AS post_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $post = $req->fetch();// recupére chaque ligne de la requête donc ici les posts

        return $post;
    }
}