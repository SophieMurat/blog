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
        $comments->debugDumpParams();
        die();

        return $affectedLines; 
    }
}