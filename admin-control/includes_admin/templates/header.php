<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php gettitle()?></title>
        <link rel='stylesheet' href='<?php echo $dir_lib_css ?>flaticon/flaticon.css' />
        <link rel='stylesheet' href='<?php echo $dir_lib_css ?>bootstrap.min.css' />
        <link rel='stylesheet' href='<?php echo $dir_assets ?>/db_style.css' />
        <?php if(isset($dashboard_style)) {echo "<link rel='stylesheet' href='$dir_assets/dashboard_style.css' />";}?>
        
        
    </head>
    <body>
        