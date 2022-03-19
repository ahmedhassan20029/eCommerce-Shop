<?php
    session_start(); // start session
    //create var $titlepage 
    $dashboard_style = 'dashboard'; // for incloud file name dashboard-stele.css
    $titlePage = 'dashboard';
    if(isset($_SESSION['UserName'])) {
      // fille include
      include 'init.php';
      $latest = getlatest('UserName', 'users', 'UserID', 5);
    // start include footer
      include $dir_html . 'dashboard.php';
      include $dir_templates . 'footer.php';

    } else {
        include 'includes_admin/functions/function.php';
        $arrormassege = 'error';
        redirect($arrormassege, 5);
    }