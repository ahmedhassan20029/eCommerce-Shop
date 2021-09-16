<?php
    session_start();
    //create var $titlepage 
    $titlePage = 'members';

    // start chick sission
    if(isset($_SESSION['UserName'])) {

        // include file init
        include 'init.php';
        
        // start page manage
        if(($_GET['action']) == 'manage') {
?><!--close code php-->

        <!-- start code html -->
        <!-- redirect page edite profile -->
            <div class='section_manger'>
                <a href='edite-profile.php?action=edite&userid=<?php echo $_SESSION['ID'] ?>'><?php echo lang('edite_profile')?></a>
                <br>
                <a href='add-members.php?action=add'><?php echo lang('add-new-member')?></a>
            </div>
            <!--end code html-->

<?php // opine code php

        } else {

            header('location: 404.php');

        }
        // include footer
        include $dir_templates . 'footer.php';
    // if not found session riderect page 404 
    } else {
        header('location: 404.php');
    }