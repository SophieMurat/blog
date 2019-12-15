<?php

namespace projet\blog\model;

require_once("model/Manager.php");
require_once("model/Comment.php");
require_once("model/Report.php");

class CommentsManager extends Manager{
    /**
     * Create a comment on a post
     * @param [int] $postId
     * @param [string] $comment
     * @param [int] $userId
     */
    public function createComment(Comment $comment){
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, comment, comment_date) 
        VALUES(?, ?, ?, NOW())');
        //var_dump($comment);
        $affectedLines = $comments->execute(array($comment->getPost_id(), $comment->getUser_id(), $comment->getComment()));
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
        $req = $db->prepare('SELECT comments.id,comments.comment, users.login AS author, comments.post_id,
        DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments 
        INNER JOIN users ON comments.user_id=users.id
        INNER JOIN posts ON comments.post_id=posts.id
        WHERE comments.post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
        'projet\blog\model\Comment');
        $comments=$req->fetchAll();
        return $comments;
    }
    /**
     * Function to report comment
     */
    public function reportComment(Report $report){
        $db = $this->dbConnect();
        $req=$db->prepare('INSERT INTO reportings (comment_id,userId_reporter)
        VALUES (?,?)');
        $affectedLines=$req->execute(array($report->getComment_id(),$report->getUserId_reporter()));
        return $affectedLines;
    }
    /*public function reportComment($commentId){
        $db = $this->dbConnect();
        $req=$db->prepare('UPDATE comments SET report= report+1 WHERE id=?');
        $req->execute(array($commentId));
        $req->debugDumpParams();
        die();
    }*/
    /**
     * Get all the reported comments
     */
    public function getReportedComments(){
        $db = $this->dbConnect();
        $req=$db->query('SELECT COUNT(comments.id) AS nbr_comments,comments.id, comments.comment, 
        users.user_name AS author, comments.post_id, posts.title AS post_title, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS comment_date_fr FROM comments 
        INNER JOIN users ON comments.user_id=users.id 
        INNER JOIN posts ON comments.post_id=posts.id 
        INNER JOIN reportings ON comments.id=reportings.comment_id 
        GROUP BY comments.id ORDER BY nbr_comments DESC');
        /*$req->debugDumpParams();
        die();*/
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
        'projet\blog\model\Comment');
        return $req;
        //var_dump($reportedComments);
    }
    
    /**
     * Get one reporting
     */
    public function getReporting($userId,$commentId){
        $db = $this->dbConnect();
        $req=$db->prepare('SELECT comment_id, userId_reporter FROM reportings
        WHERE userId_reporter=? AND comment_id=?');
        //var_dump($req);
        $req->execute(array($userId,$commentId));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 
        'projet\blog\model\Report');
        /*$req->debugDumpParams();
        die();*/
        $comment=$req->fetch();
        return $comment;
    }
    /**
     * Delete a comment
     */
    public function deleteComment(Comment $comment){
        $db = $this->dbConnect();
        $req=$db->prepare('DELETE comments,reportings FROM comments 
        INNER JOIN reportings
        ON comments.id=reportings.comment_id
        WHERE comments.id=?');
        $deleteComment=$req->execute(array($comment->getId()));
        return $deleteComment;
    }

    /**
     * Delete a comment from reportings table when the report as been reset
     */
    public function deleteReport(Report $report){
        $db=$this->dbConnect();
        $req=$db->prepare('DELETE FROM reportings WHERE
        comment_id=?');
        $deletedReport=$req->execute(array($report->getComment_id()));
        return $deletedReport;
    }
}