<?php
    #general requests
    if(isset($_POST['Request-service'])){
      $service = sanitize($_POST['service']);
      $description = mysqli_real_escape_string($db,$_POST['description']);
      $description = sanitize($description);
      $user_id = sanitize($_SESSION['Client']);

      echo $service.$description.$user_id;

      if(empty($service)){
        $errors[] .= 'Please select service.';
      }
      if(!empty($errors)){
        $gr_display = display_errors($errors);
      }
      else{
        #remember due_date for live server
        $gr_query = "INSERT INTO general_requests(user_id,service,description,request_date,request_status,duration,warranty,due_date)
        VALUES('{$user_id}','{$service}','{$description}',NOW(),'0','','',NULL)";
        mysqli_query($db,$gr_query);
        header('Location: request.php');
      }
    }
    #maintenance requests
    if(isset($_POST['Request-maintenance'])){
      $maintenance = sanitize($_POST['maintenance']);
      $specify = mysqli_real_escape_string($db,$_POST['specify']);
      $specify = sanitize($specify);
      $frequency = mysqli_real_escape_string($db,$_POST['frequency']);
      $frequency = sanitize($frequency);
      $period = mysqli_real_escape_string($db,$_POST['period']);
      $period = sanitize($period);
      $description = mysqli_real_escape_string($db,$_POST['desc']);
      $description = sanitize($description);
      $user_id = sanitize($_SESSION['Client']);


      if(empty($maintenance)){
        $errors[] .= 'Please select service.';
      }
      if($service=='other'&&empty($specify)){
        $errors[] .= 'Please specify.';
      }
      if(empty($frequency)){
        $errors[] .= 'Please select frequency.';
      }
      if(empty($period)){
        $errors[] .= 'Please select period.';
      }
      if(!empty($errors)){
        $mr_display = display_errors($errors);
      }
      else{
        #remember for live server
        echo  $mr_query = "INSERT INTO maintenance(user_id,maintenance,description,request_date,request_status,frequency,period,end_date)
        VALUES('{$user_id}','{$maintenance}','{$description}',NOW(),'0','{$frequency}','{$period}',NULL)";
        mysqli_query($db,$mr_query);
        header('Location: request.php');
      }
    }
 ?>
