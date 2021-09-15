<?php

    function lang($phrase) {
        static $lang = array(
            // dashboard page
            'welcome'           => 'welcome back',
            'manage_profile'    => 'manage profile',
            'settings'          => 'settings',
            'logout'            => 'logout',
            'dashboard'         => 'dashboard',
            'categories'        => 'categories',
            // page memers
            'edite_profile'     => 'edite profile', 
            // page edite profie
            'full-name'         => 'full name',
            'user_name'         => 'user name',
            'email'             => 'email',
            'password'          => 'password',
            'phone'             => 'phone',
            // page add new member
            'add-new-member' => 'add new member',
        );
        return $lang[$phrase];
    }