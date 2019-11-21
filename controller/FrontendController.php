<?php

namespace blog\controller;

use projet\blog\model\PostsManager;
// Chargement des classes
require_once('model/PostsManager.php');

class FrontendController
{
    public function listPosts()
    {
        $postManager = new PostsManager();
        $posts = $postManager->getPosts();
        //var_dump($posts);

        require('view/listPostsView.php');
    }
    public function post()
    {
        $postManager = new PostsManager();
        $post = $postManager->getPost($_GET['id']);
        //var_dump($post);

        require('view/postView.php');
    }
}

