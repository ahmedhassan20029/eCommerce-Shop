<?php
    // categories = [manage | edit | update | add | insert | delete | status]
    $do = isset($_GET['action']) ? $_GET['action'] : 'manage';

    /*redirect page manage & add & insert .... */
    if ($do == 'manage') {

        echo 'welcome to manage page categories';

    } elseif($do == 'add') {

        echo 'welcome to add page categories';

    } else {

        echo 'error';
        
    }
    