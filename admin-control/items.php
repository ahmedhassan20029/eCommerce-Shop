<?php
    ob_start(); //output buffering start
    session_start(); // start sesstion
    $titlePage = 'items'; //create var $titlepage.
    if(isset($_SESSION['UserName'])){
        include 'init.php';

        $action = isset($_GET['action']) ? $_GET['action'] : 'manager';

        if($action == 'manager') {
            $stmt = $con->prepare("SELECT items.*, categories.Name AS cat_name, users.UserName FROM items INNER JOIN categories ON categories.ID = items.Cat_ID INNER JOIN users ON users.UserID = items.Member_ID");
            $stmt->execute();
            $items = $stmt->fetchAll();
            ?><!--close code php-->

        <!-- start code html -->
        <!-- redirect page edite profile -->
            <div class='section_manger members'>
                <h1 class='text-center'>items</h1>
                <a class='btn btn-primary' href='items.php?action=add'>add new items</a>
                <br>
                <!--table-->
                <div class='table-responsive'>
                    <table class='table table-bordered text-center'>
                        <tr class='thead'>
                            <td><?php echo lang('#id')?></td>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Date</td>
                            <td>categories name</td>
                            <td>User Name</td>
                            <td>action</td>
                        </tr>
                        <!--start code php-->
                        <?php
                            foreach($items as $item) {
                            ?> <!--close php-->
                            <tr class='data-members'>
                                <td><?php echo $item['Item_ID']?></td>
                                <td><?php echo $item['Name']?></td>
                                <td><?php echo $item['Price']?></td>
                                <td><?php echo $item['Date']?></td>
                                <td><?php echo $item['cat_name']?></td>
                                <td><?php echo $item['UserName']?></td>
                                <td>
                                    <a href='?action=adit&item=<?php echo $item['Item_ID']?>' class='btn btn-success'>edit</a>
                                    <a id="del-item" onclick="clickme()" href='?action=delete&item=<?php echo $item['Item_ID']?>' class='btn btn-danger'>delete</a>
                                </td>
                            </tr>
                        <!--opin php-->
                        <?php
                            }
                        ?>
                        <!--end code php-->
                    </table>
                </div>
                <!--table-->
            </div>
            <!--end code html-->

<?php // opine code php

        } elseif($action == 'add') { //start page add ?> <!-- close code php 3-->
            <div class='info-edite'> <!-- start code html. -->
                <div>
                    <h1>add items</h1>
                    <div>
                        <form class='' action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
                            <div class='mb-3'>
                                <label class='form-label'>name</label>
                                <input type='text' class='form-control' name='name' />

                                <?php $empty_input = array(); //var error inbut 
                                    if(empty($_POST['name'])) { // check input not empty
                                        $empty_input[] = 'this name is empty';
                                    } ?>

                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>summer</label>
                                <input type='text' class='form-control' name='summer' />

                                <?php 
                                    if(empty($_POST['summer'])) { // check input not empty
                                        $empty_input[] = 'this summer is empty';
                                    } ?>

                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>description</label>
                                <input type='text' class='form-control' name='description' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>country made</label>
                                <input type='text' class='form-control' name='made' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>price</label>
                                <input type='text' class='form-control' name='price' />

                                 <?php
                                    if(empty($_POST['price'])) { // check input not empty
                                        $empty_input[] = 'this price is empty';
                                    } ?>

                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>status</label>
                                <select class='form-control' name='status'>
                                    <option value='1'>new</option>
                                    <option value='2'>like new</option>
                                </select>

                                <?php
                                    if(empty($_POST['status'])) { // check input not empty
                                        $empty_input[] = 'this status is empty';
                                    } ?>

                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>categories</label>
                                <select class='form-control' name='categories'>
                                    <?php
                                        $stmt2 = $con->prepare("SELECT * FROM categories");
                                        $stmt2->execute();
                                        $cats = $stmt2->fetchAll();
                                        foreach($cats as $cat) {

                                            echo '<option value="'. $cat['ID'] .'">' . $cat['Name'] . '</option>';

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>membars</label>
                                <select class='form-control' name='membars'>
                                    <?php
                                        $stmt = $con->prepare("SELECT * FROM users");
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach($users as $user) {

                                            echo '<option value="'. $user['UserID'] .'">' . $user['UserName'] . '</option>';

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <input type='submit' value='save' class='btn btn-primary'/>
                            </div>
                            <?php 
                                // check send information by method post and run loop if input empty
                                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($empty_input)) {
                                    foreach($empty_input as $error) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }
                                }
                                
                                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $check = ChechItim('Name', 'items', $_POST['name']);
                                    if($check == 0) {
                                        $stmt = $con->prepare("INSERT INTO 
                                        items(Name, Summer, Description, Price, Date, Country_Made, Status, Cat_ID, Member_ID)
                                        VALUES(:zname, :zsummer, :zdescription, :zprice, NOW(), :zcountry, :zstatus, :zcat, :zmem)");
                                        $stmt->execute(array(
                                            'zname' => $_POST['name'],
                                            'zsummer' => $_POST['summer'],
                                            'zdescription' => $_POST['description'],
                                            'zprice' => $_POST['price'],
                                            'zcountry' => $_POST['made'],
                                            'zstatus' => $_POST['status'],
                                            'zcat' => $_POST['categories'],
                                            ':zmem' => $_POST['membars']

                                        ));
                                    } else {
                                        echo '<div class="alert alert-danger">' . 'this name is used' .'</div>';
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div> <?php // end page add
           
        } elseif($action == 'adit') {
            $stmt = $con->prepare("SELECT * FROM Items WHERE Item_ID = ?");
            $stmt->execute(array($_GET['item']));
            $item = $stmt->fetch();
            if($_GET['item'] === $item['Item_ID']) { ?> <!-- close code php 3-->
                <div class='info-edite'> <!-- start code html. -->
                <div>
                    <h1>edit item</h1>
                    <div>
                        <form class='' action='<?php $_SERVER['PHP_SELF']?>' method='post'>
                            <div class='mb-3'>
                                <label class='form-label'>name</label>
                                <input type='text' class='form-control' name='name' value='<?php echo $item['Name']?>'/>
                                <?php
                                    $empti_feild = array();
                                    if(empty($_POST['name'])){
                                        $empti_feild[] = 'this is input name feild';
                                    }

                                ?>

                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>summer</label>
                                <input type='text' class='form-control' name='summer' value='<?php echo $item['Summer']?>'/>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>description</label>
                                <input type='text' class='form-control' name='description' value='<?php echo $item['Description']?>' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>price</label>
                                <input type='text'  class='form-control'  name='price' value='<?php echo $item['Price']?>' />
                                <?php
                                    if(empty($_POST['price'])){
                                        $empti_feild[] = 'this is input price feild';
                                    }

                                ?>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>country made</label>
                                <input type='text' class='form-control' name='country' value='<?php echo $item['Country_Made']?>' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>status</label>
                                <select class='form-control' name='status'>
                                    <option value="1" <?php if($item['Status'] == 1) {echo 'selected';} ?> >new</option>
                                    <option value="2" <?php if($item['Status'] == 2) {echo 'selected';} ?> >like new</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>cat name</label>
                                <select class='form-control' name='cat'>
                                <?php
                                    $cats = $con->prepare("SELECT * FROM categories");
                                    $cats->execute();
                                    $cat = $cats->fetchAll();
                                    
                                        foreach($cat as $cata) {
                                            ?>
                                             <option value='<?php echo $cata['ID']?>' <?php if($cata['ID'] == $item['Cat_ID']) {echo 'selected';} ?>><?php echo $cata['Name']?></option>';
                                            <?php
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>member</label>
                                <select class='form-control' name='member'>
                                    <?php
                                        $mem = $con->prepare("SELECT * FROM users");
                                        $mem->execute();
                                        $mems = $mem->fetchAll();
                                        foreach($mems as $member) {
                                            ?>
                                            <option value='<?php echo $member['UserID']?>'<?php if($member['UserID'] == $item['Member_ID']){echo 'selected';}?>><?php echo $member['FullName']?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <input type='submit' value='save' class='btn btn-primary'/>
                            </div>                                  
                        </form>
                    </div>
                </div>
            </div> <?php // open code php
            
            }
            if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($empti_feild)) {
                foreach($empti_feild as $errors) {
                    echo '<div class="alert alert-danger">' . $errors . '</div>';
                }
            } elseif($_SERVER["REQUEST_METHOD"] == "POST" && empty($empti_feild)) {
               $stmt = $con->prepare("UPDATE items SET `Name` = ?, Summer = ?, `Description` = ?, Price = ?, Country_Made = ?, `status` = ?, Cat_ID = ?, Member_ID = ? WHERE Item_ID = ?");
               $stmt->execute(array($_POST['name'], $_POST['summer'], $_POST['description'], $_POST['price'], $_POST['country'], $_POST['status'], $_POST['cat'], $_POST['member'], $_GET['item']));
            }     
        } elseif($action = "delete") {
           $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zitem");
           $stmt->bindParam(":zitem", $_GET['item']);
           $stmt->execute();
           echo "done";
        }
        include $dir_templates . 'footer.php'; // include footer;
    }
    ob_end_flush(); // end output buffering
?>
