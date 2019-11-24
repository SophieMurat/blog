<?php

use blog\controller\FrontendController;
use blog\controller\BackendController;

require('controller/FrontendController.php');
require('controller/BackendController.php');

$FrontendController = new FrontendController();
$BackendController = new BackendController();


if (isset($_GET['action'])){

    if ($_GET['action']== 'lisPosts'){
        $FrontendController->listPosts();
    }
    elseif ($_GET['action'] == 'post') {
        $FrontendController->post();
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
}
else {
    $FrontendController->listPosts();
}