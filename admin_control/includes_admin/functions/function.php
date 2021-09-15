<?php
 //create var $titlepage
 // create fanction titlepage
 function gettitle() {

    global $titlePage;

   isset($titlePage) ? print_r($titlePage) : print_r('defualte');

 }