<?php
    #add employee
    if(isset($_POST['Add'])){
      $department = mysqli_real_escape_string($db, $_POST['department']);
      $department = sanitize($department);
      $name = mysqli_real_escape_string($db, $_POST['name']);
      $name = sanitize($name);
      $surname = mysqli_real_escape_string($db, $_POST['surname']);
      $surname = sanitize($surname);
      $title = mysqli_real_escape_string($db, $_POST['title']);
      $title = sanitize($title);
      $gender = mysqli_real_escape_string($db, $_POST['gender']);
      $gender = sanitize($gender);
      $number = mysqli_real_escape_string($db, $_POST['number']);
      $number = sanitize($number);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $email = sanitize($email);
      $date = mysqli_real_escape_string($db, $_POST['date']);
      $date = sanitize($date);
      $identity = mysqli_real_escape_string($db, $_POST['identity']);
      $identity = sanitize($identity);
      $postal = mysqli_real_escape_string($db, $_POST['postal']);
      $postal = sanitize($postal);
      $residential = mysqli_real_escape_string($db, $_POST['residential']);
      $residential = sanitize($residential);
      $password = 'password01';
      $token = 'e';

      #prepare department for data retention
      $depart_query = "SELECT * FROM departments WHERE department_id = '$department'";
      $depart_exe = mysqli_query($db,$depart_query);
      $depart_info = mysqli_fetch_assoc($depart_exe);
      $depart_name = $depart_info['department'];
      $depart_id = $depart_info['department_id'];

      if(empty($department)){
        $errors[] .= 'department field is required';
      }
      if(empty($name)){
        $errors[] .= 'name field is required';
      }
      if(empty($surname)){
        $errors[] .= 'last name field is required';
      }
      if(empty($title)){
        $errors[] .= 'title field is required';
      }
      if(empty($gender)){
        $errors[] .= 'gender field is required';
      }
      if($title == 'Mr.' && $gender!='Male' || $title == 'Mrs.' && $gender!='Female' || $title == 'Ms.' && $gender!='Female'){
        $errors[] .= 'The title does not correspond with the gender selected';
      }
      if(empty($number)){
        $errors[] .= 'contact number is required';
      }
      if(empty($email)){
        $errors[] .= 'email address is required';
      }
      if(empty($date)){
        $errors[] .= 'date of birth is required';
      }
      if(empty($identity)){
        $errors[] .= 'indentity number is required';
      }
      if(!empty($errors)){
        $display = display_errors($errors);
      }
      else{
        echo $ins_employee = "INSERT INTO employees(name,surname,title,date_of_birth,gender,email,phone_number,identity_number,postal_address,residential_address,department,password,token)
        VALUES('{$name}','{$surname}','{$title}','{$date}','{$gender}','{$email}','{$number}','{$identity}','{$postal}','{$residential}','{$department}','{$password}','{$token}')";
         mysqli_query($db,$ins_employee);
         header('Location: employees.php');
      }
    }
    #delete employee
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
      $tbl_display = '';
      $delete_id = mysqli_real_escape_string($db, $_GET['delete']);
      $delete_id = (int)$delete_id;
      $delete_id = sanitize($delete_id);

      $admin_query = "SELECT * FROM employees WHERE employee_id = '$delete_id'";
      $admin_exe = mysqli_query($db, $admin_query);
      $admin_check = mysqli_fetch_assoc($admin_exe);
      $emp_id = $admin_check['employee_id'];
      $emp_email = $admin_check['email'];
      $roles_query = "SELECT * FROM roles WHERE employee_id = '$emp_id' AND email = '$emp_email'";
      $roles_exe = mysqli_query($db,$roles_query);
      while($roles_res = mysqli_fetch_assoc($roles_exe)){
        if($roles_res['role'] != 'Admin'){
        }
        else{
          $errors[] .= 'Cannot delete admin, please remove role and try again';
        }
      }
      if(!empty($errors)){
        $tbl_display = display_errors($errors);
      }
      else{
        $del_sql = "DELETE FROM employees WHERE employee_id = '$delete_id'";
        mysqli_query($db, $del_sql);
        header('Location: employees.php');
      }
    }
    #edit employee
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
      $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
      $edit_id = (int)($edit_id);
      $edit_id = sanitize($edit_id);
      #retrieve employee
      $edit_sql = "SELECT * FROM employees WHERE employee_id = '$edit_id'";
      $edit_result = mysqli_query($db, $edit_sql);
      $employee_res = mysqli_fetch_assoc($edit_result);
      #retrieve department corresponding to department field in employee
      $employee = $employee_name = $employee_res['name'];
      $depart_id = $employee_res['department'];
      $department_sql = "SELECT * FROM departments WHERE department_id = '$depart_id'";
      $department_exe = mysqli_query($db,$department_sql);
      $department_result = mysqli_fetch_assoc($department_exe);
      #display results
      $depart_name = $department_result['department'];
      $name = $employee_res['name'];
      $surname = $employee_res['surname'];
      $title = $employee_res['title'];
      $gender = $employee_res['gender'];
      $number = $employee_res['phone_number'];
      $email = $employee_res['email'];
      $date = $employee_res['date_of_birth'];
      $identity = $employee_res['identity_number'];
      $residential = $employee_res['residential_address'];
      $postal = $employee_res['postal_address'];

      if(isset($_POST['Edit'])){
        $department = mysqli_real_escape_string($db, $_POST['department']);
        $department = sanitize($department);
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $name = sanitize($name);
        $surname = mysqli_real_escape_string($db, $_POST['surname']);
        $surname = sanitize($surname);
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $title = sanitize($title);
        $gender = mysqli_real_escape_string($db, $_POST['gender']);
        $gender = sanitize($gender);
        $number = mysqli_real_escape_string($db, $_POST['number']);
        $number = sanitize($number);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $email = sanitize($email);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $date = sanitize($date);
        $identity = mysqli_real_escape_string($db, $_POST['identity']);
        $identity = sanitize($identity);
        $postal = mysqli_real_escape_string($db, $_POST['postal']);
        $postal = sanitize($postal);
        $residential = mysqli_real_escape_string($db, $_POST['residential']);
        $residential = sanitize($residential);
        #check if no other category matches information
        $query = "SELECT * FROM employees WHERE email='$email' AND identity_number = '$identity' AND employee_id !='$edit_id'";
        $query_result = mysqli_query($db,$query);
        $rows = mysqli_num_rows($query_result);
        if($rows>0){
          $errors[] .= 'This employee already exists.';
        }
        if(!empty($errors)){
          $display = display_errors($errors);
        }
        else{
        $edit_sql = "UPDATE employees SET name = '$name', surname = '$surname',title = '$title', date_of_birth = '$date',email = '$email',phone_number = '$number',identity_number = '$identity',postal_address = '$postal',residential_address = '$residential',department = '$department' WHERE employee_id = '$edit_id'";
        mysqli_query($db,$edit_sql);
        header('Location: employees.php');
        }
      }
    }
    #fetch all departments
    $sql = "SELECT * FROM departments ORDER BY department";
    $result = mysqli_query($db, $sql);
    $allDepartments ='';
    while($department = mysqli_fetch_assoc($result)) :
      $allDepartments .= '<option value="'.$department['department_id'].'" >'.$department['department'].'</option>';
    endwhile;

    #fetch all employees
    $employee_query = "SELECT * FROM employees ORDER BY name";
    $employee_exe = mysqli_query($db,$employee_query);
    $allEmployees = '';
    while($employees = mysqli_fetch_assoc($employee_exe)) :
      #select employee department
      $depart_var = $employees['department'];
      $find_depart = $db->query("SELECT * FROM departments WHERE department_id = '$depart_var'");
      $depart_result = mysqli_fetch_assoc($find_depart);
      #fetch employee roles
      $emp_id = $employees['employee_id'];
      $emp_email = $employees['email'];
      $roles_query = "SELECT * FROM roles WHERE employee_id = '$emp_id' AND email = '$emp_email'";
      $roles_exe = mysqli_query($db,$roles_query);
      $roles_array = '';
      while($roles_res = mysqli_fetch_assoc($roles_exe)){
        $roles_array .= $roles_res['role'].',';
      }
      $roles_array = rtrim($roles_array,',');
       $allEmployees .= '<tr>
                            <td>'.$employees['name'].' '.$employees['surname'].'</td>
                            <td>'.$depart_result['department'].'</td>
                            <td>'.$roles_array.'</td>
                            <td>
                            <a href="employees.php?edit='.$employees['employee_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-pencil "></span></a>
                            <a href="employees.php?delete='.$employees['employee_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>';
    endwhile;
?>
