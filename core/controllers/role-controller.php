<?php
    #add roles
    if(isset($_POST['Add'])){
      $role = mysqli_real_escape_string($db,$_POST['company-role']);
      $role = sanitize($role);

      #check if role exists
      $check_role = "SELECT * FROM company_roles WHERE company_role = '$role'";
      $check_role_exe = mysqli_query($db,$check_role);
      $check_role_count = mysqli_num_rows($check_role_exe);

      if($check_role_count > 0){
        $errors[] .= 'Role already exists please choose another name';
      }
      if(empty($role)){
        $errors[] .= 'Role cannot be left empty';
      }
      if(!empty($errors)){
        echo display_errors($errors);
      }
      else {
        $insert_new_role = "INSERT INTO company_roles(company_role) VALUES('{$role}')";
        mysqli_query($db,$insert_new_role);
        header('Location: roles.php?add=1');
      }
    }
    #assign role to employee
    if(isset($_POST['Assign'])){
      $role_id = mysqli_real_escape_string($db,$_POST['role']);
      $role_id = sanitize($role_id);
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $email = sanitize($email);

      #select role value from company_roles
      $role_sql = "SELECT * FROM company_roles WHERE company_role_id = '$role_id'";
      $role_exe = mysqli_query($db,$role_sql);
      $role_result = mysqli_fetch_assoc($role_exe);
      $role = $role_result['company_role'];
      #check if the role selected does already exist for the employee
      $employee_sql = "SELECT * FROM employees WHERE email='$email'";
      $employee_exe = mysqli_query($db,$employee_sql);
      $employee = mysqli_fetch_assoc($employee_exe);
      $employee_id = $employee['employee_id'];
      $employee_roles_sql = "SELECT * FROM roles WHERE employee_id = '$employee_id' AND email = '$email'";
      $employee_roles_exe = mysqli_query($db,$employee_roles_sql);

      foreach($employee_roles_exe as $existing_role){
        if($existing_role['role'] == $role){
          $errors[] .= 'Role selected already exists for <strong>'.$email.'</strong>';
        }
      }
      if(empty($email)){
        $errors[] .= 'Please enter email address of employee';
      }
      if(!empty($errors)){
        echo display_errors($errors);
      }
      else{
        $insert_roles = "INSERT INTO roles(employee_id,email,role) VALUES('{$employee_id}','{$email}','{$role}')";
        mysqli_query($db,$insert_roles);
        header('Location: roles.php');
      }
    }
    #remove role from employee
    if(isset($_GET['remove'])){
      $remove_id = mysqli_real_escape_string($db, $_GET['remove']);
      $remove_id = (int)$remove_id;
      $remove_id = sanitize($remove_id);

      $employee_sql = "SELECT * FROM employees WHERE employee_id='$remove_id'";
      $employee_exe = mysqli_query($db,$employee_sql);
      $employee = mysqli_fetch_assoc($employee_exe);
      $email = $employee['email'];
      #select roles belonging to employee
      $employee_id = $remove_id;
      $employee_roles_sql = "SELECT * FROM roles WHERE employee_id = '$remove_id' AND email = '$email' ORDER BY role";
      $employee_roles_exe = mysqli_query($db,$employee_roles_sql);
      $allEmployeeRoles = '';
      while($employee_role = mysqli_fetch_assoc($employee_roles_exe)) :
        $allEmployeeRoles .='<option value="'.$employee_role['role_id'].'">'.$employee_role['role'].'</option>';
      endwhile;
      if(isset($_POST['Remove'])){
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $email = sanitize($email);
        $role_id = mysqli_real_escape_string($db,$_POST['role']);
        $role_id = sanitize($role_id);
        if(empty($email)){
          $errors[] .= 'Please enter email of employee';
        }
        if(empty($role_id)){
          $errors[] .= 'Something went wrong when selecting the role.';
        }
        if(!empty($errors)){
          echo display_errors($errors);
        }
        else{
          $remove_role = "DELETE FROM roles WHERE role_id = '$role_id' AND employee_id = '$remove_id' AND email = '$email'";
          mysqli_query($db,$remove_role);
          header('Location: roles.php');
        }
      }
    }
    #edit roles
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
      $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
      $edit_id = (int)$edit_id;
      $edit_id = sanitize($edit_id);

      $role_to_edit = "SELECT * FROM company_roles WHERE company_role_id = '$edit_id'";
      $r_t_e = mysqli_query($db,$role_to_edit);
      $company_role = mysqli_fetch_assoc($r_t_e);
      $role_val = $company_role['company_role'];

      if(isset($_POST['Edit'])){
        $role = mysqli_real_escape_string($db,$_POST['company-role']);
        $role = sanitize($role);

        #check if role exists
        $check_role = "SELECT * FROM company_roles WHERE company_role = '$role' AND company_role_id != '$edit_id'";
        $check_role_exe = mysqli_query($db,$check_role);
        $check_role_count = mysqli_num_rows($check_role_exe);

        if($check_role_count > 0){
          $errors[] .= 'Role already exists please choose another name';
        }
        if(empty($role)){
          $errors[] .= 'Role cannot be left empty';
        }
        if(!empty($errors)){
          echo display_errors($errors);
        }
        else {
          $update_role = "UPDATE company_roles SET company_role = '$role' WHERE company_role_id = '$edit_id'";
          mysqli_query($db,$update_role);
          header('Location: roles.php?add=1');
        }
      }
    }
    #delete company role
    if(isset($_GET['delete'])){
      $delete_id = mysqli_real_escape_string($db,$_GET['delete']);
      $delete_id = (int)$delete_id;
      $role_name = "SELECT * FROM company_roles WHERE company_role_id = '$delete_id'";
      $role_name_exe = mysqli_query($db,$role_name);
      $role_name_result = mysqli_fetch_assoc($role_name_exe);
      $r_name = $role_name_result['company_role'];

      #delete employee roles corresponding to selected role
      $del_dependencies = "DELETE FROM roles WHERE role = '$r_name'";
      mysqli_query($db,$del_dependencies);
      #delete selected role from company_roles
      $delete_sql = "DELETE FROM company_roles WHERE company_role_id = '$delete_id'";
      mysqli_query($db,$delete_sql);
      header('Location: roles.php?add=1');
    }

    #fetch all roles
    $allCompanyRoles_tbl = '';
    $allCompanyRoles = '<option value="">Select role</option>';
    $company_role_query = "SELECT * FROM company_roles ORDER BY company_role";
    $company_role_exe = mysqli_query($db,$company_role_query);
    while($company_role = mysqli_fetch_assoc($company_role_exe)) :
      $allCompanyRoles .='<option value="'.$company_role['company_role_id'].'">'.$company_role['company_role'].'</option>';
      $allCompanyRoles_tbl .='<tr>
                                 <td>'.$company_role['company_role_id'].'</td>
                                 <td>'.$company_role['company_role'].'</td>
                                 <td>
                                 <a href="roles.php?edit='.$company_role['company_role_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-pencil "></span></a>
                                 <a href="roles.php?delete='.$company_role['company_role_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                                 </td>
                              </tr>';
    endwhile;
    #fetch all employees
    $employee_query = "SELECT * FROM employees ORDER BY name";
    $employee_exe = mysqli_query($db,$employee_query);
    $allEmployees = '';
    while($employees = mysqli_fetch_assoc($employee_exe)) :
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
                          <td>'.$roles_array.'</td>
                          <td>
                          <a href="roles.php?remove='.$employees['employee_id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                          </td>
                        </tr>';
    endwhile;
 ?>
