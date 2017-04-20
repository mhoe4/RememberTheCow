<?php
  include('common.php');
  session_start();

  //redirect to start if already logged in
  if(!isset($_SESSION["username"])){
    header('Location: start.php');
    exit();
  }

  //delete list item to database
  if(isset($_POST["id"])) {
    deleteListItem($_POST["id"], $db);
    header('Location: todolist.php');
    exit();
  }

  //add list item to database
  if(isset($_POST["item"])) {

    //dont allow this value
    if (strpos($_POST["item"], '</*') !== FALSE){
      header('Location: todolist.php');
      exit();
    }
    if (!empty($_POST["item"])) {
      addListItem($_POST["item"], $_SESSION["username"], $db);
    }
    header('Location: todolist.php');
    exit();
  }
?>
