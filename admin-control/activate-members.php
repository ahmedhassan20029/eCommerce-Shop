<?php
    session_start(); //start session
    $titlePage = 'activate members';
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
            <p>are you shour activate user <?php echo $row['FullName']?></p>
            <a href='activate-members.php?action=activate&userid=<?php echo $row['UserID']?>&action=active' class='btn btn-info'><?php echo lang('activate')?></a>
        </div>
        <?php // open php
            if($_GET['action'] === 'active') {
                // activate user
                $check = ChechItim('UserID', 'users', $_GET['userid']);
                if($check > 0) {
                    $stmt = $con->prepare('UPDATE users SET RegStatus = 1 WHERE UserID = ?');
                    $stmt->execute(array($_GET['userid']));
                } else {
                    echo 'this user is not found';
                }
            }
    }
        include $dir_templates . 'footer.php'; // include footer

    } else { // if not found sesion redirect page 404.php
        include 'includes_admin/functions/function.php';
        $arrormassege = 'error';
        redirect($arrormassege, 5);
    }