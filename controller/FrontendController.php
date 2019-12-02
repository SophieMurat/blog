<?php

namespace blog\controller;

use projet\blog\model\PostsManager;
use projet\blog\model\UsersManager;
use project\blog\model\CommentsManager;
// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/UsersManager.php');
require_once('model/CommentsManager.php');

class FrontendController
{
    public $msg= "";

    /**
     * Get all the 5 last posts per page
     */
    public function listPosts()
    {
        $postManager = new PostsManager();
        $count = $postManager->countPost();
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
        $posts = $postManager->getPosts($start,$perPage);

        require('view/listPostsView.php');
    }
    public function post()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostsManager();
            $post = $postManager->getPost($_GET['id']);
            //var_dump($post);
            if($post === false){
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
            $postManager = new PostsManager();
            $userManager = new UsersManager();
            $newPost= $postManager->createPost($_POST['title'],$_POST['content'],$_SESSION['id']);
            if ($newPost === false) {
                $this->msg='Impossible d\'ajouter l\'article !';
                require('view/createPostView.php');
            }
            else {
                $this->msg='';
                header('Location: index.php?action=getAllPostAdmin');
            }
        }
    }
    /**
     * Add a comment to a post when a user is connected
     */
    public function addComment(){
        if (!empy($_POST['author'])&& !empty($_POST['comment_content'])){
            $commentManager= new CommentsManager();
            $newComment=$commentManager->createComment($_GET['id'], $_SESSION['id'], $_POST['comment_content']);
            if ($newComment === false) {
                $this->msg='Impossible d\'ajouter le commentaire !';
                require('view/postView.php');
            }
            elseif($_POST['author'] !== $user['name']){
                $this->msg= 'Veuillez utiliser le nom de votre compte afin de laisser un commentaire';
                require('view/postView.php');
            }
            else{
                $this->msg='';
                require('view/postView.php');
            }
        }

    }
}

