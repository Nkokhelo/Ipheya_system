<?php
#21401824 ME Zenzile
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
        $start_date =$_POST['start_date'];
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
        VALUES(NULL,'$project_no','$program_no','$project_name','$description','$start_date','$employee_no','$duration','$duration_type','$department','$service','$budget','$no_of_emp','$patner','$visibility','$daily_hour','$charge','$qno')";
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
  $status ='';
  while($proj = mysqli_fetch_assoc($query_result))

  {
    if($proj['status']=='complete')
    {
        $status = "<label class='label label-success'>".$proj['status']."</label>";
        $status1 = "<label class='label label-success' title='status: complete'>-</label>";
    }
    else if($proj['status']=='inprogress')
    {
        $status = "<label class='label label-info'>".$proj['status']."</label>";
        $status1 = "<label class='label label-info' title='status: progress'>-</label>";
    }
    else if($proj['status']=='overdue')
    {
        $status = "<label class='label label-warning'>".$proj['status']."</label>";
        $status1 = "<label class='label label-warning' title='status: overdue'>-</label>";
        
    }
    else if($proj['status']=='canceled')
    {
        $status = "<label class='label label-danger'>".$proj['status']."</label>";
        $status1 = "<label class='label label-danger' title='status: canceled'>-</label>";
        
    }
    else
    {
        $status = "<label class='label label-default'>".$proj['status']."</label>";
        $status1 = "<label class='label label-default' title='status: not stated'>-</label>";
        
    }
    $proj_list.="<tr><td>".$proj['project_no']."</td><td>".$status1." ".$proj['project_name']."</td><td>".$proj['duration']."-".$proj['duration_type']."</td><td>".date_format(date_create($proj['end_date']),'d F Y')."</td><td><a href='viewproject.php?pview=".$proj['project_no']."' class='btn btn-sm btn-default'>View <i class='fa fa-eye'></i></a>  <a href='editproject.php?pview=".$proj['project_no']."' class='btn btn-sm btn-default'>Edit <i class='fa fa-pencil'></i></a> <a href='allProjects.php?restore=".$proj['project_no']."'class='btn btn-sm btn-default'>Delete <i class='fa fa-trash-o'></i></a></td></tr>";
  }
  if($proj_list == '')
  {
    $error = '<div class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i> No Project at the moment<br/> <a href="createproject.php">Create Project</a></div>';
  }
#archive
  if(isset($_GET['archived']))
  {
      $prog_list='';
      $result = $logic->getallProject();
      while($project = mysqli_fetch_assoc($result)):
          if($project['archive']==1)
          {
              $prog_list .= "<tr><td>".$project['project_name']."</td><td>".$project['duration']."</td><td>"."</td><td>".$project['end_date']."</td><td>".$project['end_date']."</td><td>".$logic->numOfProject($project['project_no'])."</td>
              <td aling='right'><a href='viewproject.php?view=".$project['project_no']."' class='btn btn-xs btn-default' class='btn btn-xs btn-default'>View <span class='glyphicon glyphicon-eye-open'></span> </a>
              <a class='btn btn-xs btn-default' href='allProjects.php?restore=".$project['project_no']."'>Restore <span class='glyphicon glyphicon-refresh'></span></a> </td></tr>  ";
          }
      endwhile;
  }
  if(isset($_GET['restore']))
  {
      $proj_no =$_GET['restore'];
      $query = mysqli_query($db,"UPDATE `project` SET `archive` = 0 WHERE `projects`.`project_no` ='$proj_no'");
      // die("UPDATE `programs` SET `archive` = 0 WHERE `programs`.`program_no` =$prog_no");
      if(!$query)
      {
          $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Error :</strong> occured during execution<br/>'.mysqli_error($db));
      }
      else
      {
          $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-ok"></span>Success :</strong>Program has been Unachived! <a href="allProjects.php">View Programs?</a>');
      }
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
  #update project
if(isset($_GET['pview']))
{
    $pid = $_GET['pview'];
    $pquery = mysqli_query($db, "SELECT * FROM projects WHERE project_no = '$pid'");
    $presult = mysqli_fetch_assoc($pquery);
    if(isset($_POST['edit']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $project_name =$_POST['project_name'];
        $description =$_POST['description'];
        $duration =$_POST['duration'];
        $start_date =$_POST['start_date'];
        $patner =$_POST['patner'];
        $budget =$_POST['budget'];
        $charge =$_POST['charge'];
        $daily_hours =$_POST['daily_hours'];
        $visibility =$_POST['visibility'];

        if(($project_name||$description||$sdate||$patner||$budget||$Charge||$daily_hour||$Visibility)=='')
        {
            $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-alert"></span> Please fill up all forms');
        }
        else
        {
            $query = mysqli_query($db,"UPDATE `projects` SET `project_name` ='$project_name',`description`='$description', `duration`='$duration', `start_date`='$start_date', `patner`='$patner', `budget`='$budget', `charge`='$charge', `daily_hours`='$daily_hours', `visibility`='$visibility' WHERE project_no='$pid'");
            if(!$query)
            {

                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Success :</strong> occured during execution<br/>Please try again'.mysqli_error($db));
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Project updated succesfull');
            }
        }
    }
}

?>
