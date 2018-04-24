<?php 

  if(isset($_GET['action'])){
    $action = $_GET['action'];

    switch($action){
      case 'register':
        if(isset($_POST['form_submitted']) && $_POST['csrf'] === $_SESSION['token']){
          $result = Accounts::register();

          if($result === true){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            header('Location: index.php?page=authentication&action=signin');
          }
          else{
            echo $result;
          }
        }
        else{
          include "view/register.php";
        }
        break;

      case 'signin':
        if(isset($_SESSION['loggedin'])){
          if(Accounts::isAdmin() === true){
            $products = Products::getAllProducts();
            include 'view/dashboard.php';
          }
          else{
            header('Location: index.php?page=home');
          }
        }
        else{
          if(isset($_POST['form_submitted']) && $_POST['csrf'] === $_SESSION['token']){
            $result = Accounts::signIn();

            if($result === true){
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
              header('Location: index.php?page=authentication&action=signin');
            }
            else{
              echo $result;
            }
          }
          else{
            include "view/signin.php";
          }
        }
        break;

      case 'signout' : 
        if(isset($_SESSION['loggedin'])){
          unset($_SESSION['loggedin']);
          unset($_SESSION["token"]);
          session_destroy();
        }

        if(isset($_COOKIE[session_name()])){
          setcookie(session_name(),'',time() - 3600, '/');
        }

        header('Location: index.php?page=authentication&action=signin');
        break;

      default:
        break;
    }
  }
  else{
    include 'view/register.php';
  }

?>