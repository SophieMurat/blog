<?php

namespace projet\blog\model;

require_once("model/Manager.php");

class PostsManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT posts.id, posts.title, users.user_name, posts.content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS post_date_fr FROM posts
        INNER JOIN users ON posts.user_id=users.id
        ORDER BY post_date DESC LIMIT 0, 5');
        return $req;
    }
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT posts.id, posts.title, users.user_name, posts.content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\')
        AS post_date_fr 
        FROM posts 
        INNER JOIN users ON posts.user_id=users.id WHERE posts.id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $post = $req->fetch();// recupére chaque ligne de la requête donc ici les posts

        return $post;
    }
    /**
     * Create a post from admin
     * @param [string] $title
     * @param [string] $content
     */
    public function createPost($title,$content){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, post_date, content, user_id) 
        VALUES(?, NOW(), ?,"1")');
        $req->execute(array($title,$content));
    }
}