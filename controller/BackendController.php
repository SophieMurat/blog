<?php

namespace blog\controller;
use projet\blog\model\UsersManager;
use projet\blog\model\PostsManager;

require_once('model/UsersManager.php');
require_once('model/PostsManager.php');

class BackendController
{
    public $msg= "";
    public $error=false;

    public function accountCreate(){
        if(isset($_POST['submit'])){
            if (!empty($_POST['name']) && !empty($_POST['login'])
            && !empty($_POST['password']) && !empty($_POST['password_confirmation'])) {
                $userManager = new UsersManager();
                $user =$userManager->login($_POST['login']);
                if($_POST['login'] == $user['login']){
                    $this->msg='Login déjà utilisé!';
                
                }
                elseif($_POST['password'] !== $_POST['password_confirmation']){
                    $this->msg='Les mots de passe ne sont pas identiques';
                }
                else{
                    $hash_pwd=password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $newUser = $userManager->setUser($_POST['name'], $hash_pwd, $_POST['login']);
                    //$this->msg='Votre inscription a bien été prise en compte';
                    header('Location: index.php?action=login');
                }
            }
            else {
                $this->msg='Veuillez remplir tous les champs';
            }
            require('view/createAccountView.php');
        }
        else{
            require('view/createAccountView.php');
        }
    }

    public function login(){
        if(isset($_POST['submit'])){
            if (!empty($_POST['login']) && !empty($_POST['password'])){
                $userManager = new UsersManager();
                $user =$userManager->login($_POST['login']);
                $hashChecked=password_verify($_POST['password'],$user['password']);
                if(($_POST['login'] !== $user['login']) || ($hashChecked == false)){
                    $this->error=true;
                    $this->msg ='Au moins l\'un des champs n\'est pas reconnu';
                }
                else{
                    if ($user['role'] == 'admin'){
                        header('Location: index.php?action=admin');
                    }
                    elseif ($user['role'] == 'user'){
                        header('Location: index.php');
                    }
                    $_SESSION['login']=$user['login'];
                    $_SESSION['id']=$user['id'];
                    $_SESSION['name']=$user['user_name'];
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
        $postManager = new PostsManager();
        $posts = $postManager->getAllPosts();

        require('view/listPostsAdminView.php');
    }
    public function postAdmin()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new PostsManager();
            $post = $postManager->getPost($_GET['id']);
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
            $postManager = new PostsManager();
            $post = $postManager->getPost($_GET['id']);
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
            $postManager = new PostsManager();
            $updatedPost= $postManager->postUpdate($_POST['title'],$_POST['content'],$_SESSION['id'],$_GET['id']);
            /*"<pre>";
            var_dump($updatedPost);
            echo "</pre>";
            die();*/
            /*print_r($_GET);
            die();*/
            if ($updatedPost === false) {
                $this->msg='Impossible de modifier l\'article !';
                require('view/updatePostView.php');
            }
            else {
                $this->msg='';
                //require('view/updatePostView.php');
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
            $postManager = new PostsManager();
            $post = $postManager->postDelete($_GET['id']);
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
}