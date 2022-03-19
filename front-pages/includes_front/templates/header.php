<?php 
  $stmt = $con->prepare("SELECT * FROM categories");
  $stmt->execute();
  $cuts = $stmt->fetchAll();
?>
<?php 
  $stmtx = $con->prepare("SELECT * FROM categorieschild WHERE ID");
  $stmtx->execute();
  $child = $stmtx->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="admin-control/layout_admin/images/favicon.ico" type="image/x-icon">
    <title><?php gettitle()?></title>
    <link rel="stylesheet", href="<?php echo $dir_lib_css ?>bootstrap.min.css"/>
    <link rel="stylesheet", href="<?php echo $dir_lib_css ?>all.min.css"/>
    <link rel="stylesheet", href="<?php echo $dir_assets ?>/header.css"/>
    <?php if(isset($login_style)) {echo "<link rel='stylesheet' href='$dir_assets/login.css'/>";}?>
  </head>
  <body>
    <!--Start div note-site-->
    <div class='note-site'>
      <div class='container'>
        <div class='row box'>
          <h2 class='col-11'>
            <i class="fa-solid fa-plane"></i>
            Free Worldwide Shipping: Get Free Shipping With Our Special Service And Not Redeemable For Cash Or Creadit
            <span>Shop Now</span>
          </h2>
          <div class='col-1 icon-close'>
            <i class="fa-solid fa-xmark"></i>
          </div>
        </div>
      </div>
    </div>
    <!--End div note-site-->
    <!--Start section curinsy and logo and baskitshop-->
    <div class="header-top">
      <div class='container'>
        
      <div class='row '>

          <section class='col-md-5 mt-2'>
              <div class='row cur-lang'>
                  <section class='col-md-3'>
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span>USD</span>
                    <i class="fa-solid fa-angle-down"></i>
                  </section>
                  <section class='col-md-4'>
                    <i class="fa-solid fa-globe"></i>
                    <span>English</span>
                    <i class="fa-solid fa-angle-down"></i>
                  </section>
              </div>
          </section>

          <section class='col-md-4'>
              <img src="admin-control/layout_admin/images/multistore-logo.jpg" alt="logo-tech-shop">
          </section>

          <section class='col-md-3 mt-2 option-main'>
            <button class="d-search">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="d-inline user">
              <i class="fa-solid fa-user"></i>
            </div>
            <div class="d-inline desktop_cart">
              <i class="fa-solid fa-basket-shopping"></i>
            </div>
            <span>$ 0.00</span>
          </section>

        </div>
      </div>
    </div>
    <!--End section curinsy and logo and baskitshop-->
    <!--
    <header>
      <div class='container'>
        <section>
          <span>
            <?php
              if(isset($_SESSION['user'])) {
                echo "welcome " . "<a href='profile.php'>" . $_SESSION['user'] . "</a>";
                echo "  <a href='admin-control/logout.php'>" . "logout" . "</a>";
              } else {?>
                <a href="login.php?action=login">log in</a>
                <?php
              }
            ?>
          </span>
        </section>
      </div>
      <nav>
        <ul class='container'>
          <li>
            <a href="http://localhost:8080/eCommerce_Shop/">home</a>
          </li>
          <?php foreach($cuts as $cut) {?>
              <li>
                <a href="categories.php?id=<?php echo $cut['ID']?>?page-name=<?php echo str_replace(' ', '-', $cut['Name'])?>"><?php echo $cut['Name']?></a>
                <ul class='categores-child'>
                    <?php foreach($child as $chil) {
                      if($cut['ID'] == $chil['cut_1']) {?>
                    <li>
                      <a href="<?php echo $chil['ID']?>"><?php echo $chil['Name']?></a>
                    </li> <?php } } ?>
                </ul>
              </li> <?php } ?>
        </ul>
      </nav>
    </header> -->

