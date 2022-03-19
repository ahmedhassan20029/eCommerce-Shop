<?php
    ini_set('display_errors','on');
    error_reporting(E_ALL);
    include "admin-control/connectionDB.php";
    // ROUTES THEME WEBSITE
    $dir_lib_css = 'admin-control/includes_admin/libraries/lib_css/'; // DIRECTORY LIBRARIES CSS
    $dir_lib_js = 'admin-control/includes_admin/libraries/lib_js/'; // DIRECTORY LIBRARIES JS
    $dir_lang = 'admin-control/includes_admin/languages/'; // DIRECTORY FILE LANGUAGES
    $dir_func = 'admin-control/includes_admin/functions/';
    $dir_templates = 'includes_front/templates/';
    $dir_assets = 'front-pages/assets/css';
    $dir_assets_js = 'admin-control/layout_admin/js/';
    // important include file
    include $dir_func . 'function.php';
    include $dir_lang . 'english.php';
    include $dir_templates . 'header.php';
