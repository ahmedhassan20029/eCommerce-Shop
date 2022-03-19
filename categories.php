<?php
    session_start();
    $titlePage = "Orange";
    $home_style = 'home_style';
    include "front-pages/init_front.php";
?>
    <div class='container'>
        <div>
            <?php
                foreach(getitems('Cat_ID', $_GET['id']) as $rows) {
                    echo $rows['Name'] . '<br>';
                }
            ?>
        </div>

    </div>
<?php
    include "front-pages/" . $dir_templates . 'footer.php';