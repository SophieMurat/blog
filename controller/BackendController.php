<?php

namespace blog\controller;
use projet\blog\model\PostsManager;
use projet\blog\model\CommentsManager;
use projet\blog\model\Post;
use projet\blog\model\Comment;
use projet\blog\model\Report;

require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');
require_once("model/Post.php");
require_once("model/Comment.php");
require_once("model/Report.php");

class BackendController
{
    public $msg= "";
    public $error=false;
    private $postManager;
    private $commentManager;

    
    public function __construct(){
        $this->postManager = new PostsManager();
        $this->commentManager = new CommentsManager();
    }
    /**
     * Open the admin dashboard 
     */
    public function admin(){
        require('view/adminView.php');
    }
    /**
     * Open the page where we can create a new post
     */
    public function createPost(){
        require('view/createPostView.php');
    }
     /**
     * Add a post to listpostAdmin
     */
    public function addPostAdmin(){
        if (!empty($_POST['title']) && !empty($_POST['content']) && strlen(trim($_POST['title']))){
            $newPost= new Post(array(
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>$_SESSION['id']));
            $created=$this->postManager->createPost($newPost);
            if ($created === false) {
                $this->error=true;
                $this->msg='Impossible d\'ajouter l\'article !';
                require('view/createPostView.php');
            }
            else {
                $this->msg='';
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
        else{
            $this->error=true;
            $this->msg='Veuillez remplir le titre et le contenu de l\'article';
            require('view/createPostView.php');
        }
    }
    /**
     * List all the posts in the admin part
     */
    public function listPostsAdmin()
    {
        $posts = $this->postManager->getAllPosts();

        require('view/listPostsAdminView.php');
    }
    /**
     * Open one single post in the admin part
     */
    public function postAdmin()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = $this->postManager->getPost($_GET['id']);
            if($post === false){
                header("HTTP:1.0 404 Not Found");
                header('Location:index.php?action=admin');
            }
            else{
                require('view/postAdminView.php');
            }
        }
        else {
            $this->msg='Aucun identifiant de billet envoyé';
            require('view/errorView.php');
        }    
    }
    /**
     * Show the post that needs to be modify
     */
    public function modifyPost(){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = $this->postManager->getPost($_GET['id']);
            if($post === false){
                header("HTTP:1.0 404 Not Found");
                header('Location:index.php?action=postAdmin');
            }
            else{
                require('view/updatePostView.php');
            }
        }
        else {
            $this->msg='Aucun identifiant de billet envoyé';
            require('view/errorView.php');
        }   
    }
    /**
     * Update a post
     */
    public function updatePost(){
        if (!empty($_POST['title']) && !empty($_POST['content']) && strlen(trim($_POST['title']))){
            $updatedPost= new Post(array(
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>$_SESSION['id'],
                'id'=>$_GET['id']
            ));
            $update=$this->postManager->postUpdate($updatedPost);
            if ($update === false) {
                $post = $this->postManager->getPost($_GET['id']);
                $this->error= true;
                $this->msg='Impossible de modifier l\'article !';
                require('view/updatePostView.php');
            }
            else {
                $this->msg='';
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
        else{
            $post = $this->postManager->getPost($_GET['id']);
            $this->error= true;
            $this->msg='Veuillez remplir tous les champs!';
            require('view/updatePostView.php');
        }
    }
    /**
     * Delete one chosen post
     */
    public function deletePost(){
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $deletedPost=new Post(array('id'=>$_GET['id']));
            $post = $this->postManager->postDelete($deletedPost);
            if($post === false){
                header("HTTP:1.0 404 Not Found");
                header('Location:index.php?action=getAllPostAdmin');
            }
            else{
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
        else {
            $this->msg='Aucun identifiant de billet envoyé';
            require('view/errorView.php');
        }   
    }
    /**
     * display the list of reported comments
     */
    public function listReportedComments(){
            $reportedComments = $this->commentManager->getReportedComments();
            require('view/listCommentsView.php');
    }
    /**
     * display choices
     */
    public function displayChoices(){
        require('view/listCommentsView.php');
    }
    /**
     * Delete a comment 
     */
    public function deleteComment(){
        $reportedComments = $this->commentManager->getReportedComments();
        $delete=new Comment(array('id'=>$_GET['commentId']));
        $deletedComment=$this->commentManager->deleteComment($delete);
        header('location:index.php?action=listReportedComments');
    }
    /**
     * Reset to 0 the numbers of report on a comment
     */
    public function resetReport(){
        $reportedComments = $this->commentManager->getReportedComments();
        $report= new Report(array('comment_id'=>$_GET['commentId']));
        $deleteReport = $this->commentManager->deleteReport($report);
        header('location:index.php?action=listReportedComments');
    }
}