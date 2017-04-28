<?php
#retrieve departments from Database
$sql = "SELECT * FROM departments ORDER BY department";
$query = mysqli_query($db, $sql);
$allDepartments = '';
while($departments = mysqli_fetch_assoc($query)):
      $allDepartments .= '<tr>
                      <td>'.$departments['department'].'</td>
                      <td>'.$departments['email'].'</td>
                      <td>
                        <a href="departments.php?edit='.$departments['department_id'].'" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil text-primary"></span></a>
                        <a href="departments.php?delete='.$departments['department_id'].'" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                      </td>
                    </tr>';
endwhile;
#insert new department
if(isset($_POST['Add'])){
  if($_POST['department'] == ''){
    $errors[] .= 'You must enter a department!';
  }
  #check if department exists
  $department=mysqli_real_escape_string($db, $_POST['department']);
  $department = sanitize($department);
  $email=mysqli_real_escape_string($db, $_POST['email']);
  $email = sanitize($email);
  $ver_sql="SELECT * FROM departments WHERE department = '$department'";
  $ver_query = mysqli_query($db, $ver_sql);
  $count = mysqli_num_rows($ver_query);
  if($count>0){
    $errors[] .= '<strong>'.$department.'</strong> already exists. Please choose another department name...';
  }
  #display errors
  if(!empty($errors)){
    echo display_errors($errors);
  }
  else{
    $write_query="INSERT INTO departments(department,email) VALUES('{$department}','{$email}')";
    mysqli_query($db, $write_query);
    header('Location: departments.php');
  }
}
#remove department
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id= mysqli_real_escape_string($db, $_GET['delete']);
  $delete_id = (int)($delete_id);
  $delete_id = sanitize($delete_id);

  #find & delete all services under department
  $service_query = "DELETE FROM services WHERE department = '$delete_id'";
  mysqli_query($db, $service_query);
  #delete department
  $del_sql = "DELETE FROM departments WHERE department_id = '$delete_id'";
  mysqli_query($db, $del_sql);
  header('Location: departments.php');
}
#edit department
if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
  $edit_id = (int)$edit_id;
  $edit_id = sanitize($edit_id);
  $edit_sql = "SELECT * FROM departments WHERE department_id = '$edit_id'";

  $edit = mysqli_query($db, $edit_sql);
  $edit_res = mysqli_fetch_assoc($edit);
  $department = $edit_res['department'];
  $email = $edit_res['email'];

  if(isset($_POST['Edit'])){
    $department = mysqli_real_escape_string($db, $_POST['department']);
    $department = sanitize($department);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $email = sanitize($email);
    #check if no other department matches information
    $query = "SELECT * FROM departments WHERE department='$department' AND department_id !='$edit_id'";
    $query_result = mysqli_query($db,$query);
    $rows = mysqli_num_rows($query_result);
    if($rows>0){
      $errors[] .= '<strong>'.$department.'</strong> already exists. Please choose a different name...';
      echo display_errors($errors);
    }
    else{
        $edit_query = "UPDATE departments SET department = '$department', email = '$email' WHERE department_id='$edit_id'";
        $upadte = mysqli_query($db, $edit_query);
        header('Location: departments.php');
      }
  }
}
 ?>
