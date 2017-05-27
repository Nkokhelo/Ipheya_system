<?php
    $log = new Logic();
#add employee
    if(isset($_POST['Add']))
    {
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

      if(empty($department))
      {
        $errors[] .= 'department field is required';
      }
      if(empty($name))
      {
        $errors[] .= 'name field is required';
      }
      if(empty($surname))
      {
        $errors[] .= 'last name field is required';
      }
      if(empty($title))
      {
        $errors[] .= 'title field is required';
      }
      if(empty($gender))
      {
        $errors[] .= 'gender field is required';
      }
      if($title == 'Mr.' && $gender!='Male' || $title == 'Mrs.' && $gender!='Female' || $title == 'Ms.' && $gender!='Female')
      {
        $errors[] .= 'The title does not correspond with the gender selected';
      }
      if(empty($number))
      {
        $errors[] .= 'contact number is required';
      }
      if(empty($email))
      {
        $errors[] .= 'email address is required';
      }
      if(empty($date))
      {
        $errors[] .= 'date of birth is required';
      }
      if(empty($identity))
      {
        $errors[] .= 'indentity number is required';
      }
      if($log->getUserIdByEmail($email)>0)
      {
          $errors[] .= 'This email already exist on the system';
      }
       if(!empty($errors))
      {
        $display = display_errors($errors);
      }
      else
      {
         #generating unique employee number
        $date = date('Y-m-d');//we take a date
        $client_unique = uniqid();//generate unique id
        $emp_no ="E".substr($date,2,2).substr($date,0,2).strtoupper(substr($client_unique,4,4));//create new client no by date and unique values by miniseconds
        
        $ins_employee = "INSERT INTO employees(employee_no,name,surname,title,date_of_birth,gender,email,phone_number,identity_number,postal_address,residential_address,department,password,token)
         VALUES('{$emp_no}','{$name}','{$surname}','{$title}','{$date}','{$gender}','{$email}','{$number}','{$identity}','{$postal}','{$residential}','{$department}','{$password}','{$token}')";
         
         if(mysqli_query($db,$ins_employee))
         {
            $addtoUserSQL="INSERT INTO Users VALUES(NULL,'$email','$email',true,'Ipheya@2017')";
            $addtoUser = mysqli_query($db,$addtoUserSQL);
            if(!$addtoUser)
            {
              $errors[].="Error in add to user at emplyee controller ".mysqli_error($db);
            }
         }
         $employee_added = $log->addUserToRole($email,"Employee");
         if($employee_added==false)
         {
            $errors[].="employee was not added to roles";
         }
         header('Location: employees.php');
      }
    }
#delete employee
    if(isset($_GET['delete']) && !empty($_GET['delete']))
    {
      $tbl_display = '';
      $delete_id = mysqli_real_escape_string($db, $_GET['delete']);
      $delete_id = (int)$delete_id;
      $delete_id = sanitize($delete_id);

      $employee = mysqli_fetch_assoc($log->getEmployeeById($delete_id));
      $empEmail= $employee["email"];
      $userRole =$log->getUserRoleByUserEmail($empEmail);
      if($userRole =="Admin")
      {
        $error[].="Cannot delete this role employee";
      }
      if(!empty($errors))
      {
        $tbl_display = display_errors($errors);
      }
      else
      {
        $del_sql = "DELETE FROM employees WHERE employee_id = '$delete_id'";
        mysqli_query($db, $del_sql);
        $role_ID = $log->getRoleIdByName($userRole);
        $del_emp_role = "DELETE FROM userroles WHERE Role_id =$role_ID ";
        mysqli_query($db, $del_sql);
        header('Location: employees.php');
      }
    }
#edit employee
    if(isset($_GET['edit']) && !empty($_GET['edit']))
    {
      $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
      $edit_id = (int)($edit_id);
      $edit_id = sanitize($edit_id);
      #retrieve employee
      $employee_res = mysqli_fetch_assoc($log->getEmployeeById($edit_id));
      #retrieve department corresponding to department field in employee
      $department_result = $log->getDepartmentById($employee_res['department']);
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

      if(isset($_POST['Edit']))
      {
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
        if($rows>0)
        {
          $errors[] .= 'This employee already exists.';
        }
        if(!empty($errors))
        {
          $display = display_errors($errors);
        }
        else
        {
        $edit_sql = "UPDATE employees SET name = '$name', surname = '$surname',title = '$title', date_of_birth = '$date',email = '$email',phone_number = '$number',identity_number = '$identity',postal_address = '$postal',residential_address = '$residential',department = '$department' WHERE employee_id = '$edit_id'";
        mysqli_query($db,$edit_sql);
        header('Location: employees.php');
        }
      }
    }
    
    #fetch all departments
    $result = $log->getallDepartments();
    $allDepartments ='';
    while($department = mysqli_fetch_assoc($result)) :
      $allDepartments .= '<option value="'.$department['department_id'].'" >'.$department['department'].'</option>';
    endwhile;

#fetch all employees
    $employee_exe = $log->getallEmployees();
    $allEmployees = '';
    while($employees = mysqli_fetch_assoc($employee_exe)) :
      #select employee department
      $depart_result = $log->getDepartmentById($employees['department']);
      #fetch employee roles
      $emp_email = $employees['email'];
      $roles =$log->getUserRolesByUserId($log->getUserIdByEmail($emp_email));

      if(!$employee_exe)
      {
        die("Error ".mysqli_error($db));
      }
      $roles_array = '';
       for($i=0; $i<count($roles);$i++)
        {
               $roles_array .= $roles[$i].",";
        }
        
       $roles_array = rtrim($roles_array,',');
       $allEmployees .= '<tr>
                            <td>'.$depart_result['department'].'</td>
                            <td>'.$employees['emp_no'].'</td>
                            <td>'.$employees['title'].' '.substr($employees['name'],0,1).' '.$employees['surname'].'</td>
                            <td>'.$roles_array.'</td>
                            <td>
                            <a href="employees.php?edit='.$employees['employee_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-pencil "></span></a>
                            <a href="employees.php?delete='.$employees['employee_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>';
    endwhile;
?>
