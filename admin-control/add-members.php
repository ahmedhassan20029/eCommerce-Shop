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
        <h1>add new member</h1>
        <form action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
            <div class='mb-3'>
                <label class='form-label'>full name</label>
                <input type='text' class='form-control' name='full-name'/>
                
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
                <label class='form-label'>user name</label>
                <input type='text' class='form-control' name='user-name'/>
                <?php
                    // check input not empty
                    if(empty($_POST['user-name'])) {
                        $error_input[] = 'the user name is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'>e-mail</label>
                <input type='email' class='form-control' name='email'/>
                <?php
                    // check input not empty
                    if(empty($_POST['email'])) {
                        $error_input[] = 'the email is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'>password</label>
                <input type='password' class='form-control' name='password'/>
                <?php
                    // check input not empty
                    if(empty($_POST['password'])) {
                        $error_input[] = 'the password is empty';
                    }
                ?>
            </div>
            <div class='mb-3'>
                <label class='form-label'>phone</label>
                <input type='tel' class='form-control' name='phone'/>
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

    //include file footer
    include $dir_templates . 'footer.php';
    
// check send information by method post and run loop if input empty
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach($error_input as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
    
}

} else { // if not found sesion redirect page 404.php

    header('location: 404.php');

}