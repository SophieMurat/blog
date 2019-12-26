<?php

namespace blog\controller;

use projet\blog\model\PostsManager;
use projet\blog\model\CommentsManager;
use projet\blog\model\UsersManager;
use projet\blog\model\Post;
use projet\blog\model\Comment;
use projet\blog\model\Report;
use projet\blog\model\User;
// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/CommentsManager.php');
require_once('model/UsersManager.php');
require_once("model/Post.php");
require_once("model/Comment.php");
require_once("model/Report.php");
require_once("model/User.php");

class FrontendController
{
    public $msg= "";
    public $msgReport= "";
    public $error=false;
    public $errorReport=false;
    private $postManager;
    private $commentManager;
    private $userManager;

    public function __construct(){
        $this->postManager = new PostsManager();
        $this->commentManager = new CommentsManager();
        $this->userManager= new UsersManager();
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
        $pages = ceil($count /$perPage);
        if ($currentPage > $pages){
            throw new \Exception('Cette page n\'existe pas');
        }
        $posts = $this->postManager->getPosts($start,$perPage);

        require('view/listPostsView.php');
    }
    /**
     * Get one post with its comments
     */
    public function post()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $post = $this->postManager->getPost($_GET['id']);
            $comments=$this->commentManager->getComments($_GET['id']);
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
     * Add a comment to a post when a user is connected
     */
    public function addComment(){
        if (!empty($_POST['comment_content'])&& isset($_SESSION['login'])&& strlen(trim($_POST['comment_content']))>0){
            $commentCreate= new Comment(array(
                'post_id'=>$_GET['id'],
                'user_id'=>$_SESSION['id'],
                'comment'=>$_POST['comment_content']
            ));
            $newComment=$this->commentManager->createComment($commentCreate);
            if ($newComment === false) {
                $this->error=true;
                $this->msg='Impossible d\'ajouter le commentaire !';
            }
            else{
                $this->error=true;
                $this->msg='Votre commentaire a bien été ajouté !';
            }
        }
        elseif ((empty($_POST['comment_content'])&& isset($_SESSION['login'])) || ((strlen(trim($_POST['comment_content']))==0) && isset($_SESSION['login']))){
            $this->error=true;
            $this->msg='Veuillez remplir le commentaire';
        }
        else{
            $this->error=true;
            $this->msg='Veuillez vous inscrire ou vous connecter pour ajouter un commentaire';    
        }
        $this->post();
    }
    /**
     * Report a comment when the button is clicked
     */
    public function reportComment(){
        if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_SESSION['login'])){
            $commentReported = $this->commentManager->getReporting($_SESSION['id'],$_GET['commentId']);
            if($commentReported!== false){
                $this->errorReport=true;
                $this->msgReport="Vous avez déjà signalé ce commentaire";
                $this->post();
            }
            else{
                $report= new Report(array(
                    'comment_id'=>$_GET['commentId'],
                    'userId_reporter'=>$_SESSION['id']
                ));
                $reportedComment=$this->commentManager->reportComment($report);
                $this->errorReport=true;
                $this->msgReport="Le commentaire a bien été signalé";
                $this->post();
            }
        }
        else{
            $this->errorReport=true;
            $this->msgReport="Vous ne pouvez pas signaler de commentaire si vous n'êtes pas inscrits ou connectés";
            $this->post();
        }

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
    /**
     * Disconnect
     * Close the open Session
     */
    public function unplug(){
        session_destroy();
        header('Location: index.php');
    }
    public function error(){
        $this->msg= 'Accès refusé!';
        require('view/errorView.php');
    }
}

