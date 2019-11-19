<?php

// Chargement des classes
require_once('model/PostsManager.php');

function listPosts()
{
    $postManager = new projet\blog\model\PostsManager();
    $posts = $postManager->getPosts();
    //var_dump($posts);

    require('view/listPostsView.php');
}
function post()
{
    $postManager = new projet\blog\model\PostsManager();
    $post = $postManager->getPost($_GET['id']);

    require('view/postView.php');
}