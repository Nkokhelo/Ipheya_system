<?php
error_reporting(0);
$log = new Logic();
session_start();
unset($_SESSION["Client"]);
unset($_SESSION['Employee']);
// session_destroy();
$_SESSION["Client"]= $_SESSION['Employee'] = '';
    session_start();
    if(isset($_POST['Login']))
    {
     
      $_SESSION['Client'] = '';
      $_SESSION['Employee'] ='';
      $email = mysqli_real_escape_string($db,$_POST['log-email']);
      $password = mysqli_real_escape_string($db,$_POST['log-password']);
    }
      /*if(isset($_POST['auth']))
      {
        mysqli_query($db, "INSERT INTO authentication(client_email,authenticate) VALUES('{$email}',1)");
        header('Location: ');
      }*/

     if(isset($_POST['g-recaptcha-response'])&&$_POST['g-recaptcha-response'])
      {
        // var_dump($_POST);
        $secret="6LcKVzMUAAAAAFaTVArInEV4h-rVowh4hFK9ADYF";
        $ip=$_SERVER['REMOTE_ADDR'];
        $captcha=$_POST['g-recaptcha-response']."dsa";
        $rsp="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".$ip;
        // var_dump($rsp);
        // $arr=json_decode($rsp,TRUE);
<<<<<<< HEAD
        
=======

>>>>>>> 5f736a34a453e2a496310cea4febfb0a07165a9d

        if ($captcha == "")
        {
            $errors[] .= 'Please specify if your not a robot';
            if(!empty($errors))
            {
              $display = display_errors($errors);
            }
        }
        else
        {*/
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
                      header('Location: admin/dashboard.php');//admin url
                      break;
                      case 'Client':
                      $_SESSION['Client'] = $email;
                      if(isset($_SESSION['rent_items']))
                      {
                          header('Location: client/rentalProcess.php');//rental url                        
                      }
                      else
                      {
                          header('Location: client/authenticate.php');//client url
                      }
                     
                      break;
                      case 'Employee':
                      $_SESSION['Employee']=$email;
                      header('Location: employee/index.php');//employee url
                      break;
                      case 'Manager':
                      $_SESSION['Manager']=$email;
                      header('Location: manager/dashboard.php');//manager url
                      break;
                      case 'Stock Counter':
                      header('Location: stock-counter/inventorys.php');//stockcounter url
                  }
            }
<<<<<<< HEAD
        }
    }
?>
=======
        #}

      }
?>
>>>>>>> 5f736a34a453e2a496310cea4febfb0a07165a9d
