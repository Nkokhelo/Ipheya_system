<?php
  session_start();
  unset($_SESSION["Client"]);
  unset($_SESSION['Employee']);
  session_destroy();
  $_SESSION["Client"]= $_SESSION['Employee'] = '';
    #login
    if(isset($_POST['Login'])){
      session_start();
      $_SESSION['Client'] = '';
      $email = mysqli_real_escape_string($db,$_POST['log-email']);
      $password = mysqli_real_escape_string($db,$_POST['log-password']);

      $login = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
      $login_exe = mysqli_query($db,$login);
      $result = mysqli_fetch_assoc($login_exe);
      $count_c = mysqli_num_rows($login_exe);
      if($count_c < 1){
        $_SESSION['Employee'] = '';
        $e_login = "SELECT * FROM employees WHERE email = '$email' AND password = '$password'";
        $e_login_exe = mysqli_query($db,$e_login);
        $e_result  = mysqli_fetch_assoc($e_login_exe);
        $count_e = mysqli_num_rows($e_login_exe);
        $count_e;
        if($count_e > 0){
          $_SESSION['Employee'] = $e_result['email'];
          header('Location: Location: admin/departments.php');
        }
        else{
          $errors[] .= 'Email or password is incorrect';
          $display = display_errors($errors);
        }
      }
      else {
        if(!empty($errors)){
          $display = display_errors($errors);
        }
        else{
          $_SESSION['Client'] = $result['email'];
          header('Location: home.php');
        }
      }
    }
?>
