<?php
    // include '../logic.php';
    $logic = new Logic();
    $client = "<div class='alert alert-warning'><p class='glyphicon glyphicon-info-sign'></p> No Data was found!</div>";
    #fetch all clients
    $client_exe = $logic->getUnachivedClients();
    $allClients = '';
    while($clients = mysqli_fetch_assoc($client_exe)) :
      $allClients .= '<tr>
                          <td>'.$clients['client_no'].'</td>
                          <td>'.$clients['name'].' '.$clients['surname'].'</td>
                          <td>'.$clients['email'].'</td>
                          <td>
                          <a href="viewclient.php?view='.$clients['client_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-eye-open "></span></a>
                          <a href="clients.php?archive='.$clients['client_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                          </td>
                        </tr>';
    endwhile;
    #archive account
    if(isset($_GET['archive']))
    {
      $archive_id = mysqli_real_escape_string($db,$_GET['archive']);
      $archive_id = sanitize($archive_id);
      $archive_emp = "UPDATE clients SET archived = 1 WHERE client_id = '$archive_id'";
      mysqli_query($db,$archive_emp);
      header('Location: clients.php');
    }
    #fetch client for clientside dashboard
    if(isset($_SESSION['Client']))
    {
        $sess_client = $_SESSION['Client'];
        $client_q_exe  = $logic->getClientByEmail($sess_client);
        $client_info  = mysqli_fetch_assoc($client_q_exe);
        $a_id = $client_info['client_id'];
        $a_name  = $client_info['name'];
        $a_surname = $client_info['surname'];
        $a_email = $client_info['email'];
        $a_postal = $client_info['postal_address'];
        $a_number = $client_info['contact_number'];
        // $a_province = $client_info['province'];
        #update client
        if(isset($_POST['Update'])){
          $a_name = mysqli_real_escape_string($db,$_POST['name']);
          $a_name = sanitize($a_name);
          $a_surname = mysqli_real_escape_string($db,$_POST['surname']);
          $a_surname = sanitize($a_surname);
          $a_email = mysqli_real_escape_string($db,$_POST['email']);
          $a_email = sanitize($a_email);
          $a_number = mysqli_real_escape_string($db,$_POST['number']);
          $a_number = sanitize($a_number);
          $a_postal = mysqli_real_escape_string($db,$_POST['postal']);
          $a_postal = sanitize($a_postal);
          // $a_province = mysqli_real_escape_string($db,$_POST['province']);
          // $a_province = sanitize($a_province);
          $client_update = "UPDATE clients SET name = '$a_name', surname = '$a_surname', postal_address = '$a_postal', contact_number = '$a_number' WHERE email = '$sess_client'";
          mysqli_query($db,$client_update);
          header('Location: profile.php');
        }

        #change password
        if(isset($_POST['Change-password'])){
          $password = mysqli_real_escape_string($db,$_POST['new-password']);
          $password = sanitize($password);
          $confirm  = mysqli_real_escape_string($db,$_POST['confirm-password']);
          $confirm = sanitize($password);
          if($password!==$confirm){
            $errors[] .= 'Passwords do not match';
          }
          if(!empty($errors)){
            $pass_error = display_errors($errors);
          }
          else {
            $change_p_sql = "UPDATE clients SET password = '$password' WHERE email = '$sess_client'";
            if(mysqli_query($db,$change_p_sql)){
              header('Location: profile.php?changed=1');
            }
            else
            {
              if(empty($password)||empty($confirm))
              {
                 $error= "<span style='color:red'>password or cornfirm password is requred </span>";
                 return true;
              }
                 $error= "<span style='color:red'>password not changed: Please try again later</span>";
            }
          }
        }
   }

   if(isset($_GET['view']))
   {
     $query = $logic->getClientsById($_GET['view']);
     while($clientdata = mysqli_fetch_assoc($query))
     {
      $client = $clientdata;
     }

   }
 ?>
