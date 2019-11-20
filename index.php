<?php

use blog\controller\FrontendController;

require('controller/FrontendController.php');
require('controller/backend.php');

$FrontendController = new FrontendController();

try {
    if (isset($_GET['action'])){

        if ($_GET['action']== 'lisPosts'){
            $FrontendController->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $FrontendController->post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        $FrontendController->listPosts();
    }
}
catch(Exception $e){
    echo 'Erreur:' .$e->getMessage();
}