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
            'edit_profile'      => 'edit profile',
            'manger_members'    => 'manger members',
            '#id'               => '#id',
            'control'           => 'control',
            'edit'              => 'edit',
            'delete'            => 'delete',
            'registerd_date'    => 'registerd date',
            // page edite profie
            'full_name'         => 'full name',
            'user_name'         => 'user name',
            'email'             => 'email',
            'password'          => 'password',
            'phone'             => 'phone',
            // page add new member
            'add_new_member'    => 'add new member',
            // page activate
            'activate'    => 'activate',
        );
        return $lang[$phrase];
    }