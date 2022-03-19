<?php
    ob_start();
    session_start();

    $titlePage = "log in";
    $login_style = 'login_style';
    // sesstion if found redirect to page home
    include "front-pages/init_front.php";

    if($_GET['action'] == 'login') {?>
        <div class='container'>
            <form class='' action="<?php $_SERVER['PHP_SELF']?>" method='post'>
                <div class='mb-3'>
                    <label for="exampleInputEmail1" class='from-label'>User Name address</label>
                    <input type="text" class='form-control' name='UserName' id='exampleInputEmail1' aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class='mb-3' id='pass'>
                    <label for="exampleInputPassword1" class='from-label'>Password</label>
                    <input type="password" name='pass' class='form-control' id='exampleInputPassword1'>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="Login" class="btn btn-primary">Login</button>
            </form>
            <div><!--start sin in-->
                <span><a href="login.php?action=login">log in</a></span>
                <span><a href="login.php?action=sinin">sin in</a></span>
            </div>
        </div> <?php
        // entry requirement
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $hashPassword = sha1($_POST['pass']); // PASSWORD HASS

            // check email, password, in databases
            $stmt = $con->prepare('SELECT UserName, Password FROM users WHERE UserName = ? AND Password = ?');
            $stmt->execute(array($_POST['UserName'], $hashPassword));
            $count = $stmt->rowCount();

                // chick admin or user
                if($count > 0) {
                    $_SESSION['user'] = $_POST['UserName']; //resgister session email
                    // header('location: index.php');     //redirect to page home
                } else { // IF NOT ADMIN SHOW MESSAGE The email or password is NOT ADMIN // close php ?>
                    <!--start code html-->
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            The email or password is incorrect and you is not admin
                        </div>
                    </div> <?php // start code php
                }
        }
    } elseif($_GET['action'] == 'sinin') {?>

    <div class='container'>
        <form action="" class='' action="<?php $_SERVER['PHP_SELF']?>" method='post'>
            <div class='mb-3'>
                <label for="exampleInput" class='from-label'>user name</label>
                <input required pattern='.{6,}' title='user name shuld larg than 6 carectors' type="text" class='form-control' id='exampleInput' name='username' aria-describedby="emailH">
            </div>
            <div class='mb-3'>
                <label for="exampleInputEmail1" class='from-label'>Email address</label>
                <input required type="email" class='form-control' id='exampleInputEmail1' name='email' aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class='mb-3' id='pass'>
                <label for="exampleInputPassword1" class='from-label'>Password</label>
                <input required minlength='8' type="password" class='form-control' id='exampleInputPassword1' name='password1'>
            </div>
            <div class='mb-3' id='re-pass'>
                <label for="exampleInputPassword2" class='from-label'>re-Password</label>
                <input required minlength='8' type="password" class='form-control' id='exampleInputPassword2' name='password2'>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="Login" class="btn btn-primary">Login</button>
        </form>
        <div><!--start sin in-->
            <span><a href="login.php?action=login">log in</a></span>
            <span><a href="login.php?action=sinin">sin in</a></span>
        </div>
    </div>
<?php
        /*start check sineup */
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $arrors = array();

            /* start validate email */
            if(isset($_POST['username'])) {
                $_POST['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                if (strlen($_POST['username']) >= 6) {
                    
                } else {
                    $arrors[] = 'user name shuld larg than 6 carectors';
                }
            }
            /* end validate email */

            /* start validate email */
            if(isset($_POST['email'])) {

                $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) != true) {
                    $arrors[] = 'email not validate';
                }
            }
            /* end validate user email */

            /* start validate password */
            if (!empty($_POST['password1']) && !empty($_POST['password2']) && $_POST['password1'] === $_POST['password2']) {
                    $pass1 = sha1($_POST['password1']);
                    $pass2 = sha1($_POST['password2']);
            } else {
                $arrors[] = 'password empty or password it not matching';
            }
            /* end validate password*/

            /* start check errors*/
            if(!empty($arrors)) {
                foreach($arrors as $arror) {
                    echo $arror . '<br>';
                }
                /*if errors do not founding */
            } elseif(empty($arrors)) {
                /*check user name not found */
                $founduser = ChechItim('UserName' , 'users', $_POST['username']);
                /*if user name is found */
                if($founduser == 1) {
                    echo 'this user name is found';
                    /*if user name not found */
                } else {
                    /*check email */
                    $foundemail = ChechItim('Email' , 'users', $_POST['email']);
                    /*if email is found */
                    if($foundemail == 1) {
                        echo 'this mail is found';
                        /*if mail is not found */
                    } else {
                        $info = $con->prepare('INSERT INTO 
                            users(UserName, Email, Password, RegStatus, date)
                            value(:zuser, :zemail, :zpassword, 0, NOW())');
                        $info->execute(array(
                            'zuser' => $_POST['username'],
                            'zemail' => $_POST['email'],
                            'zpassword' => sha1($_POST['password1'])
                        ));
                    }
                }
            } /* end check errors*/
        } /* end check sineup */



    } else {
       
    }
    include "front-pages/" . $dir_templates . 'footer.php';
    ob_end_flush();