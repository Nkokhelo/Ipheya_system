<?php
#get logic class
 $logic = new Logic();
 $feedback ='';
  #save Project
    if(isset($_POST['save_project']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $project_name =$_POST['project_name'];
        $program_no =$_POST['program_no'];
        $description =$_POST['description'];
        $sdate =$_POST['sdate'];
        $employee_no =$_POST['employee_no'];
        $qno =$_POST['q_id'];
        $duration =$_POST['duration'];
        $duration_type=$_POST['duration_type'];
        $department= $_POST ['department'];
        $service=$_POST['service'];
        $budget= $_POST['budget'];
        $no_of_emp=$_POST['no_of_emp'];
        $patner=$_POST['patner'];
        $visibility=$_POST['visibility']; 
        $daily_hour=$_POST['daily_hour'];
        $charge=$_POST['charge'];

        $client_unique = uniqid();
        $project_no ="P00".strtoupper(substr($client_unique,6,4));

        $query ="INSERT INTO `projects` (`id`, `project_no`, `program_no`, `project_name`, `description`, `start_date`, `employee_no`, `duration`, `duration_type`, `department`,`service`,`budget`,`no_of_emp`,`patner`,`visibility`,`daily_hours`,`charge`,`quotation`)
        VALUES(NULL,'$project_no','$program_no','$project_name','$description','$sdate','$employee_no','$duration','$duration_type','$department','$service','$budget','$no_of_emp','$patner','$visibility','$daily_hour','$charge','$qno')";
        $result = mysqli_query($db,$query);
        if(!$result)
        {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Error!</strong>'.mysqli_error($db));
        }
        else
        {
              $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong> Project saved !');
        }
    }
 
 #get all projets
  $query_result = $logic->getallProjets();
  $proj_list ='';
  $error='';
  while($proj = mysqli_fetch_assoc($query_result))
  {
    $proj_list='';
  }
  if($proj_list == '')
  {
    $error = '<div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> No Project at the moment<br/> <a href="createproject.php">Create Project</a></div>';
  }

  #get deoartments
  $department='';
  $query_result = $logic->getallDepartments();
  while($dep = mysqli_fetch_assoc($query_result))
  {
    $department .="<option value='".$dep['department_id']."'>".$dep['department']."</option>";
  }
  # get all programs
   $allprogram='';
   $program_pro="SELECT * FROM programs ORDER BY program_name";
   $program_sql= mysqli_query($db,$program_pro);
   while($pro = mysqli_fetch_assoc($program_sql))
   {
    $allprogram .= '<option value="' .$pro['program_no'].'">' .$pro['program_name'].'</option>';
   }
   #get Quotations
   $allquote='';
   $Quote="SELECT * FROM qoutation ORDER BY Title";
   $Quotatio_sql= mysqli_query($db, $Quote);
   while($Quo = mysqli_fetch_assoc($Quotatio_sql))
   {
    $allquote .= '<option value="' .$Quo['QoutationID'].'">' .$Quo['Title'].'</option>';
   }
   #get All services
   $allServicesDDL = '';
   $ddl_service_sql = "SELECT * FROM services ORDER BY service";
   $general_services = mysqli_query($db,$ddl_service_sql);
   while($g_service = mysqli_fetch_assoc($general_services)):
      $allServicesDDL .= '<option value="'.$g_service['service_id'].'">'.$g_service['service'].'</option>';
   endwhile;
  # find projectmanager

    
?>