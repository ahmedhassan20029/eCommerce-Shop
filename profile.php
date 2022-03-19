<?php
session_start();
if(isset($_SESSION['user'])) {

    $titlePage = "profile";
    include "front-pages/init_front.php";

    $getuser = $con->prepare('SELECT * FROM users WHERE UserName = ?');
    $getuser->execute(array($_SESSION['user']));
    $info = $getuser->fetch();
?>
    <div class='container'>
        <div>
            <?php
                echo $info['UserName'] . '<br>';

                foreach(getitems('Member_ID', $info['UserID']) as $rows) {
                    echo $rows['Name'] . '<br>';
                }

            ?>
        </div>

    </div>
<?php
    include "front-pages/" . $dir_templates . 'footer.php';

} else {

    header('location: login.php?action=login');
    exit();
    //8888888888888888

}