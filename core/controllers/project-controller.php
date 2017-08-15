<?php
#get logic class
 $logic = new Logic();
 
 
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
<<<<<<< HEAD
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
    
=======

  
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
?>