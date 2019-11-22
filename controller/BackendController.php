<?php

namespace blog\controller;


class BackendController
{

    public function accountCreate(){
        require('view/createAccountView.php');
    }

    public function login(){
        require('view/loginView.php');
    }

    public function admin(){
        require('view/adminView.php');
    }
}