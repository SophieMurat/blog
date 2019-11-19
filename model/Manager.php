<?php

namespace projet\blog\model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=p4_blog;charset=utf8', 'root', '');
        return $db; // renvoie la connection
    }
}