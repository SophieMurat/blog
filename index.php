<?php
session_start();

use blog\controller\Routeur;

require ('controller/Routeur.php');

$routeur = new Routeur();
$routeur->routerRequete();
