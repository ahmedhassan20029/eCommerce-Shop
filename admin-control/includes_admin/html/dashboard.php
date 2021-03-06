
<div class="section_manger">
  <div class="dashboard">
    <h1 class="text-center">dashboard
      <div class="row">
        <div class="col-md-3">
          <div class="stat st-members">
            <p>total members</p><span><a href='members.php?action=manage&userid=<?php echo $_SESSION["ID"] ?>'><?php echo CountItems('UserID', 'users') ?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-pending">
            <p>pending members</p><span><a href="members.php?action=manage&pending=activate&userid=<?php echo $_SESSION['ID'] ?>"><?php echo ChechItim('RegStatus', 'users', 0) ?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-items">
            <p>total items</p><span><a href="items.php?action=manager"><?php echo CountItems('Item_ID', 'items');?></a></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat st-comments">
            <p>total comments</p><span> <a href="comments.php?action=manger"><?php echo CountItems('comment_id', 'comments');?></a></span>
          </div>
        </div>
      </div>
    </h1>
    <div class="latest">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel">
            <div class="panel-heading">
              <p>latest registerd users</p>
            </div>
            <div class="panel-body">
              <?php 
                foreach($latest as $user) {
                  echo 
                       '<div class="row">' .
                           "<div class='col-sm-6 section_user'>" .
                             $user['UserName'] .
                           '</div>' .
                            '<div class="col-sm-6">' .
                               '<a class="adit-user" href="#">' . 'adit' . '</a>' .
                               '<a class="delete-user" href="#">' . 'delete' . '</a>' .
                            '</div>' .
                        '</div>';
                }?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <?php
             $stmt = $con->prepare("SELECT Name FROM items ORDER BY Item_ID DESC LIMIT 5"); 
             $stmt->execute(); $conts = $stmt->fetchAll(); 
             foreach($conts as $cont) {
               echo $cont["Name"] . '<br>'; 
              }?>
        </div>
      </div>
    </div>
  </div>
</div>