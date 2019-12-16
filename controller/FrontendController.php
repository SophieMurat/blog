<?php

namespace blog\controller;

use projet\blog\model\PostsManager;
use projet\blog\model\CommentsManager;
use projet\blog\model\Post;
use projet\blog\model\Comment;
use projet\blog\model\Report;
// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');
require_once("model/Post.php");
require_once("model/Comment.php");
require_once("model/Report.php");

class FrontendController
{
    public $msg= "";
    private $postManager;
    private $commentManager;

    public function __construct(){
        $this->postManager = new PostsManager();
        $this->commentManager = new CommentsManager();
    }

    /**
     * Get all the 5 last posts per page
     */
    public function listPosts()
    {
        $count = $this->postManager->countPost();
        $currentPage=(int)($_GET['page'] ?? 1);
        if($currentPage <= 0) {
            throw new \Exception('Numéro de page invalide');
        }
        $perPage= 5;
        $start =$perPage*($currentPage-1);
        //$end=$currentPage*$perPage;
        $pages = ceil($count /$perPage);
        if ($currentPage > $pages){
            throw new \Exception('Cette page n\'existe pas');
        }
        $posts = $this->postManager->getPosts($start,$perPage);
        //var_dump($posts);

        require('view/listPostsView.php');
    }
    public function post()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = $this->postManager->getPost($_GET['id']);
            $comments=$this->commentManager->getComments($_GET['id']);
            //var_dump($comments);
            if($post === false || $comments === false){
                header("HTTP:1.0 404 Not Found");
                header('Location:index.php');
            }
            else{
                require('view/postView.php');
            }
        }
        else {
            $this->msg='Aucun identifiant de billet envoyé';
            require('view/errorView.php');
        }    
    }
    /**
     * Add a post to listpostAdmin
     */
    public function addPostAdmin(){
        if (!empty($_POST['title']) && !empty($_POST['content'])){
            $newPost= new Post(array(
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>$_SESSION['id']));
            $created=$this->postManager->createPost($newPost);
            //var_dump($newPost);
            if ($created === false) {
                $this->msg='Impossible d\'ajouter l\'article !';
                require('view/createPostView.php');
            }
            else {
                $this->msg='';
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
        else{
            $this->msg='Veuillez remplir le titre et le contenu de l\'article';
            require('view/createPostView.php');
        }
    }
    /**
     * Add a comment to a post when a user is connected
     */
    public function addComment(){
        if (!empty($_POST['comment_content'])&& isset($_SESSION['login'])){
            $commentCreate= new Comment(array(
                'post_id'=>$_GET['id'],
                'user_id'=>$_SESSION['id'],
                'comment'=>$_POST['comment_content']
            ));
            $newComment=$this->commentManager->createComment($commentCreate);
            if ($newComment === false) {
                $this->msg='Impossible d\'ajouter le commentaire !';
                $this->post();
            }
            else{
                $this->msg='';
                header('Location: index.php?action=post&id=' . $_GET['id']);
            }
        }
        else{
            $this->msg='Veuillez vous inscrire ou vous connecter pour ajouter un commentaire';
                //header('Location: index.php?action=post&id=' . $_GET['id']);
            $this->post();
        }
    }
    /**
     * Report a comment when the button is clicked
     */
    public function reportComment(){
        if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_SESSION['login'])){
            $commentReported = $this->commentManager->getReporting($_SESSION['id'],$_GET['commentId']);
            //var_dump($reportedStatus['userId_reporter']);
            var_dump($commentReported);
            var_dump($_SESSION);
            //var_dump($_GET);
            if($commentReported!== false){
                //$reportedStatus=$commentManager->reportedStatus($_GET['commentId'],$_SESSION['id']);
                $this->msg="Vous avez déjà signalé ce commentaire";
                $this->post();
            }
            else{
                $report= new Report(array(
                    'comment_id'=>$_GET['commentId'],
                    'userId_reporter'=>$_SESSION['id']
                ));
                $reportedComment=$this->commentManager->reportComment($report);
                //$reportedStatus=$this->commentManager->reportedStatus($_GET['commentId'],$_SESSION['id']);
                $this->msg="Le commentaire a bien été signalé";
                $this->post();
            }
            //require('view/postView.php');
            //header('Location: index.php?action=post&id=' . $_GET['id']);
        }
        else{
            $this->msg="Vous ne pouvez pas signaler de commentaire si vous n'êtes pas inscrits ou connectés";
            $this->post();
        }

    }
}

