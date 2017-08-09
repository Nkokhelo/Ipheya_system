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

  
?>