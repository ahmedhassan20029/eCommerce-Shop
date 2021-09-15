<?php
//INCLUDE FILE CONNECTION DATABASE
include 'connectionDB.php';
// ROUTES ADMIN_CONTROL
$dir_layout_admin = 'layout_admin/'; 
// ROUTES THEME WEBSITE
$dir_templates = 'includes_admin/templates/'; //TEMPLATES DIRECTORY
$dir_css = 'layout_admin/css/'; // CSS DIRECTORY
$dir_js = 'layout_admin/js/'; // JS DIRECTORY
$dir_lib_css = 'includes_admin/libraries/lib_css/'; // DIRECTORY LIBRARIES CSS
$dir_lib_js = 'includes_admin/libraries/lib_js/'; // DIRECTORY LIBRARIES JS
$dir_lang = 'includes_admin/languages/'; // DIRECTORY FILE LANGUAGES
$dir_func = 'includes_admin/functions/';
// important include file
include $dir_func . 'function.php';
include $dir_lang . 'english.php';
include $dir_templates . 'header.php';
if(!isset($noInclude)) {include $dir_templates . 'navbar.php';}