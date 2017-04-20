<?php
  include('common.php');
  session_start();

  //redirect to todolist if already logged in
  if(isset($_SESSION["username"])){
    header('Location: todolist.php');
    exit();
  } else{

    if(isset($_POST["name"]) && isset($_POST["password"])) {

      //grab user input
      $username = $_POST["name"];
      $password = $_POST["password"];

      //dont allow ' character
      if (strpos($password, '\'') !== FALSE){
        header('Location: start.php');
        exit();
      }

      //verify credentials
      $verifyCreds = verifyCredentials($username, $password, $db);
      $verifyCredsInfo = $verifyCreds->fetchAll();
      if (!empty($verifyCredsInfo)) {

        //login if credentials are verified
        if($verifyCredsInfo[0]['count'] == 1){
          $_SESSION["username"] = $username;
          setcookie("last_login", date("D y M d, g:i:s a"), time() + (86400 * 7)); // 86400 = 1 day
          header('Cache-Control: no-cache, no-store, must-revalidate');
          header('Location: todolist.php');
          exit();

        } else{

          //check if username exists
          $verifyUsername = verifyUsername($username, $db);
          $verifyUsernameInfo = $verifyUsername->fetchAll();
          if(!empty($verifyUsernameInfo)){

            //go back to login page if username exists
            if($verifyUsernameInfo[0]['count'] == 1){
              header('Location: start.php');
              exit();
            } else{

              //check new username and password for correctness
              if (validateNameChars($username) && validatePassChars($password)) {

                //adduser to cowusers and login to todolist
                addUser($username, $password, $db);
                $_SESSION["username"] = $username;
                setcookie("last_login", date("D y M d, g:i:s a"), time() + (86400 * 7)); // 86400 = 1 day
                header('Cache-Control: no-cache, no-store, must-revalidate');
                header('Location: todolist.php');
                exit();

              }

              //redirect to start with error if user credentials are invalid
              header('Location: start.php?error=login');
              exit();
            }
          }



        }
        //redirect to start if no credentials
      } else{
          header('Location: start.php?error=login');
          exit();
      }
      //redirect to start if user goes to this page directly
    } else{
        header('Location: start.php');
        exit();
    }
  }
?>
