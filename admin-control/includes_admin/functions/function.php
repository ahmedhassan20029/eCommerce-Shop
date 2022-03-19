<?php
 //create var $titlepage
 // create fanction titlepage
 function gettitle() {

    global $titlePage;

   isset($titlePage) ? print_r($titlePage) : print_r('defualte');

 }

// fanction redirect page v2.0
function redirect($theMessage, $url = null, $seconds = 3) {
  
  if($url === null) {
    $url = '404.php';
  } else {
    if(isset($SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !=='') {
      $url = $_SERVER['HTTP_REFERER'];
    } else {
      $url = 'index.php';
    }
  }

  echo $theMessage;
  header("refresh:$seconds;url=$url");
  exit();
}

// function check db
function ChechItim($select, $from, $value) {

  global $con;

  $stmts = $con->prepare("SELECT $select FROM $from WHERE $select = ? ");
  
  $stmts->execute(array($value));
  
  $count = $stmts->rowCount();
  
  return $count;

}

// function count members v1.0

function CountItems($item, $users) {
  global $con;
  $stmt2 = $con->prepare("SELECT COUNT($item) FROM $users");
  $stmt2->execute();
  return $stmt2->fetchColumn();
}

//function getlatest v1.0
function getlatest($select, $users, $order, $limit = 5) {
  global $con;
  $getstmt = $con->prepare("SELECT $select FROM $users ORDER BY $order DESC LIMIT $limit");
  $getstmt->execute();
  $rows = $getstmt->fetchall();
  return $rows;
}
//function get items v1.1
function getitems($where, $value) {
  global $con;
  $getitem = $con->prepare("SELECT * FROM items WHERE $where = ? ORDER BY Item_ID DESC");
  $getitem->execute(array($value));
  $row = $getitem->fetchall();
  return $row;
}
//function check user in databases v1.0
function chekuserstates($user) {
    global $con;
    $stmtx = $con->prepare('SELECT UserName, RegStatus FROM users WHERE UserName = ? AND RegStatus = 1');
    $stmtx->execute(array($user));
    $status = $stmtx->rowCount();
    return $status;
}