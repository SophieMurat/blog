<?php

namespace projet\blog\model;

require_once("model/Manager.php");

class CommentsManager extends Manager{
    /**
     * Create a comment on a post
     * @param [int] $postId
     * @param [string] $comment
     * @param [int] $userId
     */
    public function createComment($postId, $userId, $comment){
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, comment, comment_date) 
        VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $userId, $comment));
        /*$comments->debugDumpParams();
        die();*/

        return $affectedLines; 
    }
    /**
     * Gets the comments on a specific post
     * @param [int] $postId
     */
    public function getComments($postId){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT comments.id,comments.comment, users.user_name, comments.post_id,
        DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments 
        INNER JOIN users ON comments.user_id=users.id
        INNER JOIN posts on comments.post_id=posts.id
        WHERE comments.post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        /*$req->debugDumpParams();
        die();*/
        $comments=$req->fetchAll();
        return $comments;
    }
    /**
     * Function to report comment
     */
    public function reportComment($commentId){
        $db = $this->dbConnect();
        $req=$db->prepare('UPDATE comments SET report= report+1 WHERE id=?');
        $req->execute(array($commentId));
        /*$req->debugDumpParams();
        die();*/
    }
}