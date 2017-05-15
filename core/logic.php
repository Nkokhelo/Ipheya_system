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

        public function getEmployeeById($id)
        {
            $sql ="Select * from employees where employee_id='$id'";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
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

        public function Login($email,$password)
        {
            $login = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
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
             $userId = $this->getUserIdByEmail($email);
             if(($roleId ==0)||($userId==0))
             {
                echo "Email or Role Name does not exist";
             }
             if(!mysqli_query($this->connect(),"INSERT INTO userroles VALUES ($roleId,$userId)"))
             {
                echo  "User already have a that role";
             }
             return "Success ";
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
# ClientRequest
        public function getallServiceRequest()
        {
            $query ="SELECT * FROM servicerequest";
            $qey =mysqli_query($this->connect(),$query);
            if(!$qey)
            {
                    die('Error !'.mysqli_error($this->connect()));
            }
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
        public function AssociateTarget($ip,$email)
        {
          $user_sql = mysqli_query($this->connect(),"SELECT * FROM clients WHERE email = '$email'");
          $count_client = mysqli_num_rows($user_sql);
          if($count_client>0){
            $client = mysqli_fetch_assoc($user_sql);
            $client_id = $client['client_id'];

            $ip_sql = mysqli_query($this->connect(),"SELECT * FROM targets WHERE ip_address = '$ip'");
            $ip = mysqli_fetch_assoc($ip_sql);
            $target_id = $ip['target_id'];

            $assoc_query = mysqli_query($this->connect(),"SELECT * FROM target_clients WHERE target_id = '$target_id' AND client_id = '$client_id'");
            $count_assoc = mysqli_num_rows($assoc_query);
            if($count_assoc<1){
              if(mysqli_query($this->connect(),"INSERT INTO target_clients(target_id,client_id) VALUES('{$target_id}','{$client_id}')"))
              {
                return $_SESSION['succ'] = 'Success';
              }
              else {
                return $_SESSION['err'] = mysqli_error($this->connect());
              }
            }
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
# Close Connection
        public function close()
        {
            mysqli_close();
        }
    }


#testing -------------------------------------
    $log = new Logic();
    // $sqlresult =$log->getallClientRequest();
    // // $sqlresult =$log->getallServiceRequest();
    // while($array =$sqlresult)
    // {
    //     echo $array[0];
    // }
    // echo $roles;

#end of testing--------------------------
?>
