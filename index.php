<?php
session_start();

use blog\controller\FrontendController;
use blog\controller\BackendController;

require('controller/FrontendController.php');
require('controller/BackendController.php');

$FrontendController = new FrontendController();
$BackendController = new BackendController();


if (isset($_GET['action'])){

    if ($_GET['action']== 'listPosts'){
        $FrontendController->listPosts();
    }
    elseif ($_GET['action'] == 'post') {
        $FrontendController->post();
    }
    elseif ($_GET['action'] == 'addPost') {
        $FrontendController->addPostAdmin();
    }
    elseif ($_GET['action'] == 'addComment') {
        $FrontendController->addComment();
    }
    elseif ($_GET['action'] == 'reportComment') {
        $FrontendController->reportComment();
    }
    elseif ($_GET['action'] == 'accountCreate'){
        $BackendController->accountcreate();
    }
    elseif ($_GET['action'] == 'login'){
        $BackendController->login();
    }
    elseif ($_GET['action'] == 'admin'){
        $BackendController->admin();
    }
    elseif ($_GET['action'] == 'unlog'){
        $BackendController->unplug();
    }
    elseif ($_GET['action'] == 'createArticle'){
        $BackendController->createPost(); 
    }
    elseif ($_GET['action'] == 'getAllPostAdmin'){
        $BackendController->listPostsAdmin(); 
    }
    elseif ($_GET['action'] == 'postAdmin'){
        $BackendController->postAdmin(); 
    }
    elseif ($_GET['action'] == 'postModify'){
        $BackendController->modifyPost(); 
    }
    elseif ($_GET['action'] == 'postUpdate'){
        $BackendController->updatePost(); 
    }
    elseif ($_GET['action'] == 'postDelete'){
        $BackendController->deletePost(); 
    }
}
else {
    $FrontendController->listPosts();
}