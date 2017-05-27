<?php
$log = new Logic();
session_start();
unset($_SESSION["Client"]);
unset($_SESSION['Employee']);
session_destroy();
$_SESSION["Client"]= $_SESSION['Employee'] = '';
    #login
    if(isset($_POST['Login']))
    {
      session_start();
      $_SESSION['Client'] = '';
      $_SESSION['Employee'] ='';
      $email = mysqli_real_escape_string($db,$_POST['log-email']);
      $password = mysqli_real_escape_string($db,$_POST['log-password']);

      $login_exe =$log->Login($email,$password);
      $result = mysqli_fetch_row($login_exe);
      if(count($result)< 1)
      {
          $errors[] .= 'Email or password is incorrect';
          if(!empty($errors))
          {
            $display = display_errors($errors);
          }
          // echo "Not found";
      }
      else
      {
          $ip = $_SERVER['REMOTE_ADDR'];
          #$emailpar = $result['email'];
          $log->AssociateTarget($ip,$email);
            $_SESSION['Employee'] = 'Employee';
            $UserRole =$log->getUserRoleByUserId($result[0]);
          //   echo $UserRole;
            switch($UserRole)
            {
                case 'Admin':
                $_SESSION['Employee']=$email;
                header('Location: admin/employees.php');//admin url
                break;
                case 'Client':
                $_SESSION['Client'] = $email;
                header('Location: client/home.php');//client url
                break;
                case 'Employee':
                $_SESSION['Employee']=$email;
                header('Location: employee/index.php');//employrr url
                break;
                case 'Manager':
                $_SESSION['Manager']=$email;
                header('Location: manager/index.php');//manager url
                break;
            }
      }
    }
?>
