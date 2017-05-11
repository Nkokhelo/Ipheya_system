<?php
#to be removed
$log = new Logic();
#add roles
    if(isset($_POST['Add']))
    {
      $role = mysqli_real_escape_string($db,$_POST['company-role']);
      $role = sanitize($role);

      if(empty($role))
      {
        $errors[] .= 'Role cannot be left empty';
      }
      if(!empty($errors))
      {
        echo display_errors($errors);
      }
      #check if role exists
      $check_role = "SELECT * FROM roles WHERE name = '$role'";
      $check_role_exe = mysqli_query($db,$check_role);
      $check_role_count = mysqli_num_rows($check_role_exe);

      if($check_role_count > 0)
      {
        $errors[] .= 'Role already exists please choose another name';
      }
      else 
      {
        $insert_new_role = "INSERT INTO roles(name) VALUES('{$role}')";
        mysqli_query($db,$insert_new_role);
        header('Location: roles.php?add=1');
      }
    }

#assign user to role by Nkokhelo
    if(isset($_POST['Assign']))
    {
      #Senatizing
      $role_id = mysqli_real_escape_string($db,$_POST['role']);
      $role_id = sanitize($role_id);
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $email = sanitize($email);

      #check for nulls in ipput
      if(empty($email))
      {
        $errors[] .= 'Please enter email address of employee';
      }
      if(!empty($errors))
      {
        echo display_errors($errors);
      }
       $roleName = $log->getRoleNameById($role_id);
       $log->addUserToRole($email,$roleName);

    }

#remove role from employee
    if(isset($_GET['remove']))
    {
      $remove_id = mysqli_real_escape_string($db, $_GET['remove']);
      $remove_id = (int)$remove_id;
      $remove_id = sanitize($remove_id);

      $role_id = mysqli_real_escape_string($db, $_GET['remove']);
      $role_id = (int)$remove_id;
      $role_id = sanitize($remove_id);


      $User = $log->getUserById($remove_id);
      $email = $User['Email'];

      #select roles belonging to employee
      $roles =$log->getUserRolesByUserId($remove_id);
      $allEmployeeRoles = '';
      for($i=0; $i<count($roles); $i++)
      {
        $allEmployeeRoles .='<option value="'.$log->getRoleIdByName($roles[$i]).'">'.$roles[$i].'</option>';
      }
      if(isset($_POST['Remove']))
      {
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $email = sanitize($email);
        $role_id = mysqli_real_escape_string($db,$_POST['role']);
        $role_id = sanitize($role_id);
        if(empty($email))
        {
          $errors[] .= 'Please enter email of employee';
        }
        if(empty($role_id))
        {
          $errors[] .= 'Something went wrong when selecting the role.';
        }
        if(!empty($errors))
        {
          echo display_errors($errors);
        }
        else
        {
          $remove_role = "DELETE FROM userroles WHERE Role_Id = '$role_id' AND User_Id = '$remove_id'";
          mysqli_query($db,$remove_role);
          header('Location: roles.php');
        }
      }
    }
#edit roles
    if(isset($_GET['edit']) && !empty($_GET['edit']))
    {
      $edit_id = mysqli_real_escape_string($db, $_GET['edit']);
      $edit_id = (int)$edit_id;
      $edit_id = sanitize($edit_id);

      $role_to_edit = "SELECT * FROM roles WHERE Role_Id = '$edit_id'";
      $r_t_e = mysqli_query($db,$role_to_edit);
      $company_role = mysqli_fetch_assoc($r_t_e);
      $role_val = $company_role['company_role'];

      if(isset($_POST['Edit']))
      {
        $role = mysqli_real_escape_string($db,$_POST['company-role']);
        $role = sanitize($role);

       #check if role exists
        $check_role = "SELECT * FROM roles WHERE name = '$role' AND Role_Id != '$edit_id'";
        $check_role_exe = mysqli_query($db,$check_role);
        $check_role_count = mysqli_num_rows($check_role_exe);

        if($check_role_count > 0)
        {
          $errors[] .= 'Role already exists please choose another name';
        }
        if(empty($role))
        {
          $errors[] .= 'Role cannot be left empty';
        }
        if(!empty($errors))
        {
          echo display_errors($errors);
        }
        else 
        {
          $update_role = "UPDATE roles SET name = '$role' WHERE Role_Id = '$edit_id'";
          mysqli_query($db,$update_role);
          header('Location: roles.php?add=1');
        }
      }
    }
#delete company role
    if(isset($_GET['delete']))
    {
      $delete_id = mysqli_real_escape_string($db,$_GET['delete']);
      $delete_id = (int)$delete_id;
      $role_name = "SELECT * FROM roles WHERE Role_Id = '$delete_id'";
      $role_name_exe = mysqli_query($db,$role_name);
      $role_name_result = mysqli_fetch_assoc($role_name_exe);
      $r_name = $role_name_result['company_role'];

      #delete employee roles corresponding to selected role
      $del_dependencies = "DELETE FROM userroles WHERE Role_Id = '$delete_id'";
      mysqli_query($db,$del_dependencies);
      #delete selected role from company_roles
      $delete_sql = "DELETE FROM roles WHERE Role_id = '$delete_id'";
      mysqli_query($db,$delete_sql);
      header('Location: roles.php?add=1');
    }

#fetch all roles
    $allCompanyRoles_tbl = '';
    $allCompanyRoles = '<option value="">Select role</option>';
    $company_role_query = "SELECT * FROM roles ORDER BY name";
    $company_role_exe = mysqli_query($db,$company_role_query);
    while($company_role = mysqli_fetch_assoc($company_role_exe)) :
      $allCompanyRoles .='<option value="'.$company_role['Role_Id'].'">'.$company_role['Name'].'</option>';
      $allCompanyRoles_tbl .='<tr>
                                 <td>'.$company_role['Role_Id'].'</td>
                                 <td>'.$company_role['Name'].'</td>
                                 <td>
                                 <a href="roles.php?edit='.$company_role['Role_Id'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-pencil "></span></a>
                                 <a href="roles.php?delete='.$company_role['Name'].'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                                 </td>
                              </tr>';
    endwhile;
#fetch all employees
    $employee_query = "SELECT * FROM employees ORDER BY surname";
    $employee_exe = mysqli_query($db,$employee_query);
    $allEmployees = '';
    while($employees = mysqli_fetch_assoc($employee_exe)) :
      $empemail = $employees['email'];
      $userid = $log->getUserIdByEmail($employees['email']);
      $roles = $log->getUserRolesByUserId($userid);
      $roles_array = '';
      for($i=0; $i<count($roles);$i++)
      {
        $roles_array .= $roles[$i].',';
      }
      $roles_array = rtrim($roles_array,',');
      $allEmployees .= '<tr>
                          <td>'.$employees['name'].' '.$employees['surname'].'</td>
                          <td>'.$employees['email'].'</td>
                          <td>'.$roles_array.'</td>
                          <td>
                          <a href="roles.php?remove='.$userid.'" class="btn btn-xs btn-default"> <span class="glyphicon glyphicon-trash"></span></a>
                          </td>
                        </tr>';
    endwhile;
 ?>
