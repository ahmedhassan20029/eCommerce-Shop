<?php
    session_start(); // start sation

    $titlePage = 'edite members'; //create var $titlepage.

    // condetion[1] : start check session found run condetion.
    if(isset($_SESSION['UserName'])) {

        include 'init.php';

        // connection database.
        $stmt = $con->prepare('SELECT * FROM users WHERE UserID = ? LIMIT 1');
        $stmt->execute(array($_GET['userid']));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if($_GET['userid'] === $row['UserID']){

        ?> <!--close php-->

        <!--start code html form-->
        <div class='info-edite'>
            <h1>information user</h1>
            <form action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
                <div class='mb-3'>
                    <label class='form-label'><?php echo lang('full_name')?></label>
                    <input type='text' class='form-control' name='full-name' value='<?php echo $row['FullName']?>'>
                </div>
                <div class='mb-3'>
                    <label class='form-label'><?php echo lang('user_name') ?></label>
                    <input type='text' name='username' class='form-control' value='<?php echo $row['UserName']?>' />
                </div>
                <div class='mb-3'>
                    <label class='form-label'><?php echo lang('password') ?></label>
                    <input type='text' name='password' class='form-control' value='' />
                </div>
                <div class='mb-3'>
                    <label class='form-label'><?php echo lang('email') ?></label>
                    <input type='email' name='email' class='form-control' value='<?php echo $row['Email']?>'/>
                </div>
                <div class='mb-3'>
                    <label class='form-label'><?php echo lang('phone') ?></label>
                    <input type='tel' name='tel' class='form-control' value='<?php echo $row['Phone']?>' />
                </div>
                <div class='mb-3'>
                    <input type='submit' value='save' class='btn btn-primary'/>
                </div>
            </form>
        </div>
        <!--end code html form-->

        <?php // start php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stmt = $con->prepare('UPDATE users SET UserName = ?, Password = ?, Email = ?, FullName = ?, Phone = ? WHERE UserID = ?');
                $stmt->execute(array($_POST['username'], $_POST['password'], $_POST['email'], $_POST['full-name'], $_POST['tel'], $_GET['userid']));
            }

        }
        
        include $dir_templates . 'footer.php'; // include footer
    } else { // if not found sesion redirect page 404.php
        include 'includes_admin/functions/function.php';
        $arrormassege = 'error';
        redirect($arrormassege, 5);
    }