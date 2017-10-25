<?php
  $taskid = mysqli_real_escape_string($db, $_GET['task_id']);
  $projid = mysqli_real_escape_string($db, $_GET['project_id']);
  $task = mysqli_query($db, "SELECT name,date_posted,location,complete,status FROM task WHERE task_id = '$taskid'");
  $data = mysqli_fetch_assoc($task);
  $name = $data['name'];
  $location = $data['location'];

  $emplist = '';
  $assigned = mysqli_query($db, "SELECT employee_id FROM employeetask WHERE task_id = '$taskid'");
  $num = 0;
  while($taskemp = mysqli_fetch_assoc($assigned)):
    $empli = mysqli_query($db, "SELECT name,surname FROM employees WHERE employee_id = '$taskemp[employee_id]'");
    while($empitem = mysqli_fetch_assoc($empli)):
      $num+=1;
      $emplist .= '<tr>
                     <td>'.$num.'</td>
                     <td>'.$empitem['name'].'</td>
                     <td>'.$empitem['surname'].'</td>
                     <td><a class="btn btn-xs btn-danger" href="gantttaskupdate.php?project_id='.$projid.'&task_id='.$taskid.'&delete='.$taskemp['employee_id'].'"><span class="glyphicon glyphicon-remove"></span></a></td>
                 </tr>';
    endwhile;
  endwhile;

  $emp = mysqli_query($db, "SELECT employee_id,name,surname FROM employees");
  $selectemp = '';
  while($employee = mysqli_fetch_assoc($emp)):
    $roles = array();
    $checkrole = mysqli_query($db, "SELECT Role_Id FROM userroles WHERE User_Id = $employee[employee_id]");
    while($role = mysqli_fetch_assoc($checkrole)):
      $rname = mysqli_query($db, "SELECT Name FROM roles WHERE Role_Id = $role[Role_Id]");
      $roleinfo = mysqli_fetch_assoc($rname);
      $roles[] .= $roleinfo['Name'];
    endwhile;
    if(!in_array('Admin',$roles) && !in_array('Manager',$roles))
    {
      $selectemp .= '<option value="'.$employee['employee_id'].'">'.$employee['name'].' '.$employee['name'].'</option>';
    }
  endwhile;

  if(isset($_POST['Assign']))
  {
    $employees = $_POST['employee'];
    $count = count($employees);
    for($i=0;$i<$count;$i++)
    {
      $sql = mysqli_query($db, "SELECT *FROM employeetask WHERE employee_id =  '$employees[$i]' AND task_id = '$taskid'");
      $taskselection = mysqli_num_rows($sql);
      if($taskselection<1)
      {
        $sql = mysqli_query($db, "INSERT INTO employeetask(employee_id,task_id) VALUES('{$employees[$i]}','$taskid')");
        if($sql)
        {
          header('Location: gantttaskupdate.php?project_id='.$projid.'&task_id='.$taskid.'&assign=1');
        }
      }
      else{
        echo '<script>console.log("Employee already allocated")</script>';
      }
    }
   }

   if(isset($_POST['Update']))
   {
     $name = mysqli_real_escape_string($db, $_POST['name']);
     $location = mysqli_real_escape_string($db, $_POST['location']);
     $sql = mysqli_query($db, "UPDATE task SET name = '$name', location = '$location' WHERE task_id = '$taskid'");
     if($sql)
     {
       header('Location: gantttaskupdate.php?project_id='.$projid.'&task_id='.$taskid.'&update=1');
     }
   }

   if(isset($_GET['delete']))
   {
     $empid = mysqli_real_escape_string($db, $_GET['delete']);
     $sql = mysqli_query($db,"DELETE FROM employeetask WHERE employee_id = '$empid' AND task_id = '$taskid'");
     if($sql)
     {
       header('Location: gantttaskupdate.php?project_id='.$projid.'&task_id='.$taskid.'&deleted=1');
     }
     else{
       echo '<script>alert("'.mysqli_error($db).'")</script>';
     }
   }
?>
