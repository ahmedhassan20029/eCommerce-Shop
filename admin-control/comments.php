<?php
    ob_start();
    session_start();
    $comments_style = 'comments'; // for incloud file name comments-stele.css
    $titlePage = "comments"; // title the page


    if(isset($_SESSION) == "UserName") { 
        include "init.php"; // include file header and nav and ....

        $action = isset($_GET['action']) ? $_GET['action'] : 'manger';

        if($action == 'manger') {
            $stmt = $con->prepare("SELECT comments.*, items.Name, users.UserName FROM comments INNER JOIN items ON items.Item_ID = comments.itme_comment_id INNER JOIN users ON users.UserID = comments.comment_user");
            $stmt->execute();
            $comment = $stmt->fetchAll();
            // start code html from file comments-html 
            include $dir_html . "commentes-html.php";
        }

        include $dir_templates . 'footer.php'; // include footer;
    }
    ob_end_flush();