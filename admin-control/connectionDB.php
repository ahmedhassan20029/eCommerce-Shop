<?php
    $dns = 'mysql:host=localhost;dbname=shop';
    $user = 'root';
    $password = '';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    try {
        $con = new PDO($dns, $user, $password, $option);
        $con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo 'welcome to database';
    }

    catch(PDOException $e) {
        echo 'failed connation' . $e->getMessage();
    }