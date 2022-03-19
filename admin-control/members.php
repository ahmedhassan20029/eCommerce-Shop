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
            // show users pensing
            $quary = '';
            if(isset($_GET['pending']) &&  $_GET['pending'] == 'activate') {
                $quary = 'AND RegStatus = 0';
            }
            // conaction db and show all users
            $stmt = $con->prepare("SELECT * from users WHERE UserID $quary");
            $stmt->execute();
            $rows = $stmt->fetchAll();

?><!--close code php-->

        <!-- start code html -->
        <!-- redirect page edite profile -->
            <div class='section_manger members'>
                <h1 class='text-center'><?php echo lang('manger_members')?></h1>
                <br>
                <a class='btn btn-primary'href='edite-profile.php?action=edite&userid=<?php echo $_SESSION['ID'] ?>'><?php echo lang('edit_profile')?></a>
                <br>
                <a class='btn btn-primary' href='add-members.php?action=add'><?php echo lang('add_new_member')?></a>
                <br>
                <!--table-->
                <div class='table-responsive'>
                    <table class='table table-bordered text-center'>
                        <tr class='thead'>
                            <td><?php echo lang('#id')?></td>
                            <td><?php echo lang('user_name')?></td>
                            <td><?php echo lang('email')?></td>
                            <td><?php echo lang('full_name')?></td>
                            <td><?php echo lang('registerd_date')?></td>
                            <td><?php echo lang('control')?></td>
                        </tr>

                        <!--start code php-->
                        <?php
                            foreach($rows as $row) {
                            ?> <!--close php-->
                            <tr class='data-members'>
                                <td><?php echo $row['UserID']?></td>
                                <td><?php echo $row['UserName']?></td>
                                <td><?php echo $row['Email']?></td>
                                <td><?php echo $row['FullName']?></td>
                                <td><?php echo $row['date']?></td>
                                <td>
                                    <a href='edit-members.php?action=edite&userid=<?php echo $row['UserID']?>' class='btn btn-success'><?php echo lang('edit')?></a>
                                    <a href='delete-members.php?action=delete&userid=<?php echo $row['UserID']?>' class='btn btn-danger'><?php echo lang('delete')?></a>
                                    <?php
                                        if($row['RegStatus'] == 0 ) { ?>
                                           <a href='activate-members.php?action=activate&userid=<?php echo $row['UserID']?>' class='btn btn-info'><?php echo lang('activate')?></a>
                                        <?php
                                        }?>
                                </td>
                            </tr>


                        <!--opin php-->
                        <?php
                            }
                        ?>
                        <!--end code php-->

                    </table>
                </div>
                <!--table-->
            </div>
            <!--end code html-->

<?php // opine code php

        }
        // include footer
        include $dir_templates . 'footer.php';

    // if not found session riderect page 404
    } else {
        include 'includes_admin/functions/function.php';
        $arrormassege = 'error';
        redirect($arrormassege, 10);
        
    }