<?php

    session_start(); // start session
    //create var $titlepage 
    $titlePage = 'dashboard';
    if(isset($_SESSION['UserName'])) {
      // fille include
      include 'init.php';
      
      ?>
      
    <?php 
    // start include footer
    include $dir_templates . 'footer.php';

    } else {
        header('location: 404.php');
    }