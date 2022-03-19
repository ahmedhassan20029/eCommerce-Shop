<?php
    session_start(); //start session.
     
    $titlePage = 'edite profile'; //create var $titlepage.

    // condetion[1] : start check session found run condetion.
    // condetion[2] : start check get action found run condetion.
    // condetion[3] : [VALUE] GET ID =  [VALUE] SESSION ID RUN CONDETION.
    if(isset($_SESSION['UserName']) && $_GET['action'] == 'edite'  && $_GET['userid'] === $_SESSION['ID']) {
       
        include 'init.php';  // include file init.
        
        // connection database.
        $stmt = $con->prepare('SELECT * FROM users WHERE UserID = ? LIMIT 1');
        $stmt->execute(array($_SESSION['ID']));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
// close code php. ?>
                <!--fetch information from database to form in dashboard. -->
                <!-- start code html. -->
                <div class='info-edite'>
                    <h1>edite profile</h1>
                    <!-- send information to self page-->
                    <form class='' action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
                        <div class='mb-3'>
                            <label class='form-label'><?php echo lang('full_name')?></label>
                            <input type='text' name='full-name' class='form-control' value='<?php echo $row['FullName']?>' required autocomplete='off' />
                            <!--vilidet by php -->
                            <?php
                                //var array empty arror -->
                                $errors_input = array();
                                if(empty($_POST['full-name'])) {
                                    $errors_input[] = 'the full name is empty';
                                }
                            ?>
                            <!--vilidet by php -->
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'><?php echo lang('user_name') ?></label>
                            <input type='text' name='username' class='form-control' value='<?php echo $row['UserName']?>' required autocomplete='off' />
                            <!--vilidet by php -->
                            <?php
                                if(empty($_POST['username'])) {
                                    $errors_input[] = 'the username is empty';
                                }
                            ?>
                            <!--vilidet by php -->
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'><?php echo lang('email') ?></label>
                            <input type='email' name='email' class='form-control' value='<?php echo $row['Email']?>' required autocomplete='off' />
                            <!--vilidet by php -->
                            <?php
                                if(empty($_POST['email'])) {
                                    $errors_input[] = 'the email is empty';
                                }
                            ?>
                            <!--vilidet by php -->
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'><?php echo lang('password') ?></label>
                            <input type='password' name='password' class='form-control' autocomplete='new-password'/>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'><?php echo lang('phone') ?></label>
                            <input type='tel' name='Phone' class='form-control' value='<?php echo $row['Phone']?>' required />
                            <!--vilidet by php -->
                            <?php
                                if(empty($_POST['Phone'])) {
                                    $errors_input[] = 'the phone is empty';
                                }
                            ?>
                            <!--vilidet by php -->     
                        </div>
                        <div class='mb-3'>
                            <input type='submit' value='save' class='btn btn-primary'/>
                        </div>
                    </form>
                </div>
                <!-- end code html. -->


<?php // opine code php.
        
    } else {
        header('location: 404.php');
    }

    // after send information to self page check the information send by method ['POST']
    if($_GET['action'] == 'edite' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        // if password empty used the password found in database 
        if(empty($_POST['password'])) {
            $pass = $row['Password'];
            $_POST['password'] = sha1($pass);
        } else { // if user write password use the password
            $pass =  sha1($_POST['password']);
        }
        //check empty inputs and print errors and stop code if found errors 
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors_input)) {
            foreach($errors_input as $errors) {
                echo '<div class="alert alert-danger">' . $errors . '</div>';
            }    
        } else {
            // connection database.
            $stmt = $con->prepare('UPDATE users SET UserName = ?, Password = ?, Email = ?, FullName = ?, Phone = ? WHERE UserID = ?');
            $stmt->execute(array($_POST['username'], $pass, $_POST['email'], $_POST['full-name'], $_POST['Phone'], $_SESSION['ID']));
        }
    }
    include $dir_templates . 'footer.php'; // include footer