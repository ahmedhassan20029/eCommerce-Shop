<?php //opine php

    session_start(); // start session
    // the var use to (no include file)
    $noInclude = '';
    //create var $titlepage 
    $titlePage = 'login';

    // fille include
    include 'init.php';

    // sesstion if found redirect to page dashboard
    if(isset($_SESSION['UserName'])) { 
      header('location:dashboard.php');
    }

    // entry requirement
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $hashPassword = sha1($_POST['password']); // PASSWORD HASS

        // check email, password, in databases
        $stmt = $con->prepare('SELECT
                                  UserID,
                                  Email,
                                  Password,
                                  FullName
                              FROM 
                                users 
                              WHERE 
                                Email = ? 
                              AND 
                                Password = ? 
                              AND 
                                GroupID = 1
                              limit 1
                              ');
        $stmt->execute(array($_POST['email'], $hashPassword));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        // chick admin or user
        if($count > 0) {
          $_SESSION['UserName'] = $_POST['email']; //resgister session email
          $_SESSION['ID'] = $row['UserID'];       //resgister session id
          $_SESSION['Name'] = $row['FullName'];  //resgister session name
          header('location:dashboard.php');     //redirect to page dashboard

        } else {
          // IF NOT ADMIN SHOW MESSAGE The email or password is NOT ADMIN
// close php
?>

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
          </div>
        <!--end code html-->

<?php // start code php

        }
    }
// end code php
?>

<!--start code html-->
  <form class='admin-login' action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name='email' aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="Login" class="btn btn-primary">Login</button>
  </form>
<!--end code html-->

<!-- start code php-->
<?php include $dir_templates . 'footer.php'; ?>
<!-- end code php -->