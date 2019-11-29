<?php

namespace blog\controller;

use projet\blog\model\PostsManager;
use projet\blog\model\UsersManager;
// Chargement des classes
require_once('model/PostsManager.php');
require_once('model/UsersManager.php');

class FrontendController
{
    public $msg= "";

    public function listPosts()
    {
        $postManager = new PostsManager();
        $posts = $postManager->getPosts();
        //var_dump($posts);

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
     * Add a post to home page
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
                header('Location: index.php?action=listPosts');
            }
        }
    }
}

