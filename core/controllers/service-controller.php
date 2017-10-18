<?php
    // include('../logic.php');
    $logic = new Logic();
    $feedback="";
    $display ="";
#add Service

if(isset($_POST['Add']))
{
  $departmentID = sanitize($_POST['department']);
  $service = mysqli_real_escape_string($db , $_POST['service']);
  $service = $service_name = sanitize($service);
  $num = mysqli_real_escape_string($db , $_POST['number']);
  $type = mysqli_real_escape_string($db , $_POST['type']);
  $min_duration = sanitize($num);
  $type = sanitize($type);
  $min_duration = sanitize($min_duration);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $description = sanitize($description);
  
  #fetch department for data retention
  $dep_result = $logic->getDepartmentById($departmentID);
  $depart_id = $dep_result['department_id'];
  $dep_name = $dep_result['department'];
  // die("24 this is add $depart_id and name is $dep_name");
      #form validation
      
      #if service already exists
      $services  = "SELECT * FROM services WHERE service='$service' AND department='$depart_id'";
      $service_query = mysqli_query($db,$services);
      if(!$service_query)
      {
        die($service);
      }
      $count = mysqli_num_rows($service_query);
      if($count>0)
      {
        $display .= $logic->display_error('<strong>'.$service.'</strong> already exists. Please choose another service or change department');
      }
      #display errors or add category
      
      else
      {
        $feedback=$logic->display_success("Service saved!");
        $insert_service = "INSERT INTO services(service,min_duration,durationType,description,department) VALUES('{$service}','{$min_duration}','{$type}','{$description}','{$depart_id}')";
        mysqli_query($db, $insert_service);
        header('Location: allservices.php');
      }
    }
#edit service
    if(isset($_GET['edit']) && !empty($_GET['edit']))
    {
      $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
      $edit_id = (int)($edit_id);
      $edit_id = sanitize($edit_id);

      $edit_sql = "SELECT * FROM services WHERE service_id = '$edit_id'";
      $edit_result = mysqli_query($db, $edit_sql);
      $service_res = mysqli_fetch_assoc($edit_result);

      $description = $service_res['description'];
      $num = $service_res['min_duration'];
      $type = $service_res['durationType'];
      // die($type);
      $service = $service_name = $service_res['service'];
      $depart_id = $service_res['department'];
      $department_sql = "SELECT * FROM departments WHERE department_id = '$depart_id'";
      $department_exe = mysqli_query($db,$department_sql);
      $department_result = mysqli_fetch_assoc($department_exe);
      $dep_name = $department_result['department'];

      if(isset($_POST['Edit'])){
        $department = sanitize($_POST['department']);
        $service = mysqli_real_escape_string($db , $_POST['service']);
        $service = sanitize($service);
        $num = mysqli_real_escape_string($db , $_POST['number']);
        $type = mysqli_real_escape_string($db , $_POST['type']);
        $min_duration = $num;
        $min_duration = sanitize($min_duration);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $description = sanitize($description);
        #check if no other category matches information
        $query = "SELECT * FROM services WHERE service='$service' AND department = '$department' AND service_id !='$edit_id'";
        $query_result = mysqli_query($db,$query);
        $rows = mysqli_num_rows($query_result);
        if($rows>0){
          $errors[] .= 'The service <strong>'.$service.'</strong> already exists under <strong>'.$department_name.'</strong>.';
        }
        if(!empty($errors)){
          $display = display_errors($errors);
        }
        else{
        $edit_sql = "UPDATE services SET service = '$service', min_duration = '$min_duration',description = '$description', department = '$department' WHERE service_id = '$edit_id'";
        mysqli_query($db,$edit_sql);
        header('Location: allservices.php');
      }
      }
    }
#remove services
    if(isset($_GET['delete']) && !empty($_GET['delete']))
    {
      $delete_id= mysqli_real_escape_string($db, $_GET['delete']);
      $delete_id = (int)$delete_id;
      $delete_id = sanitize($delete_id);
      $del_sql = "DELETE FROM services WHERE service_id = '$delete_id'";
      mysqli_query($db, $del_sql);
      header('Location: services.php');
    }
#view service
    if(isset($_GET['view']) && !empty($_GET['view']))
    {
      $view_id = mysqli_real_escape_string($db, $_GET['view']);
      $view_id = (int)($view_id);
      $view_id = sanitize($view_id);

      $view_sql = "SELECT * FROM services WHERE service_id = '$view_id'";
      $view_result = mysqli_query($db, $view_sql);
      $service_res = mysqli_fetch_assoc($view_result);

      $description = $service_res['description'];
      $min_duration = $service_res['min_duration'];
      $type = $service_res['durationType'];

      $service = $service_name = $service_res['service'];
      $depart_id = $service_res['department'];
      $department_sql = "SELECT * FROM departments WHERE department_id = '$depart_id'";
      $department_exe = mysqli_query($db,$department_sql);
      $department_result = mysqli_fetch_assoc($department_exe);
      $dep_name = $department_result['department'];

    }
    #fetch all departments as parents
    $sql = "SELECT * FROM departments ORDER BY department";
    $result = mysqli_query($db, $sql);
    $allDepartments ='';
    $allServices = '';
    #display departments
    while($department = mysqli_fetch_assoc($result)) :
      $allDepartments .= '<option value="'.$department['department_id'].'" >'.$department['department'].'</option>';
      #fetch all services under department
      $dep_id = $department['department_id'];
      $service_query = "SELECT * FROM services WHERE department = '$dep_id' ORDER BY service";
      $service_exe = mysqli_query($db,$service_query);
      #display services
      while($service = mysqli_fetch_assoc($service_exe)) :
        $allServices .= '<tr>
                          <td>'.$service['service'].'</td>
                          <td>'.$department['department'].'</td>
                          <td>
                              <a href="services.php?edit='.$service['service_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-pencil "></span></a>
                              <a href="services.php?delete='.$service['service_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                              <a href="services.php?view='.$service['service_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-open"></span></a>
                          </td>
                        </tr>';
      endwhile;
    endwhile;
    #select all services for dropdown lcfirst
    $allServicesDDL = '';
    $ddl_service_sql = "SELECT * FROM services ORDER BY service";
    $general_services = mysqli_query($db,$ddl_service_sql);
    while($g_service = mysqli_fetch_assoc($general_services)):
      $allServicesDDL .= '<option value="'.$g_service['service_id'].'">'.$g_service['service'].'</option>';
    endwhile;
 ?>
