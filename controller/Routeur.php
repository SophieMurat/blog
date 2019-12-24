<?php

namespace blog\controller;

use blog\controller\FrontendController;
use blog\controller\BackendController;

require_once('controller/FrontendController.php');
require_once('controller/BackendController.php');

class Routeur {

    private $FrontendController;
    private $BackendController;

    public function __construct(){
        $this->FrontendController = new FrontendController();
        $this->BackendController = new BackendController();
    }
    /**
     * Choose the action according to the request
     */
    public function routerRequete(){
        try{
            if (isset($_GET['action'])){    
                if ($_GET['action'] == 'listPosts'){
                    $this->FrontendController->listPosts();
                }
                elseif ($_GET['action'] == 'post') {
                    $this->FrontendController->post();
                }
                elseif ($_GET['action'] == 'addComment') {
                    $this->FrontendController->addComment();
                }
                elseif ($_GET['action'] == 'reportComment') {
                    $this->FrontendController->reportComment();
                }
                elseif ($_GET['action'] == 'accountCreate'){
                    $this->FrontendController->accountcreate();
                }
                elseif ($_GET['action'] == 'login'){
                    $this->FrontendController->login();
                }
                elseif ($_GET['action'] == 'unlog'){
                    $this->FrontendController->unplug();
                }
                elseif(!empty($_SESSION)){
                    if(($_SESSION['role']) == 'admin' && isset($_GET['action'])){
                        if ($_GET['action'] == 'addPost') {
                            $this->BackendController->addPostAdmin();
                        }
                        elseif ($_GET['action'] == 'admin'){
                            $this->BackendController->admin();
                        }
                        elseif ($_GET['action'] == 'resetReport'){
                            $this->BackendController->resetReport(); 
                        }
                        elseif ($_GET['action'] == 'displayChoices'){
                            $this->BackendController->displayChoices(); 
                        }
                        elseif ($_GET['action'] == 'postDelete'){
                            $this->BackendController->deletePost(); 
                        }
                        elseif ($_GET['action'] == 'listReportedComments'){
                            $this->BackendController->listReportedComments(); 
                        }
                        elseif ($_GET['action'] == 'deleteComment'){
                            $this->BackendController->deleteComment(); 
                        }
                        elseif ($_GET['action'] == 'createArticle'){
                            $this->BackendController->createPost(); 
                        }
                        elseif ($_GET['action'] == 'getAllPostAdmin'){
                            $this->BackendController->listPostsAdmin(); 
                        }
                        elseif ($_GET['action'] == 'postAdmin'){
                            $this->BackendController->postAdmin(); 
                        }
                        elseif ($_GET['action'] == 'postModify'){
                            $this->BackendController->modifyPost(); 
                        }
                        elseif ($_GET['action'] == 'postUpdate'){
                            $this->BackendController->updatePost(); 
                        }
                        else{
                            $this->FrontendController->error();
                        }
                    }
                    else{
                        $this->FrontendController->error();
                    }
                }
                else{
                    $this->FrontendController->error();
                }
            }           
            else {
                $this->FrontendController->listPosts();
            }
        }
        catch (Exception $e) {
            erreur($e->getMessage());
          }
    }
}