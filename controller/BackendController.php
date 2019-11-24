<?php

namespace blog\controller;
use projet\blog\model\UsersManager;

require_once('model/UsersManager.php');

class BackendController
{
    public $msg= "";
    public $error=false;

    public function accountCreate(){
        if (!empty($_POST['name']) && !empty($_POST['login'])
        && !empty($_POST['password']) && !empty($_POST['password_confirmation'])) {
            $userManager = new UsersManager();
            $users = $userManager->setUser($_POST['name'], $_POST['login'], $_POST['password']);
        }
        else {
            $this->error=true;
            $this->msg='Veuillez remplir tous les champs';
        }
        require('view/createAccountView.php');
    }

    public function login(){
        require('view/loginView.php');
    }

    public function admin(){
        require('view/adminView.php');
    }
}