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
            $users = $userManager->setUser($_POST['name'], $_POST['password'], $_POST['login']);
            //$this->msg='Votre inscription a bien été prise en compte';
            header('Location: index.php?action=login');
        }
        else {
            $this->error=true;
            $this->msg='Veuillez remplir tous les champs';
        }
        require('view/createAccountView.php');
    }

    public function login(){
        if (!empty($_POST['login']) && !empty($_POST['password'])){
            $userManager = new UsersManager();
            $user =$userManager->login($_POST['login']);
            if(($_POST['login'] !== $user['login']) || 
            ($_POST['password'] !== $user['password'] )){
                $error=true;
                $this->msg ='Au moins l\'un des champs n\'est pas reconnu';
            }
            else{
                if ($user['role'] == 'admin'){
                    header('Location: index.php?action=admin');
                }
                elseif ($user['role'] == 'user'){
                    header('Location: index.php');
                }
            }
        }
        else {
            $this->error=true;
            $this->msg='Veuillez remplir tous les champs';
        }
        require('view/loginView.php');
    }

    public function admin(){
        require('view/adminView.php');
    }
}