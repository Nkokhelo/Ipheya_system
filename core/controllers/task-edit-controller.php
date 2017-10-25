<?php
  $taskid = mysqli_real_escape_string($db, $_GET['task_id']);
  $task = mysqli_query($db, "SELECT name,date_posted,location,complete,status FROM task WHERE task_id = '$taskid'");
  $data = mysqli_fetch_assoc($task);
  $name = $data['name'];

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
      }
      else{
        echo '<script>console.log("Employee already allocated")</script>';
      }
    }
    /*foreach ($employee as $e) {
      echo '<script>console.log('.$e[$i].')</script>';
    }*/
  }
?>
