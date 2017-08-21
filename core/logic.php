<?php
    class Logic
    {
        public function Logic()
        {
            return true;
        }
        public function connect()
        {
            return mysqli_connect('localhost','root','','ipheya');
        }

# Employees
        public function getallEmployees()
        {
            $sql ="SELECT * FROM employees";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
         public function allEmployees()
        {
            $allemployees='';
            $sql ="SELECT * FROM employees";
            $qey =mysqli_query($this->connect(),$sql);
            while($all = mysqli_fetch_assoc($qey))
            {
                $allemployees = $all;
            }
            return $allemployees;
        }

        public function getEmployeeByEmpNo($emp_no)
        {
            $employee='';
            $result = $this->getallEmployees();
            while($employees = mysqli_fetch_assoc($result))
            {
                if($employees['emp_no']== $emp_no)
                {
                    $employee = $employees;
                }
            }
            return $employee;
        }

        public function getEmployeeById($id)
        {
            $sql ="Select * from employees where employee_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getEmployeeNameById($id)
        {
            $sql ="Select * from employees where employee_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            $name ='';
            while($employee= mysqli_fetch_assoc($qey))
            {
                $name =$employee['name'];
            }
            return $name;
        }

        public function getEmployeeByEmail($email)
        {
            $sql ="Select * from employees where email='$email'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }

# Client
        public function getallClients()
        {
            $sql ="SELECT * FROM clients";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getClientNo($id)
        {
            $sql ="SELECT * FROM clients WHERE client_id = $id";
            $qey =mysqli_query($this->connect(),$sql);
            return mysqli_fetch_row($qey)[1];
        }
        public function getUnachivedClients()
        {
            $sql ="SELECT * FROM clients WHERE archived = 0 ORDER BY name";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }

         public function getAchivedClients()
        {
            $sql ="SELECT * FROM clients WHERE archived = 1 ORDER BY name";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getClientsById($id)
        {
            $sql ="Select * from clients where client_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getClientByNo($no)
        {
            
            $sql ="Select * from clients where client_no='$no'";
            $qey =mysqli_query($this->connect(),$sql);
            return mysqli_fetch_assoc($qey);
        }        
        public function getClientByIdNo($no)
        {
            $result = $this->getallClients();
            $client ='';
            while($clientdata = mysqli_fetch_assoc($result))
            {
                if($no = $clientdata['client_id'])
                {
                    $client = $clientdata;
                }
            }
            return $client;
        }
        public function getClientByEmail($email)
        {
            $sql ="Select * from clients where email='$email'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getClientNameById($id)
        {
            $sql ="Select * from clients where client_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            $clientName = mysqli_fetch_row($qey)[1];
            $names=explode(" ",$clientName);
            return $names[0];
        }
         public function getClientIdByEmail($email)
        {
            $sql ="Select * from clients where email='$email'";
            $qey =mysqli_query($this->connect(),$sql);
            $clientID = mysqli_fetch_row($qey)[0];
            return $clientID;
        }
        public function getSupplierNameById($id)
        {
            $sql ="Select * from suppliers where supplier_no='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            $supplierName = mysqli_fetch_row($qey)[1];
            return $supplierName;
        }
        public function Login($email,$password)
        {
            #since we hashed a password we have to verify a user password with a hashed one
            #step 1 we will selecte a record by email
            $login = "SELECT * FROM users WHERE email = '$email'";
            $login_exe = mysqli_query($this->connect(),$login);
            #step 2 we will check if password and hash password match
            #2.1 get user
            $user = mysqli_fetch_assoc($login_exe);
            #2.2 get hashed password
            $hash =$user['Password'];
            #2.3 compare the user input with the one from database
            if(!password_verify($password,$hash))
            {
                #2.3if it doesn't macth we give a null record to client ti make cound be less than 1
                $login = "SELECT * FROM users WHERE email = 'nullemail'";
                $login_exe = mysqli_query($this->connect(),$login);
                return $login_exe;
            }
            #2.4 if they match we log user in fair enough???
            $login_exe = mysqli_query($this->connect(),$login);
            return  $login_exe;
        }

# Roles and Users
        public function getUserRoleByUserId($id)
        {
           $UserRoleSQL= mysqli_query($this->connect(),"SELECT * FROM userroles WHERE User_Id = '$id'");
           $UserRoleId = mysqli_fetch_row($UserRoleSQL)[0];
           $roleSQL = mysqli_query($this->connect(),"SELECT * FROM roles WHERE Role_Id ='$UserRoleId'");
           $RoleName = mysqli_fetch_row($roleSQL)[1];
           return $RoleName;
        }

        public function getRoleNameById($id)
        {
            $UserRoleSQL= mysqli_query($this->connect(),"SELECT * FROM roles WHERE Role_Id = '$id'");
            $roleName = mysqli_fetch_row($UserRoleSQL)[1];
            return  $roleName;
        }
        public function getUserRolesByUserId($id)
        {
           $UserRoleSQL= mysqli_query($this->connect(),"SELECT * FROM userroles WHERE User_Id = '$id'");
           $RoleNames=array ();
           while($User = mysqli_fetch_row($UserRoleSQL))
           {
                 $RoleNames[] = $this->getRoleNameById($User[0]);
           }
           return $RoleNames;
        }

        public function getUserById($id)
        {
            $user =mysqli_query($this->connect(),"SELECT * FROM Users WHERE User_Id ='$id'");
            $User=mysqli_fetch_assoc($user);
            return  $User;
        }
        public function getUserByEmail($email)
        {
            $user =mysqli_query($this->connect(),"SELECT * FROM Users WHERE email ='$email'");
            $UserID=mysqli_fetch_assoc($user);
            return  $UserID;
        }
        public function getUserIdByEmail($email)
        {
            $user =mysqli_query($this->connect(),"SELECT * FROM Users WHERE email ='$email'");
            $UserID=mysqli_fetch_row($user)[0];
            return  $UserID;
        }

        public function getRoleIdByName($roleName)
        {
             $rolequery =mysqli_query($this->connect(),"SELECT * FROM roles WHERE Name='$roleName'");
             $roleID = mysqli_fetch_row($rolequery)[0];
             return $roleID;
        }


        public function getUserRoleByUserEmail($email)
        {
            $UserRole = $this->getUserRoleByUserId($this->getUserIdByEmail($email));
            return $UserRole;
        }

        public function addUserToRole($email,$roleName)
        {
             $roleId = $this->getRoleIdByName($roleName);
             $userId = $this->getUserIdByEmail($email);//email is unique if ==0 user does not exist
             if($userId!=0)
             {
                if(!mysqli_query($this->connect(),"INSERT INTO userroles VALUES ($roleId,$userId)"))
                {
                    return false;
                }
                return true;
             }
        }

# Departments
         public function getallDepartments()
        {
            $sql ="SELECT * FROM departments";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getDepartmentById($id)
        {
            $sql ="SELECT * FROM departments WHERE department_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            $dep = mysqli_fetch_assoc($qey);
            return  $dep;
        }
        public function getDepartmentByName($empDepartment)
        {
            $sql ="SELECT * FROM departments WHERE department='$empDepartment'";
            $qey =mysqli_query($this->connect(),$sql);
            $dep = mysqli_fetch_assoc($qey);
            return $dep;
        }
         public function getDepartmentNameByID($id)
        {
            $name ='';
            $sql ="SELECT * FROM departments WHERE department_id=$id";
            $qey =mysqli_query($this->connect(),$sql);
            while($department = mysqli_fetch_assoc($qey))
            {
                $name = $department['department'];
            }
            return $name;
        }
# ClientRequest
        public function getallServiceRequest()
        {
            $query ="SELECT * FROM servicerequest";
            $qey =mysqli_query($this->connect(),$query);
            return $qey;
        }
        public function getallMaintananceRequest()
        {
            $query ="SELECT * FROM maintenancerequest";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
        public function getallSurveyRequest()
        {
            $query ="SELECT * FROM technicalobservation";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
        public function getallRepairRequest()
        {
            $query ="SELECT * FROM repairrequest";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
         public function getServiceRequestById($id)
        {
            $query ="SELECT * FROM servicerequest WHERE RequestID =$id";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
        public function getMaintananceRequestById($id)
        {
            $query ="SELECT * FROM maintenancerequest WHERE RequestID =$id";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
        public function getSurveyRequestById($id)
        {
            $query ="SELECT * FROM technicalobservation WHERE RequestID =$id";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }
        public function getRepairRequestById($id)
        {
            $query ="SELECT * FROM repairrequest WHERE RequestID =$id";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
            return $qey;
        }

#services
        public function getallServices()
        {
            $sql ="SELECT * FROM services";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
        public function getServiceIdByName($serviceName)
        {
            $serviceSql = "SELECT * FROM services WHERE service =$serviceName";
            $query =mysqli_query($this->connect(),$serviceSql);
            $serviceID = mysqli_fetch_row($query)[0];
            return $serviceID;
        }
        public function getServiceNameByID($id)
        {
            $serviceSql = "SELECT * FROM services WHERE service_id =$id";
            $query =mysqli_query($this->connect(),$serviceSql);
            $serviceID = mysqli_fetch_row($query)[1];
            return $serviceID;
        }

        public function getServiceById($no)
        {
            $result = $this->getallServices();
            $service ='';
            while($servicedata = mysqli_fetch_assoc($result))
            {
                if($no = $servicedata['service_id'])
                {
                    $service = $servicedata;
                }
            }
            return $service;
        }

        public function numOfProject($pro_id)
        {
            $serviceSql = "SELECT COUNT(*) FROM projects WHERE program_no ='$pro_id'";
            $query =mysqli_query($this->connect(),$serviceSql);
            $serviceID = mysqli_fetch_array($query);
            return $serviceID[0];
        }
        public function AssociateTarget($ip,$email)
        {
          $user_sql = mysqli_query($this->connect(),"SELECT * FROM clients WHERE email = '$email'");
          $count_client = mysqli_num_rows($user_sql);
          if($count_client>0)
          {
            $client = mysqli_fetch_assoc($user_sql);
            $client_id = $client['client_id'];

            $ip_sql = mysqli_query($this->connect(),"SELECT * FROM targets WHERE ip_address = '$ip'");
            $ip = mysqli_fetch_assoc($ip_sql);
            $target_id = $ip['target_id'];

            $assoc_query = mysqli_query($this->connect(),"SELECT * FROM target_clients WHERE target_id = '$target_id' AND client_id = '$client_id'");
            $count_assoc = mysqli_num_rows($assoc_query);
            if($count_assoc<1)
            {
              if(mysqli_query($this->connect(),"INSERT INTO target_clients(target_id,client_id) VALUES('{$target_id}','{$client_id}')"))
              {
                return $_SESSION['succ'] = 'Success';
              }
              else
              {
                return $_SESSION['err'] = mysqli_error($this->connect());
              }
            }
          }
          else
          {

          }
        }

        
#Surveying information
    function getallSuveyingInfo()
    {
        $query ="SELECT * FROM Surveying";
        $qey =mysqli_query($this->connect(),$query);
        return $qey;
    }
    function getSurveyingbyID($id)
    {
            $sqliquery ="SELECT FROM Surveying WHERE SurveyingID=$id";
            $qr =mysqli_query($this->connect(),$sqliquery);
            return $qr;
    }
#employeeTask
  public function getallEmployeeTasks()
    {
            $sql ="SELECT * FROM employeetask";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
    }
    
    public function getTaskById($id)
    {
            $sql ="SELECT * FROM task WHERE task_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
    }
    public function no_ofEmployees($id)
    {
            $sql ="SELECT * FROM employeetask WHERE task_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            $qey =mysqli_num_rows($qey);
            return $qey;
    }

    public function isEmployeeAssigned($id)
    {
            $sql ="SELECT * FROM employeetask WHERE employee_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            if(mysqli_fetch_assoc($qey)>0)
            {
                return true;
            }
            return false;
    }
    public function getallTasks()
    {
        $sql ="SELECT * FROM task";
        $qey =mysqli_query($this->connect(),$sql);
        return $qey;
    }
    public function getTaskNameById($id)
    {
        $sql ="Select * from task where task_id='$id'";
        $qey =mysqli_query($this->connect(),$sql);
        $name ='';
        while($task= mysqli_fetch_assoc($qey))
        {
            $name =$task['Name'];
        }
        return $name;
    }

#Qoutation
        public  function getallQoutations()
        {
            $select = "SELECT * FROM qoutation";
            $allQ=mysqli_query($this->connect(),$select);
            return $allQ;
        }

        public  function getallClientRequestsBycid($id)
        {
            $select = "SELECT * FROM servicerequest WHERE ClientID ='$id'";
            $allQ=mysqli_query($this->connect(),$select);
            return $allQ;
        }
        public function getallQoutationByRid($id)
        {
            $select = "SELECT * FROM qoutation WHERE RequestID ='$id'";
            $allQ=mysqli_query($this->connect(),$select);
            return $allQ;
        }
         public function getQoutationById($id)
        {
            $select = "SELECT * FROM qoutation WHERE QoutationID ='$id'";
            $allQ=mysqli_query($this->connect(),$select);
            if(!$allQ)
            {
                die("Error ".mysqli_error($this->connect()));
            }
            return $allQ;
        }
        public function getallQoutationItemsByQid($id)
        {
            $select = "SELECT * FROM qoutationitems WHERE QoutationID ='$id'";
            $items_restult=mysqli_query($this->connect(),$select);
            if(!$items_restult)
            {
                die("Error ".mysqli_error($this->connect()));
            }
            return $items_restult;
        }
         public function getQuantity($id)
        {
            $select = "SELECT * FROM qoutationitems WHERE QoutationID ='$id'";
            $items_restult=mysqli_query($this->connect(),$select);
            if(!$items_restult)
            {
                die("Error ".mysqli_error($this->connect()));
            }
            return $items_restult;
        }
#expense_income
    public function getallExpenses()
    {
        $sql ="SELECT * FROM expense_income where e_or_i = 'e'";
        $qey =mysqli_query($this->connect(),$sql);
        return $qey;
    }
    public function getallIncomes()
    {
        $sql ="SELECT * FROM expense_income where e_or_i = 'i'";
        $qey =mysqli_query($this->connect(),$sql);
        return $qey;
    }

#suppliers 
 public function getallSuppliers()
        {
            $sql ="SELECT * FROM suppliers";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }

#project and programs
        public function getallProjets()
        {
            $sql ="SELECT * FROM projects";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }

        public function getallPrograms()
        {
            $sql ="SELECT * FROM programs";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }

        public function getProjectByNo($project_no)
        {
            $project ='';
            $result = $this->getallProjets();
            while($projects = mysqli_fetch_assoc($result))
            {
                if($projects['project_no']==$project_no)
                {
                    $project = $projects;
                }
            }
            return $project;
        }

        public function getProgramByNo($progam_no)
        {
            $program='';
            $result = $this->getallPrograms();
            while($programs = mysqli_fetch_assoc($result)):
                if($programs['program_no']==$progam_no)
                {
                    $program=$programs;
                }
            endwhile;
            return $program;
        }
#error 
        public function display_error($message)
        {
            $mes = '<div class="alert alert-danger"><button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-alert"></span> <strong>Error!</strong> '.$message.'</div>';
            return $mes;
        }
#success 
        public function display_success($message)
        {
            $mes = '<div class="alert alert-success"><button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong> '.$message.'</div>';
            return $mes;
        }
#success 
        public function display_info($message)
        {
            $mes = '<div class="alert alert-info"><button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-info-sign"></span> <strong>info!</strong> '.$message.'</div>';
            return $mes;
        }
#warning to implememnt : $logic->display_warning('this is wrong!');
        public function display_warning($message)
        {
            $mes = '<div class="alert alert-warning"><button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-alert"></span> <strong>Error!</strong> '.$message.'</div>';
            return $mes;
        }

# categories
        public function getalle_categories()
        {
            $sql ="SELECT * FROM e_category";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
# categories
        public function getalli_categories()
        {
            $sql ="SELECT * FROM i_category";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
# Close Connection
        public function close()
        {
            mysqli_close($this->connect());
        }
    }

#testing -------------------------------------
    // $log = new Logic();
    // $test =$log->getClientByNo('PRG0076F6');
    // $test['name'];

#end of testing--------------------------
?>
