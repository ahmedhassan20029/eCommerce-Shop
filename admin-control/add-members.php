<?php
// this page add new members
session_start(); // start sestion

//create var $titlepage 
    $titlePage = 'Add Members';

//check session found
//check get action = add
if(isset($_SESSION['UserName']) && $_GET['action'] == 'add') {

    //incloud file init
    include 'init.php';

?> <!-- close code php -->

<!-- // start code html --->
    <div class='add_members'>
        <h1><?php echo lang('add_new_member')?></h1>
        <form action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
            <div class='mb-3'>
                <label class='form-label'><?php echo lang('full_name')?></label>
                <input type='text' class='form-control' name='full-name' autocomplete='off' />
                
                <?php
                    //var error inbut 
                    $error_input = array();
                    // check input not empty
                    if(empty($_POST['full-name'])) {
                        $error_input[] = 'the full name is empty';
                    }
                ?>
            </div>
             <div class='mb-3'>
                <label class='form-label'><?php echo lang('user_name')?></label>
                <input type='text' class='form-control' name='user-name' autocomplete='off'/>
                <?php
                    //var error inbut 
                    $error_input = array();
                    // check input not empty
                    if(empty($_POST['user-name'])) {
                        $error_input[] = 'the user name is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'><?php echo lang('email')?></label>
                <input type='email' class='form-control' name='email' autocomplete='off'/>
                <?php
                    // check input not empty
                    if(empty($_POST['email'])) {
                        $error_input[] = 'the email is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'><?php echo lang('password')?></label>
                <input type='password' class='form-control' name='password' autocomplete='new-password' />
                <?php
                    //var error inbut 
                    $error_input = array();
                    // check input not empty
                    if(empty($_POST['password'])) {
                        $error_input[] = 'the password is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'><?php echo lang('phone')?></label>
                <input type='tel' class='form-control' name='phone' autocomplete='off'/>
                <?php
                    // check input not empty
                    if(empty($_POST['phone'])) {
                        $error_input[] = 'the phone is empty';
                    }
                ?>
            </div>
            <div class=''>
                <input type='submit' class='btn btn-primary' value='add member' />
            </div>
        </form>
    </div>
<!-- close code html -->

<?php // open code php

    

    // check send information by method post and run loop if input empty
    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($error_input)) {
        foreach($error_input as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }

    }

    

    if(empty($error_input)) {
        $check = ChechItim('UserName','users', $_POST['user-name']);
        if($check == 1) {
            echo 'this is user name exit pilese chenging';
        } else {
            $stmt = $con->prepare("INSERT INTO
                                users(UserName, Password, Email, FullName, Phone, RegStatus)
                                VALUES(:zuser, :zpass, :zmail, :zname, :zphone, 1)");
                                $stmt->execute(array(
                                'zuser'     => $_POST['user-name'],
                                'zpass'     => sha1($_POST['password']),
                                'zmail'     => $_POST['email'],
                                'zname'     => $_POST['full-name'],
                                'zphone'    => $_POST['phone']
                                
                                ));
            $theMessage = 'done insert';
            redirect($theMessage, 'back');
        }
    } 

// <!--end code form insert data-->

    //include file footer
    include $dir_templates . 'footer.php';
    
} else { // if not found sesion redirect page 404.php

    include 'includes_admin/functions/function.php';
        $theMessage = 'error';
        redirect($theMessage);

}