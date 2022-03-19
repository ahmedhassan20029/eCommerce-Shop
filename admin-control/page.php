<?php
    session_start();
    if(isset($_SESSION['UserName'])) {
        //incloud file init
        include 'init.php';


        echo ChechItim('UserName', 'users', 'ahmed2021');

       

    }