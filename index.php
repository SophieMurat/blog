<?php
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action'])){
        if ($_GET['action']== 'lisPosts'){
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e){
    echo 'Erreur:' .$e->getMessage();
}