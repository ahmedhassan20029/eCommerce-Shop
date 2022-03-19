<?php
    session_start(); //start session
    $titlePage = 'delete members';
    // start chick sission
    if(isset($_SESSION['UserName'])) {
         // include file init
        include 'init.php';
        // connaction database
        $stmt = $con->prepare('SELECT * FROM users WHERE UserID = ? LIMIT 1');
        $stmt->execute(array($_GET['userid']));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
     
        // check userid and delete user
        if($_GET['userid'] == $row['UserID']) {
        ?> <!--close php-->
        <div class='info-edite'>
            <p>are you shour delete user <?php echo $row['FullName']?></p>
            <a href='delete-members.php?action=delete&userid=<?php echo $row['UserID']?>&action=remove' class='btn btn-danger'><?php echo lang('delete')?></a>
        </div>
        <?php // open php
            if($_GET['action'] === 'remove') {
                // delete user
                $stmt = $con->prepare('DELETE FROM users WHERE UserID = :zuser');
                $stmt->bindParam(':zuser', $_GET['userid']);
                $stmt->execute();
            }
    }
        include $dir_templates . 'footer.php'; // include footer

    } else { // if not found sesion redirect page 404.php
        include 'includes_admin/functions/function.php';
        $arrormassege = 'error';
        redirect($arrormassege, 5);
    }