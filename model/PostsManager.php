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
        //$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'projet\blog\model\Post');
        //var_dump($req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'projet\blog\model\Post'));
        //$posts=$req->fetchAll();
        /*var_dump($req);
        var_dump($posts);*/
        $posts=$req->fetchAll(\PDO::FETCH_CLASS,'projet\blog\model\Post');
        //var_dump($posts);
        
        /*if (!$posts){
            return false;
        }
        else
        {
            return new Post($posts);
        }*/
    
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
        $req = $db->query('SELECT posts.id, posts.title, users.user_name AS author, posts.content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS post_date_fr FROM posts
        INNER JOIN users ON posts.user_id=users.id
        ORDER BY post_date DESC');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
        'projet\blog\model\Post');
        return $req;
    }
    /**
     * Get one post
     * @param [int] $postId
     */
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT posts.id, posts.title, users.user_name AS author, posts.content, 
        DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%imin%ss\')
        AS post_date_fr 
        FROM posts 
        INNER JOIN users ON posts.user_id=users.id WHERE posts.id = ?');
        $req->execute(array($postId));//execute la requete préparée et la range dans un array
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
        'projet\blog\model\Post');
        $post = $req->fetch( );// recupére chaque ligne de la requête donc ici les posts
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
    public function createPost(Post $post){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, post_date, content, user_id) 
        VALUES(?, NOW(), ?,?)');
        $createdPost=$req->execute(array($post->getTitle(),$post->getContent(),
        $post->getUser_id()));
        return $createdPost;
    }
    /**
     * Update a post from admin
     * @param [string] $title
     * @param [string] $content
     * @param [int] $idUser
     * @param [int] $postId
     */
    public function postUpdate(Post $post){
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title=?, content=?, user_id=? WHERE id =?');
        $updatedPost=$req->execute(array($post->getTitle(),$post->getContent(),$post->getUser_id(),$post->getId()));
        /*$req->debugDumpParams();
        var_dump($updatedPost);*/
        return $updatedPost;
    }
    /**
     * Delete one chosen post
     * @param [int] $postId
     */
    public function postDelete(Post $post){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id=?');
        $deletedPost = $req->execute(array($post->getId()));
        return $deletedPost;
    }
        
}