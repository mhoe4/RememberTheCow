<?php
  session_start();

  //redirect to start if already logged in
  if(!isset($_SESSION["username"])){
    header('Location: start.php');
    exit();
  }

  //destory seesion data and redirect to home page
  session_unset();
  session_destroy();
  header('Location: start.php');
  exit();
?>
