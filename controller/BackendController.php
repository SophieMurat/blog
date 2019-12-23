<?php

namespace blog\controller;
use projet\blog\model\UsersManager;
use projet\blog\model\PostsManager;
use projet\blog\model\CommentsManager;
use projet\blog\model\User;
use projet\blog\model\Post;
use projet\blog\model\Comment;
use projet\blog\model\Report;

require_once('model/UsersManager.php');
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');
require_once("model/User.php");
require_once("model/Post.php");
require_once("model/Comment.php");
require_once("model/Report.php");

class BackendController
{
    public $msg= "";
    public $error=false;
    private $postManager;
    private $commentManager;
    private $userManager;

    
    public function __construct(){
        $this->postManager = new PostsManager();
        $this->commentManager = new CommentsManager();
        $this->userManager= new UsersManager();
    }
    /**
     * Create an account
     */
    public function accountCreate(){
        if(isset($_POST['submit'])){
            if (!empty($_POST['name']) && !empty($_POST['login'])
            && !empty($_POST['password']) && !empty($_POST['password_confirmation'])) {
                $user =$this->userManager->login($_POST['login']);
                if($user){
                    $this->error=true;
                    $this->msg='Login déjà utilisé!';
                
                }
                elseif($_POST['password'] !== $_POST['password_confirmation']){
                    $this->error=true;
                    $this->msg='Les mots de passe ne sont pas identiques';
                }
                else{
                    $hash_pwd=password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $newUser = new User(array(
                        'user_name'=>$_POST['name'],
                        'password'=> $hash_pwd, 
                        'login'=>$_POST['login']));
                    $this->userManager->setUser($newUser);
                    header('Location: index.php?action=login');
                }
            }
            else {
                $this->error=true;
                $this->msg='Veuillez remplir tous les champs';
            }
            require('view/createAccountView.php');
        }
        else{
            require('view/createAccountView.php');
        }
    }
    /**
     * Sign in 
     */
    public function login(){
        if(isset($_POST['submit'])){
            if (!empty($_POST['login']) && !empty($_POST['password'])){
                $user =$this->userManager->login($_POST['login']);
                if(!$user){
                    $this->error=true;
                    $this->msg ='Login inconnu veuillez vous inscrire';
                }
                else{
                    $hashChecked=password_verify($_POST['password'],$user->password());
                    if($hashChecked){
                        if ($user->role() == 'admin'){
                            header('Location: index.php?action=admin');
                        }
                        elseif ($user->role() == 'user'){
                            header('Location: index.php');
                        }
                        $_SESSION['login']=$user->login();
                        $_SESSION['id']=$user->id();
                        $_SESSION['user_name']=$user->user_name();
                        $_SESSION['role']=$user->role();
                    }
                    else{
                        $this->error=true;
                        $this->msg ='Mauvais mot de passe';
                    }
                }
                
            }
            else {
                $this->error=true;
                $this->msg='Veuillez remplir tous les champs';
            }
            require('view/loginView.php');
        }
        else{
            require('view/loginView.php');
        }
    }

    public function admin(){
        require('view/adminView.php');
    }
    public function createPost(){
        require('view/createPostView.php');
    }
    /**
     * Disconnect
     * Close the open Session
     */
    public function unplug(){
        session_destroy();
        header('Location: index.php');
    }

    public function listPostsAdmin()
    {
        $posts = $this->postManager->getAllPosts();

        require('view/listPostsAdminView.php');
    }
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
        if (!empty($_POST['title']) && !empty($_POST['content'])){
            $updatedPost= new Post(array(
                'title'=>$_POST['title'],
                'content'=>$_POST['content'],
                'user_id'=>$_SESSION['id'],
                'id'=>$_GET['id']
            ));
            $update=$this->postManager->postUpdate($updatedPost);
            if ($update === false) {
                $post = $this->postManager->getPost($_GET['id']);
                $this->msg='Impossible de modifier l\'article !';
                require('view/updatePostView.php');
            }
            else {
                $this->msg='';
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
        else{
            $this->msg='Veuillez remplir tous les champs!';
            header('Location: index.php?action=postModify&id='. $_GET['id']);
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