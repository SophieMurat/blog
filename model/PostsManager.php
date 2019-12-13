<?php

namespace projet\blog\model;

require_once("model/Manager.php");
require_once("model/Post.php");


class PostsManager extends Manager
{
    /**
     * Catch the 5 last posts by page
     */
    public function getPosts($start,$perPage) {
        $db = $this->dbConnect();
        $req = $db->query("SELECT posts.id, posts.title, users.user_name AS author, posts.content, 
        DATE_FORMAT(post_date, '%d/%m/%Y à %Hh%imin%ss') AS post_date_fr FROM posts
        INNER JOIN users ON posts.user_id=users.id
        ORDER BY post_date DESC LIMIT $start,$perPage");
                
        /*$req->execute([
            'start' => $start,
            'perPage' => $perPage
        ]);*/
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'projet\blog\model\Post');
        //var_dump($req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'projet\blog\model\Post'));
        $posts=$req->fetchAll();
        /*var_dump($req);
        var_dump($posts);*/
    
        return $posts;
    }
    
    /**
     * get the count of posts
     */
    public function countPost(){
        $db = $this->dbConnect();
        $count=(int)$db->query('SELECT COUNT(id) FROM posts')->fetch()[0];
        return $count;
    }
    /**
     * Get all posts
     */
    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT posts.id, posts.title, users.user_name, posts.content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS post_date_fr FROM posts
        INNER JOIN users ON posts.user_id=users.id
        ORDER BY post_date DESC');
        return $req;
    }
    /**
     * Get one post
     * @param [int] $postId
     */
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
     *  Get one post in admin part
     * @param [int] $postId
     */
    public function getPostAdmin($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\')
        AS post_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $post = $req->fetch();// recupére chaque ligne de la requête donc ici les posts

        return $post;
    }
    /**
     * Create a post from admin
     * @param [string] $title
     * @param [string] $content
     * @param [int] $idUser
     */
    public function createPost($title,$content,$idUser){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, post_date, content, user_id) 
        VALUES(?, NOW(), ?,?)');
        $createdPost=$req->execute(array($title,$content,$idUser));
        return $createdPost;
    }
    /**
     * Update a post from admin
     * @param [string] $title
     * @param [string] $content
     * @param [int] $idUser
     * @param [int] $postId
     */
    public function postUpdate($title,$content,$idUser,$postId){
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title=?, content=?, user_id=? WHERE id =?');
        $updatedPost=$req->execute(array($title,$content,$idUser,$postId));
        /*$req->debugDumpParams();
        die();*/
        return $updatedPost;
    }
    /**
     * Delete one chosen post
     * @param [int] $postId
     */
    public function postDelete($postId){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id=?');
        $deletedPost = $req->execute(array($postId));
        return $deletedPost;
    }
        
}