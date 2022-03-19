<?php
    ob_start(); //output buffering start
    session_start(); // start sesstion
    $titlePage = 'cetegories'; //create var $titlepage.
    if(isset($_SESSION['UserName'])) {
        include 'init.php';
        $action = isset($_GET['action']) ? $_GET['action'] : 'manege'; //start page manager
        if($action == 'manege') {
            $sort = '';
            if(isset($_GET['sort'])) {
                $sort = $_GET['sort'];
            }
            // connection database.
            $stmt = $con->prepare("SELECT * FROM categories WHERE ID ORDER BY Ordring $sort");
            $stmt->execute();
            $row = $stmt->fetchAll(); ?><!--close php-->
            <div class='info-edite'> <!--start code html-->
                <h1 class='text-center'>manege cetegories</h1>
                <div class='man-cat'>
                    <div class='se-title'>
                        <h2>categories</h2>
                        <section>  
                            <span>ordring: </span>
                            <a href='?action=manege&sort=ASC'>Asc |</a>
                            <a href='?action=manege&sort=DESC'>Desc</a>
                        </section>
                    </div> <?php // open code php
                    foreach($row as $cat) { // loop show categories ?> <!--close code php 2-->
                        <div class='category'>
                            <div class='options'>
                                <a href='?action=edit&id=<?php echo $cat['ID']?>'>edit</a>
                                <a href='?action=delete&id=<?php echo $cat['ID']?>'>delete</a>
                            </div>
                            <p><?php echo $cat['Name']?></p>
                            <p><?php if($cat['Description'] == '') {echo 'not found Description';} else {echo $cat['Description'];}?></p>
                            <span><?php if($cat['Visibilte'] == 1) {echo 'hidden';} else {echo 'Visibile';}?></span>
                            <span><?php if($cat['Allow_comment'] == 1) {echo 'disaple comments';} else {echo 'allow comments';}?></span>
                            <span><?php if($cat['Allow_ads'] == 1) {echo 'disaple ads';} else {echo 'allow ads';}?></span>
                        </div>  <?php // open code php 3
                    }   ?> <!-- close code php 2-->
                </div>
            </div>  <?php // open code php 3
        } //end page manager
        if($action == 'add') { //start page add ?> <!-- close code php 3-->
            <div class='info-edite'> <!-- start code html. -->
                <div>
                    <h1>add categories</h1>
                    <div>
                        <form class='' action='?action=insert' method='POST'>
                            <div class='mb-3'>
                                <label class='form-label'>name</label>
                                <input type='text' class='form-control' name='name' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>description</label>
                                <input type='text' class='form-control' name='description' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Ordring</label>
                                <input type='text' class='form-control' name='Ordring' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Visibilte</label>
                                <br>
                                <input id='vis-yes' type='radio'  name='Visibilte' checked/>
                                <label for='vis-yes' class='form-label'>yes</label>
                                <input id='vis-no' type='radio'  name='Visibilte' value='1'/>
                                <label for='vis-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Allow comment</label>
                                <br>
                                <input id='com-yes' type='radio'  name='comment' value='0' checked/>
                                <label for='com-yes' class='form-label'>yes</label>
                                <input id='com-no' type='radio'  name='comment' value='1'/>
                                <label for='com-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Allow ads</label>
                                <br>
                                <input id='ads-yes' type='radio'  name='ads' value='0' checked/>
                                <label for='ads-yes' class='form-label'>yes</label>
                                <input id='ads-no' type='radio'  name='ads' value='1'/>
                                <label for='ads-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <input type='submit' value='save' class='btn btn-primary'/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  <?php // end page add
        } elseif($action == 'insert') { // start page insert
            if(empty($_POST['name'])) {
                echo '<div class="alert alert-danger"> input name empty</div>';
            } else {
                $check = ChechItim('Name', 'categories', $_POST['name']);
                $stmt = $con->prepare("INSERT INTO
                            categories(Name, Description, Ordring, Visibilte, Allow_comment, Allow_ads)
                            VALUES(:zname, :zdes, :zord, :zvis, :zcom, :zads)");
                            $stmt->execute(array(
                            'zname'     => $_POST['name'],
                            'zdes'      => $_POST['description'],
                            'zord'      => $_POST['Ordring'],
                            'zvis'      => $_POST['Visibilte'],
                            'zcom'      => $_POST['comment'],
                            'zads'      => $_POST['ads']
                            ));
            }
        // end page insert
        } elseif($action == "edit") { //start page edit
            // conacction db by id
            $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
            $stmt->execute(array($_GET['id']));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if($_GET['id'] === $row['ID']) { ?> <!-- close code php 3-->
                <div class='info-edite'> <!-- start code html. -->
                <div>
                    <h1>edit categories</h1>
                    <div>
                        <form class='' action='?action=edit&id=<?php echo $_GET['id']?>' method='POST'>
                            <div class='mb-3'>
                                <label class='form-label'>name</label>
                                <input type='text' class='form-control' name='name' value='<?php echo $row['Name']?>'/>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>description</label>
                                <input type='text' class='form-control' name='description' value='<?php echo $row['Description']?>'/>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Ordring</label>
                                <input type='text' class='form-control' name='Ordring' value='<?php echo $row['Ordring']?>' />
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Visibilte</label>
                                <br>
                                <input id='vis-yes' type='radio'  name='Visibilte' value='0' <?php if($row['Visibilte'] == 0) {echo 'checked';} ?> />
                                <label for='vis-yes' class='form-label'>yes</label>
                                <input id='vis-no' type='radio'  name='Visibilte' value='1' <?php if($row['Visibilte'] == 1) {echo 'checked';} ?> />
                                <label for='vis-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Allow comment</label>
                                <br>
                                <input id='com-yes' type='radio'  name='comment' value='0' <?php if($row['Allow_comment'] == 0) {echo 'checked';} ?> />
                                <label for='com-yes' class='form-label'>yes</label>
                                <input id='com-no' type='radio'  name='comment' value='1' <?php if($row['Allow_comment'] == 1) {echo 'checked';} ?> />
                                <label for='com-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <label class='form-label'>Allow ads</label>
                                <br>
                                <input id='ads-yes' type='radio'  name='ads' value='0' <?php if($row['Allow_ads'] == 0) {echo 'checked';} ?> />
                                <label for='ads-yes' class='form-label'>yes</label>
                                <input id='ads-no' type='radio'  name='ads' value='1' <?php if($row['Allow_ads'] == 1) {echo 'checked';} ?> />
                                <label for='ads-no' class='form-label'>no</label>
                            </div>
                            <div class='mb-3'>
                                <input type='submit' value='save' class='btn btn-primary'/>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <?php // open code php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $stmt = $con->prepare("UPDATE categories SET `Name` = ?, `Description` = ?, Ordring = ?, Visibilte = ?, Allow_comment = ?, Allow_ads = ? WHERE ID = ?");
                    $stmt->execute(array($_POST['name'], $_POST['description'], $_POST['Ordring'], $_POST['Visibilte'], $_POST['comment'], $_POST['ads'], $_GET['id']));
                }
            }
        } elseif($action == 'delete') {
            // conacction db by id
            $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
            $stmt->execute(array($_GET['id']));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            $name = $row['Name'];
            if($_GET['id'] == $row['ID']) { ?>
                <!--code html-->
                <div class='info-edite'>
                    <div class=''>
                        <p>are you sour delete <?php echo $name; ?></p>
                        <a href="?action=delete&id=<?php echo $row['ID']?>&delete=remove" class="btn btn-danger">delete</a>
                    </div>
                </div> <?php
                if(isset($_GET['delete']) == 'remove') {
                    $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
                    $stmt->bindParam(':zid', $_GET['id']);
                    $stmt->execute();
                }
            }
        }
        // end page edit
        include $dir_templates . 'footer.php'; // include footer;
    }
    ob_end_flush(); // end output buffering