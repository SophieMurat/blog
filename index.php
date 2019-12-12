<?php
session_start();
//var_dump($_SESSION['user_name']);

use blog\controller\Routeur;

require ('controller/Routeur.php');

$routeur = new Routeur();
$routeur->routerRequete();

