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
        public function getallfaqs()
        {
            $sql ="SELECT * FROM faqs";
            $qey =mysqli_query($this->connect(),$sql);
            return $qey;
        }
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
    public function countTasks($id)
    {
        
        $sql ="SELECT COUNT(*) FROM `task` WHERE `project_no`='$id'";
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
            $sql ="SELECT * FROM projects WHERE project_no='$project_no'";
            $qey =mysqli_query($this->connect(),$sql);
            if(!$qey)
            {
                die("Error".mysqli_error($this->connect()));
            }
            return mysqli_fetch_assoc($qey);
        }
        public function getRelatedProject($proj)
        {
            $result =$this->getProjectByNo($proj)['program_no'];
            $query =mysqli_query($this->connect(),"SELECT * FROM projects WHERE program_no='$result'");

            return $query;
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
        public function sendEmail($to_name,$to_email,$sub,$html_body)
        {
            $feedback="";
            require 'vendor/autoload.php';
            $from = new SendGrid\Email("Ipheya", "noreply@ipheya.com");
            $subject = $sub;
            $to = new SendGrid\Email("$to_name", "$to_email");
            $content = new SendGrid\Content("text/html", "$html_body");
            $mail = new SendGrid\Mail($from, $subject, $to, $content);
            $apiKey = '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';//add zero atfer you have done
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($mail);

            if($response->body()!=null)
            {
                $feedback="Email not sent!!!";
            }
            else
            {
                $feedback="Email sent!!!";
            }
            return $feedback;
           
        }
#email body
        public function emailBodyLink($name, $message, $btnLink)
        {
            $body='<table style="max-width:800px; padding:1% 10% 5%; width:100%; background: #eee;font-family: &#39;Gill Sans&#39;, &#39;Gill Sans MT&#39;, Calibri, &#39;Trebuchet MS&#39;, sans-serif;">
            <tr>
                <td style="text-align:center">
                <img alt="Ipheya Logo" width="30%" heigh="30%" src="data:image/gif;base64,R0lGODlhKwErAfcAAAAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4O
                    Dg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEh
                    ISIiIiMjIyQkJCUlJSYmJicnJygoKCoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1
                    NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hI
                    SElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltb
                    W1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5u
                    bm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGB
                    gYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj5CQkJGRkZKSkpOTk5SU
                    lJWVlZaWlpeXl5iYmJmZmZqampubm5ycnJ2dnZ6enp+fn6CgoKGhoaKioqOjo6SkpKWlpaampqen
                    p6ioqKmpqaqqqqurq6ysrK2tra6urq+vr7CwsLGxsbKysrOzs7S0tLW1tba2tre3t7i4uLm5ubq6
                    uru7u7y8vL29vb6+vr+/v8DAwMHBwcLCwsPDw8TExMXFxcbGxsfHx8jIyMnJycrKysvLy8zMzM3N
                    zc7Ozs/Pz9DQ0NHR0dLS0tPT09TU1NXV1dbW1tfX19jY2NnZ2dra2tvb29zc3N3d3d7e3t/f3+Dg
                    4OHh4eLi4uPj4+Tk5OXl5ebm5ufn5+jo6Onp6erq6uvr6+zs7O3t7e7u7u/v7/Dw8PHx8fLy8vPz
                    8/T09PX19fb29vf39/j4+Pn5+fr6+vv7+/z8/P39/f7+/v///wAAACH5BAEAAP8ALAAAAAArASsB
                    AAj/AP8JHEiwoMGDCBMqXMiwocOHEAWmmjjxj8WLGC9SnBixo8ePIEOKHEmypEmSFTOqXMmy5R+O
                    J2PKnEmzps2at1Ixcsmzp8+LjFLdukm0qNGjSB3m/Mm0aVOhSaNKnUr1oU6nWLMyDVq1q9evNG9t
                    0kq27E9GQ8GqXcsWYSqzcOP6TNW2rt2pY+Xq3dty092/gGPm5Uu4cEa/gRMrbvjWsOPHGhdLltxr
                    J+TLkNFO3lyXE2aMgBx5QkXLFzNp3sC5W+2vtevWq92B8yaNmS9aqDw5AvQZMeffVC1DlmQKlzNu
                    8F4rX868+Wt43JzhMiXpMSPg2I0KE05YkCZbzsjp/3NOvrz51/rIObOlSRBhzdnjn/RlmJEqZOb4
                    nd/Pfz8/c8iowl1caclnoEf08YUIK86w09+DEPLHjjOsIKJXgQdmqFAwfHECDDkRhijifuQA4xmB
                    GqZYkDF6CUIKM/KMKOOM5cnDDCnumYWhivItoxcozNBD45BENkcPM6DAtSOPvzUSFyXECFnklFS+
                    Rg8xlJR1HZO/lQIXIbKIU+WYZLYmjiyEkOUbl4n9AhclyuBT5pxk6qNMllrRxSZgj5iFCjd0Bjon
                    N6iQtaddsJQlCCwOCupomezIkqNTax7qFW9aGcJLjI92WqY8vBiSlaVehUKWIb7Y4+mqc9rji6hO
                    be9JalSTOiUILqqyqmuZ9uhS60+zIlWLVoDIwumuyJIpDy2YMlVpsDNhohUp6CRr7ZzqmBIrtDRR
                    o5Uk2lwr7qB4MqUntyWxkpUhxOg37rtj8mMMrGehS5ImWamSHLz8jgmPulvZCxI5aTrlCDb9Jkym
                    No40taTAC0mTFS1yKmwxlfjY8hTEDsWClSPeXCxyleA0XC/HCo2ClSsVj+wykfrIEjDKB5nMFCII
                    v6xzkdhYCCzNBPnMFCf77mw0jfCc6BPQ/4xTMFO6uHv01DLyo4u5KIvTrE+IZNNcP2CHDTa8+OzD
                    j3792NMP1RBqIzRP5/+i683WPWnSzj5ii3323mevPS4/8+TjTzzt5DOP1GyTl/c7+M5lLzZOtZLP
                    PnjnDTbfe/st7tprI+PLPYnvZ/k+MjsOrcRMATIM35a3Hja8a5ezhiWhi265P8rQzZKsljLTFCHa
                    YO666/yes0UT09R+XuutcfO0S7yz6ftW5wyft8hybgJAIsovf3tr6gy4+6GQM2VJPNZfPzIdMvzS
                    2j2ad68c867JI21P0aeoNVOgqJ2+2LAbmz/8hookZMFr96iH/L72PdfggxSmU9E5dNcSVOiDH8QT
                    GQb9YQ/Q+eMZY+iBIgRXD8QtsD/8KFRP4nYgdjyPJ7C4IAbpdzG/3UP/VecoxBCmkLyz5SN+J+QP
                    P2gRQQPBQxFMsQXraGixtZ3NH/nYRBRsMArX7GM8QQyRxlaYoer8BBcDTJ/L9KFAf7hiDDmYQxn9
                    oQ8sZjFCV+vJgRrnEzCG0Xoiu6I9hKSMNHRhCssYID8o98YRAWNp8VFFEhmoPovxQ3D+aIcdrNAF
                    UHgQH4cr5IhwgUjgFGORjARgHjnYCDFQYQ53i4c/9gFJTYpoi9ADDjeYAgvFNVBkp4hCGZpgC0He
                    Yx+tMaEr+0NEnuQvMfB4YQWF+TJ+KLAf+NCHPSqmDCyYQQq0G+Aq/QbEYfZHhS5hYWD0AYmfeIKZ
                    L+uHB9emD8Glww1l/wiDG87hzSnxI0k8edhdIOgTSbSMbSbshySsEAc6BDIfraznjPBxP5csZnr4
                    c4f89lExZJihDlKgxfsSqlAZwcNm4wtMOSioEkKAqHZ+08fa1gGJNmzBC9XaYEeJpA5lZuSYa8EH
                    SFsCiJyFLm34cJc9QNEGL8wgFv4QUgdnSiRukDQydwFYT4DRPXVqLhhvwMIR+iCnfvBDHh5kKo2I
                    IUe7ROMnqlggRaHoi0OUgQpyAIc/zgZWsRbJFcasSzxsqhJK/LN2+khONqSgBjio4RqtwUc9gmpX
                    IuHDEjx5lleU5hJESFR+/BCSPkyBBjCMoRTvk1Jji3REnrCFrD4J1/8C+yG4ZTDhD0owAzD7UQ83
                    jrapT7WIWtjxK5bo4o348MMWuoAFhNVDHsB8JDpvG6EEtQSnUaGjSzix3ND9Ig1vUEIt7/EOeOgn
                    H2Fl7ozuaVqvOMMnhGhUEOEhiTEw4RCu4cc99GM28RLJHXy9SFfmQS+XMKOQwmBDF5wQsh/WQ4Gs
                    tG+RUNeXqoDTJaiQH2O1eY9EWEEKnJgrPdQpuCcqmEhSZQlVwuETRoi2dtNcZWugQQYkRKHDtp3f
                    h2Vkj53eVCr8KGdPqDHRffxSSqjgAhFA0RqwAZM53Zzxg8rXEnESRRg+Sav8fomPyflDHXHAQiOO
                    jA95JDmMSh5RohzzihR69JcliDhx7X45V3/UwxRP4MM6oMjGXC3HqwIMM4ToIT6MSLYmeO0JNE54
                    QdckQw1tQAYHyThXjhY5c1/WM3m8ReaiqCO3FvFEEF8Hj0Zk4RX+uEc+UnzDr8lY0vzhZ0hv4g9R
                    9EQQ6gii2UA3jSuwwRxQzMfZLhhpVIvIhS7R50m84ZPfBvEeqjwHH8jgU9dIUznvSIYuXrELYhxj
                    F7/oRjzmMUDv4iM5rHVXPvDRa+Y6V8Q28Yd0dxfj7ulHH5QIgiOqwQtdEGMbrrmhrt3RCSYc4Qtd
                    kEMlPGGIQICiFbzgxjkEd4/5+gMfDh+kr3Mc/2ybWMMn0nijfp5xhSTMgQ+MwAMYPLENcoiWF0YA
                    AAACAIEIKGAETMjRKEqxilZkI1f5kId+POxrf1y80jLxB2R5gomqqs8diPBCFr5ABzp84QlMGAQk
                    OpGcc9SBC43IBCDkcIg0gIAALICCGjahCkp44hWvuMYFn+kufPw1zJ6o+Ex+zhMxKe97sMiCGUpg
                    hDLg4AdN2EALxLAETEhjFJ1QhStMAQtkLAMa0YgECzxggykA4hKTyAQpPgEMTo27Nfaws6TNUd6Y
                    CL0nEb475ty1ijUYoQIx0AERfpADEMRgBzmIQxWucApAqOEUu7iEHvBACFfQ4gwQOAEQ4PCHRf9o
                    whTB+EUmXZNnVAeaJcIGCZN5Wi3VY641tMCBBZyQhBV8IQo8qAIPTqAEMcDABYjYhSpMUYo2KGEH
                    RCiELphhCBk4IAiEYAeGoAnDUAu2UA0epA9H1nPskFumR1ks4Qry0w9mY2QEBAJFQAh5wAZ0gAZ3
                    UAdJsARtkAd0MAidUAmJAAmXgAmB0AJhMApWoAa9AAtVsABn0AeFcAiVYAqWAArB8A5QRG7UV26j
                    VUzYdxLk0BOAoF6A1WH2MB7T4AZsEAmawAiWoAqgcAqv4AmIEAmPkAd88AiA8AZ8IAmL0AdbsAWg
                    kAdKgAETQAupwAEVAAZxgAdYkAeOQAmR8Fv/9iA4+TAe+kAP7WZf8NBbGGES/vBgEbhACrgP9qBA
                    1/AESAAHgnAIfDAIkdAIktAJqIALt2ALv8AKnZAHa8AGYSAFTGBrRaAARmAHFzAAS+ACAOAARuAG
                    WiAGeeAHi6AIyQBJ4cZhklY6R0gS74BpS3hC9uAO4xEPgkAEXBAGY/AGbdAGe1AIhSAIfaAIgYAJ
                    toAJpXALtxAINiABD6ACRVADHBACY4AGFWABIBAAAOABVBAIZ/AFb9AJlKAHqdAo/KBSFEiEdlWI
                    z1USsNQSEnhC8yAl2MAERUAEO0AFVvAEUcAFarB1bFAHYoAHgbAHj8AJpyALtAAJVnACOTAE/w2g
                    AB5gBWfAASpHAABAAW0QBlVQB5SQCWrQB7bwDOPhVUUmaUa4EiSBD/l1EbF2Ql4FOvWQBh6QAj3A
                    BDxAAzswAyKwAkfABU/gBHHQBWPQBmTwBXOQCbpgDbRQBjawABhwA0oQBScQAAKAACo3A16ABnMg
                    B3HACCFnCojFRvRVXaPlDk8FXQ/BIjyRekEkD6rkD56gBF8wjV1QBnAQBkTwARKgAlEgBTgwA1KQ
                    BEjwBFQQBWGwCKFgCW1wAyvgAisgAxvwAAMAAC4JAEmQB2awBmVQCGdABrWwCjlTOQBpVyGmEiLh
                    D+XSEnYXRPWQK5XABWkgB3ZwB4sQCYngCP97wAMMgARnIAMp8AI9MARLgARGUAQ9gARtYAhf4AIX
                    cAEx0AADcAACMADwKAJbcAZucAdpwAScYA2QQAokNIgfhg4u8WcOQWw8oQlZRDnPRg5qMARt4Ady
                    YAZpoAZ1MAiPgAhBEAN6wAdl8AIugAM8EAQ+EAREsAVXkAVoEAOs2ZoN4JYF8AAIYANrEAZlMAVm
                    gAif0AlxtUoQt5t2hU/o5hFmtGNZVGXO5HNNYAV0QAQ4oANCMAV6cAiFQAl28ANw4Afa+AU9MANO
                    0AQbOgVIAAVgYAQHoHJgOgAFEAAIoAArQAQ0AARO8AY44AXBQAaL0Br0YA98eVvbpxLZpxD/+GCI
                    GMEI+hk68nVk6eAENaAFCwAAKRAESOAEYvAGePAGXwAIcBClgZAGWNAES/ADO7ADQUAGPXAEY1AG
                    Y2ADWbACYKpyEqABFAAEYNBxQhAJmJAFv2BlE6djKwGYCqEMPeELheR2beQPjaADV3ABFXADV9AG
                    ZlAGSyAERtAFiJAHckAHcNCiO6AEVZAEU/AEN1ACGeYP7FAN/kANghAHMAAAH6AGHMABdPADGRAG
                    czAImXAGg7BGvgZlLcGjEKgSgHAsb6QP3EYLY0AGVgAFRDAGgrCRc/AGZsAGfnAHcwAHbfAGalAC
                    MTAFPiAFWEAD3coc4NAHEngGA8ADCAAB/z1ABnPwBXkgCunQc3LKpy/REe7QE6agSfoAP60xCu7q
                    CH5ABnigB3fgB5VQCYBgB3IgB3OABmSwBm2QjlrABFOQApTAHPYQD/9EDR0AABFwAzsABGPQBVGw
                    BMfgZo6mZL2ZER1xbixhDYXkiJBUC3yACaEACYRQB3HABnxwCGxwBVEQB3dAB2vQBXHZBh4gAVvA
                    BVnwAJ/ARmajUoU2bu3UGogAADYQqmhABUTAAwDQCQO0gJI2S/cKEf7gRS2hCHXKNn8ITPAABigg
                    BEdgA2QQCHKgB3sQBljaBI0gCGSwBVggBWBwBh4wAFQABlKAAhFmD4dzD/TgdlwWD0LCDv86AAA3
                    oANP4AMsIANCcAvBxLJ9ZhH+eRD8yRN2pEnuAgwk8JIrEKN5EAdnwANGAAUD+AZhcAVUIAVdoASH
                    6gV4oANKkHEX9IdYpDn3sC/i8AIA4AI1kAJGkAJmsLJ/OmNoa7YP8cAqgWuF9Ei65g/nAAVNQAiE
                    gAd4sAdwEAdk8IyaYAhm0AVhAAZQcAU7oHJmQAg3AAbdoJcUyBxnk0D+UAxWoAEq1wAGAAYxgqO3
                    xQ5AtxChyxNR60r6EA/jYQtJAAeoIApz0AV2MAiGgAhp4AaREAdqQAVkoAZJoAQzoHJn0AhTQATu
                    o1jlkWD+sA6b0Ad9gAd2UAvZy7Lq1mD/DaEOUzVM+SAlljABEiAFeGAGWoAGcFAHdPAEeXAIZpC7
                    WXAFTPADIeCSUvAJdrAAkgB6G9YcT/SrQDRqQnxbgrmjC2GvLnFZmvSHrSEJLLACPhAFacAHkHoG
                    W6ADkDAIY5AFZBAFPwAFNdABFgAAI/AImnABb9AaS8y5zuYOqsIPbmdCofdDdiwPRYwQiMkT2eRK
                    moMKdKgFVzAIi3AHf4AHQKADoaAIZIAFYFAFQXAEIjACFpAAAPAEvGAHNsALiTW2+1APfiMPMdKH
                    9PBM/2jH/pCvUKWnLmsRvDpMUiMKLXADXLAGgPCwg0AFDGACiiAJdpAGWvAEVgAEDIAB/xXAAABQ
                    AXkACkQwB36DN81xRQ8HOl6laxhUXwSNWqSMEHe6EhSsSf2ggG4WCCkwBotAB12QBWNABC5ZAErw
                    nIRwBktABjwQAAqQAa35AFzwB1xQS9p0ZHmWN8C0z4NEW2MraUT8uQnhD8K4OwqlQPIwBkUgCH7g
                    Bk7AAzcQAgJwqAKwA2KQxVRAAxcQABfAAQlgAD3gBDQgBVxABc4QTPMATJ7MQNRH0K4huniqEP5g
                    qyyhUd7UD5vsCSqwAimAAQ7gAGLaAB2wAPA4sihQAgAgAC/pBHNwCosABoUQCBhVBKl3wRQocZLN
                    H3G0Et1b1i4BKN50QeNBD3uwAA2AAv8i0AMv0AAZgAEPAI9gSgAOoHJVAAuwwAhNsANLAARWUAYl
                    CYR0WjnK3NvlAQ7VTBC66hKC8HZZVMP7sA6g0wze8Hn9MAxN0AAFMAEGwJ4BAI8KQAbMYAo8sAFL
                    QAhvMAU3gAE0IAQ8BkXycEE0jd7moQ/5ddaK5BJE5k3ObA8+Bt/LIAU7MAIaYAEKQN0ooAnLkAku
                    QAKFYAutcAzg8AuVsAUmgAS5UGTjhlAWvh/awhJO9g/+gEQuQQz1pB/zAIRJJYRJhQkQAABpQAQZ
                    QAEqJwA8oAjd8AslYAOWYAmU0AqoYAvCQA3FAAtn8AODAIT1sM8N/OOuMcoqgVMxyxP/J8XQbFY2
                    91Ax45AFKlcBZ3AD8qxyRpAKxYAMSWADnlAHi9AJl+AJlMAJ9vYLuHAKSvAEclVncG4e33vTAwEN
                    PGEIpds9B5ZURRMLMyAAAWABI7ABBFAAMPAEbiAIm3AMUwAAedAIg6AJlJAImDAJjEAJtkAMoIAL
                    34AFPaAMRaY5fRPKkvY2EFwQ/vCTKyEKTIVBWAQLQLABLPACBsCaHZAGlZAHhiAInNAH0GsJdoAI
                    fJAIk2AIdskIknAKrtAIvxAOXZACofDSPLnPNrvprhHkK7Ekd+wS+FxPTlQPkNQKScADPJACrd4B
                    VLDrhkAGVfAIvjDGR4AHhQAHhRAJbYKgCIzQCHkoCrFgConQDPcQBgzQS384NjgM8K5xSEJuEPyA
                    acTt4W4mJdewBUBwBEagAyQgBGhgBnow1GqgBq/wCQBQAEggBn9ACIkgCHuQCIpw9cR8CqdQCJsw
                    DuUgBCcQI/qBD6pCSDLvD+r/bdYDQXo8IXquhEE+3g+OIARawAVIUAM3wKVisAc7sQes0AtPsHJJ
                    4AZ2sAhzoAeFAAjWSAiH8Ah6SAmFkAncsAwocMzqJHG8LfN7qvYC0d4tkcRJ/tWRdAZK4AVXMAQ7
                    MAVXsAV5oAiREAh0kAuPoHIKMPh5cAdkcIl20Ad+wAd7EAiFMAiNsAiQ8AjVkAodoGn6ICcuffat
                    0VC+SRDTzhOs0FFjQ4HK4AVVwAZMAARfwAZucAiHEPKBAAinAAcXAAAXEARVYFiF1QbK2bdxMAd5
                    MAh84Ae+TgrgMAYbICYAYa/fPnz9/B1EmFDhQoYNHT6EGFHiRIoKZf3BmDHj/61/Hf/546RRJEZj
                    FU2eRJnSH799By01EQNnjJM1f/IcMnSo0R9Jf/SoinCAyJUkVtZ0AeNGjpw2aNDAyYPmTZ1DlHZp
                    K3GDnz99/fptVRlW7FiyDpGNzJjK40dDaDVyKxtXrkN++QzOo4NEDhkzZtwI2kNnD6BBfzzVafIH
                    QgEkWZI0ueIFzRk0atRMRiNnjRs3bBxlAkcKgJiD+vx9tTtXtUKvDPvpA9tyNURwbv8wWkvPdkZ6
                    s32T3Se7mpgtdsqEodMn0CA/ewLlQeRqjwMADTzAMPJFzBQqXLJo6ULGaZkyadCMOWNHEat7fQDE
                    scd1pel++PKB/X2Q3z37sP8NIgzuP9b2wS8hfOzBZx998MmvIXt2W6u23RRpsMKU7vEHFingYOMN
                    O/LwIxBBAikEEj4UecULAACwoIQYwChDEEHQ8CIMvs4oYwwwsujiiymW8AIRTJSxpgUA5IDnNIP4
                    mQceBhtcsj9+/vvqq+D0SQ0hrwRMiMD97uHSwoMYsW0tZXb7gxMx15Ron6/8cAKP9PrA4w489vAD
                    kED8iMQTIQA4IAEARthiizkIKWTEQgjpY4420hAvjS6gsMINQhpRZhkRAFAjn5XqyUdBfmD7zSt+
                    CmRJH9kOsrK1MBcyqB4M2UwIlDI90gVNWmjllSFPpaFiizfSwPOOOeSoYw//PvD445JJYiiAgwdW
                    jOAFHYSoiQ9EHFFkkBHnqKMPm9aoAoxFFoGGlycAeQWdlQS8Z9W5tjy1QFZPy6ceep7UB7YpH8pH
                    oF4RsuXWj1BBs6SBB+7XH1V2WKOMNv4ARI87PgzREEAwqaQEAjDQAAcUVoSghB6gwCKNO/Ko444+
                    +tDDj0Uy2USSQOYYpBRjwoGGkTRQaYklJVXb8qtR7T0oH3rszeceVV9lSJpSvOn1LLfU+ggTNLFZ
                    mGFPQZHBjTLe2EMPPM7eQ7lFDMFkEQ0S0GABGKbwAAACLIAABB6eEIMM9OLwgw89CNEElmGCMcSQ
                    XGophQ5AWkjgE9NWugfp/7FcZUifedxZZ5xv0pHnvpPiCSUNADDplRvbsPanrd3c7ZpXAv0RRYY0
                    2IAjDjfikIMOO84OhBFM7ICggxAAEGCGJCowgAAAFCghCC3COGMOPupg1hBGJuEElV1IGaQODVAw
                    hQkAHHijm3srjMcYYm5BJZNF+qCklEgQYSQUXJCJ57SIxvnDFGpAAFn0Sh0Q+oc+0PSHycWuV5qY
                    QRriwCGlYC8Pd7jDIPJnOg+EIAIGwAEWltAA5FVHBlDYQhjWMIc5/E4PdaBDIiRRClmc4QMu6AQ8
                    srCiASxBGAfBRwP7BTWF8MMe9tjKqPCxxMnVoxzUCMYtNkEHOrSBDFv4Uf93pvAEKFQBKV1oQySC
                    gQ4sDaQfsvKHPGqxBynQ4AnFGBg/EMgONCHCgQs7RA3YEIc4tAEOdMjDHvaQhzwIwhCV2AIALlAE
                    HEyACDOgAKAMsKILDMELW9ACGcDQBj3QAQ6DwMQjALEGEbCgE71oRiw6gLwAhMAQ6zhIPeahD3rk
                    40lFDCIQ4eGplYClH/IQxzR0oYlBzCENYwhDGL7QhS1kAQtUmIIVrnAFKkThCUyAghOo8IZLoCIa
                    CQkHJtpAhAqAwRxdU8StvIEmS9yRVltBRxt6AIc5xOENbwAkH/ggyEFEAhNPAEAEqoAEDJwAAwAw
                    gALsFoAAiIAIS4ACGc7/sAQ10KEQl9iDHZ7AgAfQIRSRQEU4SDEtHgYBGAeBRzvsEY8GFhGN/pvd
                    Qd5RjFLIrw5foAIVrqAFnm6hC17wwhe80AWiFrVHX8hCFaRAhSp44RDB8Ecz8tAGJwDADQiRx8A0
                    cStooEkU7uRVM7LQBCq+oQ34zIO4/uCHP2QiEzAQAAm40AQOrOgAeBMAAQawogWoYAldEIMWrDCI
                    QuQBEFzQAADGkAkPeWIV7NBEAVa0IgQQojROik9DWqMlfJTDGK7QBCQI4YUsYFILXPgCF6yAhdJ6
                    AQxhAMMXZDvbL5DhOFqoghbM4AQhFAELf8CEFUrwiYPYI14DI8WtjIEm/1eAlVa1aGod5MCGDtVB
                    D38IhIgIAYpFACABQghDE1aQ1xK8IAYbmOyKFACDJTDBClO4AyIOEQcTXOAHe5CEHOKQCEyoAhyn
                    YAAAHiAoADBCP5stYoGcSA1hoOIQbfACT6uABS+IQQxg2AIXxiCGZHbYwh8Ww4apoIUvaGEL5ZmC
                    FLQgBCkcwg6qAOJW6jEwWNyKF2jihXPXdA9KYOEMcIDDGtYwFecgilGcyAMAGOAEMzDhAwAQwReQ
                    QAIETBYBk1TACmgQgynUgRFsqAAAUnAGPcgBZnqYhCVaIQ5aWMCuKwrDOfzBy4XcI7P8OMcybAEK
                    RcThwmHAwhQsvEykiP/BDObpCxk4zBfyNNoMYrhCF2AohRyMgQxVKAMWgBCGbCSNQS1lky/K5A9X
                    oAkZOhZTN+gwhTFIhQ1oYAMd9CAIRCRCEH0QxRpWxIM3lEEGAaABbz0gAGIDAAFVBkABUJBMOlih
                    AQjYgBC80AY/k8EPkKAEJmBxD1i4GQABWFEdIrKPbfDiFVv9ghSkcIUwmCEMXMARM7sQhjSowbZj
                    GAN5yCBRNKTB3/uGQx8i9gYnnAAOaYBCj3bAg2UoCR9C69WZruYPVqDJGaj2zVcQIgsohOENaKCD
                    HOaAhzwEghB/MIQiQJEKJYAbBG5QwxRGcIEAMMACIQiBBJA92R7Y4Qv/MZCAAlAwhCZA4QtmyIIT
                    3GCJSgxCze4oxhME8G3vmkI/p0rIPbxhi0WQSA5EKIIVprfh2HIYDK8VQxnc/YVWm0GibWADjvDd
                    xzb04Q0ziMEbVnCELyRh3j3YwjnnvJV5DMwZq/OHJ9AEF4zLReP7Mcg76ICDOgyCDTC0wx/4wAhH
                    9EERkwCFIT4wyQZ4QRFy4AHyKpCCIcDgAguYbAAWEAMc0KDKGMgACWqwgydogalj8MMhENGJTJii
                    HPJIhGQFtQKDVG4fx72HLhQhiEFQ9QlSEPsWaoSe8+TbDGcAfxrOAAa/nCcNdWCD35CJB0LU4QRZ
                    4EIF3LADDqjhp2Ug/0IcZuXAdU5c8buhmsaLC3rIKn/Ah6wShidgtTfAkTW4POdoBEcQPk4AhLpi
                    gAAoAVEAhST4thOogRDYK70CNwFYAAmwgA2YgAMwgAR4gAoogR/AArXjgr84BEe4BFEIBV6QB0qY
                    LAiABpg6CHSABU1ohDTggiuwAjAYA+9ALRv5PuoSP0WLrTJYgzMQgzQYljWwLTbAAz/ggjYQhAg4
                    AkMAARhQgypwAzEIjx+gEHfqP7RIBX9wBDSBHQEkC+MaFdkwhCBQA8lwtzXYg0IYhDsIhESIr1Mo
                    gwM4nwxQgCmwBCiwAAuIgL1SAAhogASYOsrKgAtwgAEIAAEogAxAgf8ekAIs5IIyICw5SIRU+Lxf
                    sIcymKwwUAh1eAVI+AMyuD4wOAMz4AKf+gIwSLvv6zfwMwPysBE4QIMvqKjKEL/0aAQoYAE/uAEU
                    uAMgwAE6+AI56MMr6AFYAKsDmrg53A13sEO5IIiDGAYg6AKZUIMyqKhkSZxGUAQ86IRIAAHv6gAV
                    YIANGIMsQAIpgIIi8IEjCIIPmDoBMAADeAAVAAFBGQADGIAQoAEfGIIo8ILV6oNG8JBISIRBOARV
                    iAdYBAAbmIaDWAdgEAVHAAMn+JErOIM0UMMvCIMQsy3wSyaJSoPNWAMzUAPz2Aw2uJ2QSy0sQACY
                    KQAfALI36IIzWAP/MOABJQjAO3KH3ZBDNCHHciSLgUCIR4ABPOALNNACN7ADfHqET/gERcC1OeCh
                    DdiBFQABnWIBD1CeI0ABC3gAAmCoARiAA8AADKgABAgA52kAFgiCHwgCJVgCKYgDQPgDOjiDPxiE
                    QHCEX8gHOAAACYgFf4gGSugDOdACKNAC0uIRn3oDNQjGvgA/8HMKf7sdNaC3ObC3N2ADNXCDQBCD
                    ElgDDZiCRxiBHjgbmWC1L1iBOHCuqbQNf2DM3cgsrFSJ/YgpeHADJrADMVCDL7gCD7kDPTikSXiE
                    TciEH0ivK9gDF6CCLKCBCFiRB9gAEBCBt+GhFWGAEPC2qcOAHDCC/yNAAiaYHi+wEzHITu2MBGcI
                    BxsIAEuohlHYAzFwgigAxmQCLAxbgzagDKfADDgwKzU4A006AzYYgxViAzMAMji4gjLggxYggyMY
                    ADIohDYwgzcYBDwogie4gh9oLrDCB6pcIOYUCyP6ivgwhohigz6wA3aTAz44hEIohEQwhExgBTfY
                    qwL4RAmwAjmoAip4ARygAimwAR0AAhWggIMsgARAgAywAAUgAAKosgDIABroAR9oLyZwxzBwg2OZ
                    AzqIhEowhkvoglGohD8YAxLDAitAiiuQgorqAi2AtTWwDPE7NPOAtcvYxTYQGzWoAzgIgz4wgx0Q
                    hCMoAS8AgjUQBP840AMygII7KAIhOILA0zEcRRMdDYvW0AcMmQUjAKqMMgOSuzZOgARFWIRP6IQT
                    sJsEMAASygBIgASC4oBRDIIdkIEQmICgSDYFmAAPaAABGABQXJEAmAATgAEeuIEcSIM24BExOBY9
                    OIQ6SIRa6IVOwEUqIA+h4otCWQOZCAM1WAM0KMZDUwMzQIN5JYM2GEs7qAMwyqg7+AEyuAMPeAMz
                    KAE2aAREkChCuAIVsIMgYIAp2AR/eD7L6RVWpUpXfVXZYAUmyIIwcBQ28IOUXQRMSDlFKJ2DtNYB
                    EDo5GAUegIAK2AAXAAEG6ICGJDY0HQAJoAAzzVaqA5QNoL0aUAL/3MoCf1MKPJAEUNCERGADQYUt
                    G2m1NDADIVM76kID9XPHR1EDO4ADRKWDOAgDNnADQ2CDH6gDJ1iCQYgAFVAEPoADl2EDJ8CdIcgC
                    KuAAOxgHf6CH/nEnjz1OkFUJjfOH8uECM+iDODgDQEAEQ5iEQyCES9gERKirvLpWu4EBKzCCFbiA
                    aONGC1iAAngAFECBCVCABtAACiAAARjBAjiAvbKbD4iBG3iBovABciWDOvgEYFAFO7CCJARGDrO0
                    MpjQCcVXYXSKM1ADOCiD5sVXOwCsOegDNrgAKtiDGJCDJqiBP+gDWGsDPOBbQZCBEhiELriDrcCH
                    yinc48xRxE0J/8XthN7zAjyogzlIhP7NhEOIBFZwhSZYEb3KRANgAS6ggg+QAAxAgRhogqSagibg
                    gQ0YgAKYgA2AAAJIAEERAASA0skSAA5QARPgASQ4rS7Ig0xwBVCogyuYghSaSXzTN3c8g1a7V0vr
                    VzbYyTJARixwA+llA33qAytYgkQggReQAxGwAkXYA7W1gzG4Aj4YAhPAAyaIAjh4Ahg7iOCIX7fw
                    h/ml35PQuH2ABCfYtzdwGULIg4vaBFKYBTsgIQa41kwUujR4BB5QKA1IAR7QAi0MAmlRKASwAAl4
                    AAyA3WSTXVCULACAABdgARpYrThoBVkwhCx4AvIDRnyzrUQ7tP8ywEkrHIPbcYMqDIMORYM7cIMw
                    2IM/CAM/IIMNoIMnmIAq+NezuYP9RYMssIMfaIC73dQvKA0iGhjDBeMxJmPTmIdCgILj2C9O2ARD
                    iNpWIAZGyAAeCsxMfIAaEINJ8IKDIgEbQIEZmAETeIEUkAAVDNoM2IAQyADJQki8DIACkIAFcNYD
                    2AAamINbCIZI2AIgiZja6mTKMA9FOzS3QwPyqDfLcAoyCIOxhCE38AMkEII/uAAgUIQYuAJLCAQ/
                    +gMn0II/YAKhCoI3WAMuIALiWolVPc7ktI1bQuaI2BLTcIc9mIJDzQNF0IRT6ARPgIVXcIUdsCtw
                    i11wswAj4AL/PSgCBFAAF6gBExCBDtCADsCADdAABDgADzABEOgACMjWA2hkAZiAFqAAKEgBACiD
                    VvAFR7BCewUDL3A0gr4dpCuDOLii2yFGyjgDP/oCmCNEK1AtFFgEGZgARhCEihK4K9CDvv0DHLCB
                    OfCDNriDIHgCdliJeJgxd1Kg4xRH27jKmJbpKTENeMgDJ1ADl+mCI2gDRogEVziFPwGAvQS3a90r
                    D5iCK4iDHrAbEfABJciBce6BF0ABEmAACWiBGRgBCXCe9EKevXoBCagCXGCDTYiFPmgqOniDMAiP
                    5iXonowDM4ioPBiDQpWDNCgDDiuPy2AhPyjZKcgBPhABKGAC/xcgGznAkTfIAjVoAw6QgjGwAhga
                    FhyYBP+hB3vYBzrrGuME4852i88G7YdQXH+ohSXggjj4A0TQgefhgBogAytQxHmWrABoXWpBAjFg
                    gxq4TBpIAi2QAiDwgR+ogeF+4BnwgHQeAAYgWkemDgDgAArwgGaYhlAYBJ/aWjPwPlDeN/Jwu7NS
                    u30FUZmkHjcwAztggy+4g7TJgR5gAxogBB0wAULK7jTQAzHoVyEQgxZQ7JDT7xxQg2EuDXlZGAVH
                    i6rcDXV48InwlHpYgyGoTjioBCJILwSwXeRZZAWggINygCVYhDswgYDagSG4gi1wgiTwgRzYASFY
                    giI4gQ/uxP9JEoAOqIFyxgDJKoE/+IVV4AO/wVC1I8bzxjdOvsI3cAPzxkI3wBE3MKs4sIMz4IM2
                    eII5kIIa4IMYKAI8AIM7CLKPe4MvwIIuqIDEwIM5QEZQLoJQ6KVTIWZeoSP/Q5OovHOH+I9MWAI9
                    QNs5AAUzyMSgQ54C2KuYXYAKIAHZA4NU8IMwO4AawAEfmIIoiIJmB10bAIEqKwAHmLoDgAGSbYIk
                    +IEBSABAcIZPkImjM4/U7Asj3zfbIg/odUDq8m40sCey4YMxkAM8mIHydQAmCAMqQIQ7MHIqQMaz
                    GoIpmAI44IN73d83iIIzoIbTwHYEi503HIk4/D/bYLxvb4j//fAHaGCBKTiEP5B1S+CCyfqAChCA
                    Azg2vFwRB5gAEhoBSzAEFlgRAyCBGJiBIiCCHOCBIugBEfhw202ADWAvHLgBKsCCHtDUXziF2EoD
                    GKFQine7JFe7iqdNs6J1mAvSswIDHRgEG7CBRUgBIpCEPJB1OxCEJpCCOXgDLbgBLWArfx2DN+AC
                    IRiFA/N5/kM8VbA4o3cI00gHMgiCMYgDOmmDR/iTCPCABGCoTyyAApBdu1GoFJ0F8ASABdDLJGYB
                    FegAB+D9bzsAsAaUEhCCCr4AHmCCGQgCReAFUPCzIBMqnnze1MT4wM/XcCX8f5WDYcmDL9AB9XeD
                    JKAAPfkdMXeUgzDQgy84gjPgAi+Q9TZoCjgACDBgtDABM85fv4T9/DFs6PAhxIgSJ06E9uciRoz/
                    qfy5yujxIjKKIkeSLGlSZColZuq4yRMHDSAtGzJAAGDzJoAABgLcbLBmjQEACwgAEIAhwwMHCHja
                    ZHrAwo4fOD4AiHBkBgo8rC7NGSMHzhk0YsqoSYPm7JkzZdaaaZv2TJqfa9CYiUPmzJizJsgcofGm
                    yBk+ftqMyYIGCpg0PJZwmUMojp03T7qsKQPFSix/+xCe7Oz5IbOPGv/xEp3R1+fUqlc3xHcoCJMw
                    bs6Y8bLmjpcMAAwMAHDgQYUFAQQQFQAgQQsQTXNCmAChAIAGGCYYt4kAiJQrNSzwrFCCRRpWpPCQ
                    dVNGDJs1acqaRUumTFszZ9XMjQ8XT5opYr7U/+HxxAcJf/jhxhhq5NGGEWxoUQQaQYBRiBpx9PEH
                    HWyoYQcXR4yRjz/8LMQaiBP5Ytof//xDDIkXuRIiixR9yNCH/fDjkIwv0mhJEFFgwQUXYshxxyF/
                    7MBBCRh4kAMWL9lwgFAOGEAUAUQdcIAACVS1AAMpsFABkwCw4EUkagyxgXEciIDAFbJscscZYbB0
                    BhhluKFeGu2d1dZaaZWRhoV4kdWGHYAgQQYXYUxhQxdj3CHHH3lkEQYeWaQhhAhwGBKHHG28gQcb
                    ZOABR15QbNRPPS2a2hAsJJroTIp/iHJqiB4+tM9C/Nxzj4z44ENrQvnQs5mNDN2DTjjNlNIHGP9c
                    mNFGGET4QIMNPzjoRSZf2FSCcsMFMEABCOw2wAAmmABDEBo40AYWPNARySNGcMABAiLsQIAJqKzy
                    hhlkjPEGG3GpQQYaFpqlFhpvtDnGGWRksUUacbRxBhx64OGDGmJYkYQMYYCRRx59EOZGGlwcEsUL
                    WsS5Bx9nqDFHGmGooYYZWlixCD3+1BMsrKyZouo/3rSKSc4syriPPjPmU08+ROuaj4c4O5SPOuFQ
                    A8wpgXhBgwlIXPEDCydkUAMNLWCRwx1MDLCABAzk1BsC3vIUgAYajGACBgtgoQkdbmQxxhpWUFAB
                    BjJ8UEEkshyyRoFvmCeGymWgsUZZdzb8rxn/aZjBxRggn8EGHnvUgQQVeahghBhw1BHHHHewsR8b
                    VdTBBA5z4GEGHJ++cZ4ZZXzhxRNRFKNZ0KZqwjM7rSoSvGoJ7ZMPPvfYk7Q9m/kDfakR6TMONcmw
                    ckgXRrgQggccbGAlDFcYkQMKFqxgwgpVqAGICwUYIP9NARBwwFI3GSAAAgwwIYspbvACMKAhBz1Y
                    gQNOIIMHWIEWiCiYG9yQqTF0gQyQY0+dzBIhN7zMQvCpExzmwAY26IEMLMjCC7JAiDzsaQ5goEJZ
                    3KACHSTCD2lww2DIwAY37NAMBCwDFjghLKchzzOM4Bk+WvUHfRRRJAp5oj6iSCuG7ONXE7lH/zqu
                    sQxWYKIRbvCBBQ6wgAEcIAM8SIMjalEIEHTABR/gAAvKEIYvWCIW7oDFAmzCLZ0wqQANSIC3iqIB
                    EiyhDI/IBB5G4KVADCINKyiAC07whVP4IQxlaMMcyGAGNZSBb3Bow1nqRB81sEEOcVCcG9qwBh6a
                    4Q12YAMa8hAGDCBhEHVoGAXB8AUwoEsKU6iCHOzgBz2wDA7/moMaKFOHLLDBHQjBhz2auBp+pMhE
                    /jBEq9AhzYk8sZsTWd4+5oGOa/giFIh4QxR4oIGbIOADNjCDKXDhDHV8KB7NOAYjZEAFUjDjGtFk
                    SCPelpMGUGACBlAABAKAgAPkwAxF+MIdtP+whCpgAQgAIMAaNlcFoXyBFaLgAhjg8AYxXGELcGHD
                    HERIGzTEhQ1tiCAcvtIGTdlBDnehQx1mWgclQAEQY9DCSryQhYoRBAmF6AMnHXahP6RBDGvAQhgk
                    cwVWMMQe/bgHh7bpGXVU8x/+sESrtKFViMiIH2Y9q/RohI98sCMby4CFIsTgBB04ACcY4AEV6CAL
                    d9RjHWR9UT2qp5lmrOILJiCKTRhwgQIogAQVAEBvMiCZAsCACVLIgyFIoQtHiIIXhIDEJ+QABlA8
                    4lGPcwMWruAy+sABDmmAj8pcKtIbyuENPzklG1D3hvW0dixacN9ET0eFxdBBDXoIoRx+gsn/NliQ
                    DWVYAxd4AAoYbQYf8hhrZ7hBolRYExWtCgl2EZIQWU3EHd9gxio8IYgyAAEEEUCAARyAgRg0gQ2B
                    GAZFljejfuxjRg0BxyawEIGmWEkAFKAAkzIgBEXaJAaFaAIQECGKW5DDvNZohz7YIY94qAMcnygE
                    GqhQBzRYAQ0Jq4McfFg5MYQhLcuiAx1upwaRqqW2b+hDHc6whkyhQQ0EmkIcmnADPpAhB11ogx/m
                    kLAx0AEPIpSDG+DgBjRgSAmHgAdn+FGPfaQ1vCNRxnZN9A9ctMoW2LWHFR2CD3Wggx3mGAc6sFGL
                    TBSCCzDwlgMq4AEayMETp3gGE5+2kCk2/6Qf+qAVP4rGEHiYYgg4EUABtmWCFOSxKi/QwANQYAZX
                    VMMa8fCHPOCRjm5cgxnDEIYwjMELXoRWDWhwAx1CJh8qwwENY6gcbcJABtV14Q1v4CUy0RCHCHYq
                    DGtAcRraAIcjO0EJb2DCfr6ACKSmYQxymoN62EAHYaeBDHYIAhe0Katw+tfLJCGzacT8DzCnaLpj
                    vUeg/aEPbnSEgmKoAx6aAIMXSGA3KKjBFPbQCmqUAx8uWsjQYIQQetyjIcVIAwouUIEGFABcE1hA
                    BE5gAp4QoAhs2IMqnmEPfHSDGtmYBjOIkQtawEI8mFDFJfhwSnyppUC19kKcHLeeNeSWLv95WEMX
                    2PAGOKyBX2k43RvGAAaUbuEJaegDHHLwBDUswQ0/aAIfEgEHsrh02D9JQ1jC0AVhkwEKt4BR08x9
                    ElHwzEQ+S9HxwlsPaTjiC1GoQQgecBMCeIAHKiABEObgi3loxr816ibiZaRof9jjn/uoxieeSgUo
                    kGChBdgACTqgAbUNIAqegEY62iGOcngjGbAIBScuMYlGFIIPdTCmgcyABUuVUC17gqUuwyAGMYyB
                    DL7HKRu+QMKI9WEMbJA5z7c+B6g/IQlqMEQdjOAEPJygBmtoAx3kIMcdDzs9kSsDHfYGBx50gopm
                    TYjaTQKJtv+DHkr85zYpYYUSPAcABaj/wAlsEIQkdMEPxoBHNZQDRGgZPpSVQsBI4jVEPtzDjKiD
                    J+QLIgxCGGCBD5yABxDABVxACJRACSTBI5gDOCiDMOwCKERCIAjCIggCbaDOHeSBHvBBICCCo4wB
                    IiTCGmyBGfResq3B7rlFWNQJHajFXehYIETGF9BBHrSMbX1BGTjMc6UBIbCBCDxBEFSBIPyBHahB
                    XtCBHlSI95nFsqBBGCABFojbWaFf+o1EErGfPxBCq4DDWI0PCPSAFozFH6TCM5DDO0hEPbhDwzEe
                    rpwfjSQe80yRPdxCigHCMAlCH4hBD9gADjDAAAQAC/gADGACNgjDIjjCJ3jCJ1hCBC6C/yQ4QiRs
                    wiiowiqwwivYAi50Qh78gSGcgRVUkBiQwQ11ihn8xAi9FL+Aga59gRvYwRaEwR4IARn0gRZ0AYzV
                    YhxUiBj+wRpYBSIwQh24ROX8SB28wUxZiInlyx9swRFAg7whxPkRURo6hDiQCCOomz8MT4qA1zYt
                    wzewgzq8Az3Qg43sA7zxAzyogz9AE3/VQ6Ad4CB6Ez9kVTcwAhaowSE05BXaQRpQgQ64VwVkwA7g
                    wAhgAAqUwR4YHR8MwiNQgiRYgiiMQim8AiyYwiZ0AiWUAWYBQhtowRm4gcaIQRpoY77Ahxn8YAZF
                    iFcUghDMgCAMQRHsARp4QRiI1BwYE/9KLZvwFWEb/MGvLd0cMJecWIirJYxtMcEsyNtmnKE5niND
                    hIZpcJeY+QMttAosnONVMdFVbRk/0EO82cpXkldBHqA+IoQrkMEX/AEjMoIlXEIi3NIXDEEIuBEK
                    FIEN+IACAEAV/IEViEAAJEAEBAEe6IEV8MAOHEEUQAEQvMAKkMAIiIEh9EFt5OAXfIFNKk61hcEY
                    8N57WFAIDUIbPIH2lUAdWEEFfIEh5MEbAIIdzIGvsUFepEEeHIIfZKEYmMEXyMbtMKEqlQVtkIEc
                    IIEjMESijVfaieVEpKVp3IK6/QMytIoljFWMvIg+3AOw1MhmEA369QM+DORfPVFDTEP/JaTFHhDC
                    HgxCJTxCISxCIUBXEVikBbgAGkzBDzCABOjBIOhAIAHADPyBHvRABTzABpjACOhdTnTBIewBB8XF
                    GHhBF4RBGszWToZSBqUBH9xBsh3BFuxBptXBEsyBHXAhH9hWxOgBxAjGHGzSbBCdGzhZsonQy4Ad
                    XPTAH1DRPsjDjJQjd04EJrCfiZhDqwAC/DURGo7EfpVbovmXPZQKP/TX4b3IPszCHHQBHzRCIPxB
                    JWhCkPwBIODBSOkACuwACtyAGbCBDgDABsRBFaCQbwBACSxCI1SBD+iAEUBBFtQAUeRAIQgCWKSF
                    ibEFn3hfGYDB0F3IHhzXHizBEZCB/wuUgRPAgB0UAiDMQZTt4hvMAR1gCk69gYm1AW5pypy41kx2
                    wRnAqhIUAodIzxRl6ZNChD5cYbqFpz4AQqtwQ7CahPOIV67gQ7l5wyZAWR4kAoAuwidkwh7YASEg
                    Qh18wRGswBJYgRAowRkcwhhwgAu40CJMAQBQAACgwCMIQhhUgRd4QRuUQQlYwBQcUW1xEov13lr4
                    3iaBgRgMG1wk12WywRDUQB8oABIoQpTdgQ55zioR2yq1lhv4mjbORZ3w5F3YgRkk5RbQwTfYTAEu
                    K0mQQ1exY5SmCDCorJbu14dAU1oZAx+oQR0MQiIcQiI4AiSUZh+gYCLcQRkwgQIsgf8YCAET6AAg
                    QEECWNkbeIEJAIAFDEAIIILRvkFqkgEHEEANEELRxthr+Z7S6Z7vvQd8RAYa1AEfWMETxNgUnEAZ
                    yMAR2AGO4QHi1EGFRJDfbqxItcEIjVCKfiz2XUgcFAEdhIO8FU1Yyqw/oIhpbEJ4epUstAopQC5F
                    RJFXhim0MkQ82MIfwEEeOIIjEEIfFIIjyKAeKAIjAIIbcAEUFIGRXQERcEEZzMENCAAJBAIneAIX
                    AMAFoAAA4MAgdEoTlIERxOsc/EEh4IHD0MValIGk9tjL1AEXZIGTlYEijIEKiAEfdAEJDEEsykEf
                    UO8d8FwcuNRMtW8ECe5PvMxZzC//XQhuXUSBF4gjZ3iT5j6Ed31n5f4Dq6SIIfSvRNyKeCFNVflC
                    IuQBHyCCJXDC6wKCICDrpuYBG3DBFBTBCoQA7SgBEaDBJKxBEDzABPSBJAwCEhxAAnCABwDBG1zB
                    DfTAENQVCQACIxwCS8ASW8BFB7nUG6gBFniBHcABEKxBIpEoElgBGDgCHtjBHaDBFdSBGDRB0bUv
                    Fo8Q5NSJib1FWqSBwcZBEIQjWYWpPjzukyKClIpZ8bSKORgwRNRDNNUKQ0hDJGyK6z6CI/glI0BC
                    INCBH7Bo2RHBEiwBDXwAEwACGUzBG9DBHYRBD0iAFkTBFERBTWRADOzAIMyBCviA/3Lw6R1IwrBx
                    kFrIR8KwxXxwQR0cQhi0ARQMAR24QA+kQRTYwR8EaRdwAZHF7hDk6uAObvy2h4vFBzGzQRMcAS9E
                    RFmdMRz7QxsXa+X6gxqnCDE0s0NwrowwBC+AFCI0wiM8wibLwSFMAiLoQR1EBiw1AQ74wA+gAARA
                    gSKkgRfgASFEAiL8QACIQSb4ARMYwAFoQAfQQBWUQZ11CRVswiCowUzRxXu4Wi1Or4lFSPiyQR2k
                    wBVIwQtk3xtAWR94QRHUQRiUWG7x3C9/YTcOLHxMLxnEgRZIwTEwBD1klTVDxHiaxjoGsD/8L4m8
                    ykwrnD/UTDx0wRH4gSMsQiAAwv+2BgIlNMJS6gEPjoET0AAKzAALAIAHwAEgbIEW4EEhQIIbuAAA
                    0IAZcBALLEAGWAALVEEk2AET9AAAYMAhNAIa/KvlUO9Z8FydqK8e7EAT0IEWoMEHCEEiMAsb2EEc
                    RFUc6EAZvEEVbHTAsC/8DgxarIXl3AX1nkESTMHv9EP0uCcay6wqhFkA/4MxtIogGFxPh2mH+EMy
                    EAHWGYIg8O0d4MEfRGCrFhcYMMEL7IAMgIDewQByUgGHVsIigMEN2AQJ9EElEMEBXMAGlIAXDEIc
                    6AEUAIARRAIWoAGn5KrjLNu9qYEXuIEeeIEZDAIPDEEf+MAVcIEW6MFx5fUXcEH/HNAAEwSCFurc
                    xc7JpPbe41wf12IB75VBElTBLzDEPJQKl/X0NbshNAcwV7WKN6S2oUmPLmxBFcBBH9jB9cnOH+AB
                    B20seCdBETQBD3DAbiABIgACFYQBJHQCIQjCEsRrG6iBFhyBBDRACKRAE0BKFFiJGogWtqnMG7RY
                    G3wBXlDBGOyBIFBBDOyBGXjA0kpBFjahYYMB7SzBKcNYVUpZRt1F0XGSvtxaKknBin+BFgxBGrz0
                    9NwMP9hDvCl4Oq4xO+5xipjZTB8a0WgGLaDBFvy4GDbMHXS4a3mBFpQBGTiBE/hATQgFGSyCMJIB
                    IHwCKYSCDABAEUDqHSQBADyA/weIABGM1Ax4CR/cRh6wmDZ2AfVS7xWcwR2MnRxwwBUkQgTsQHHR
                    Th/I0kKzgQ2kASC4Fh/sASn1i1qozIyHKHoYUxdUAXqMQRKwwRtrRvQoeESUhk2PtjWlSopAQk8r
                    hH8NwxZMgSqBQRccXR5ArxxkkhWQgRW8QAdAQJdAQBzA5B7EwaqHwQg0gPB6QR7YgQ0kgNp4ABTw
                    QRSAgABsASUkwmPoThzc4HskzBboQSAcgRJoQgtggB88gRMUgjEBO26RQRTASYW0sh64wS4BjKaA
                    EgUZ+UuBMWUcqJUxUfNsmXhJu0OAFQBb+z9QgxJpk7TPiDg8wRHgC49ciB6k7/+xvQEWSMEMiMAE
                    2AQBiEDAAwIfVEImYMKEjkBvtMCE6MAAQEBNFAB28MAG1IAhLAKKXZKcoAETkkEY0IUThFAMxMER
                    KEAYEEIUf4Ec7IEU4P0TfEFd+AEdfAEaYJsPeQH10kdlZwEZvF4WPIF8q8ETGAEl+JW83QxCHNqu
                    0Lw7tKy14wOywizNG00ZEIEP7cgazMFXxEGtTQEOpIAINCYGnIAd+AMlCB8YVAIopHggPIFNnICP
                    oPqevvVF5wETaAElZJSTuRblwIXi28EIQEEmbIAHxIEVyMlzvYG5poEVrMEPkMEgTNnm6EEcLCfY
                    VUYYIGUujhAayG4UlAEb7ID/D1jCHyaaAjJRgkt7act5ePoDJ7QKQGjyN5BgQYMHESZUuDBhP3/8
                    6O0bmGjJlStUtqSBU+ZJlixGZJTIAADAkGQEB1F5M6VNojldlJwQACBAD0B53rgAQOABl1JvXrxJ
                    tKaOHjtw3oj54iaOHShJDu2IIQgHDEB96ojxUgeQjytubLRxQyYMGTJi5rRJMwcMmjRkyowpW4YM
                    mzRatIxJ08WHkVIDJeKjxy+fv336BjpkuJhxY8f+QP2RPHlyqn+XMWfGDIxy58nwHocWzZBfP33y
                    EPuDRoXHFCZS9FoZMsRGChY0IkBYVZBfGy564igq9ciKiAkMAAyQ4qXGDgcA/xgcKBHnCJNBeujs
                    NTNHzho2cLKM+UJDERkCUe6gISNHj542YvpoKRLGRxlBbK6cYUNmjZcyd7wQw4wvyDCDLrjY4AKM
                    M95IY4gyvAHsHoL0KcyffErjZ7QNOTyIHkA8m0yzETFDJ8TOgOlQRQ770dCfQVB4QgkkoOgCiymM
                    mOG2Dz6QZSB+8PHnmDDUaOMPRMiI4goxVCAJgCDkwOKHAwBIIIQgXMiBkDvi0MMNNNxoYw034KAj
                    iBroqO+LAZZQxC460ABkjSr8KOOGLu5QI401xFqDLrrGMGOMMQVcg4wuxDhjjTDC0AKIPtpZUdJJ
                    ETLmRMlIJNEfSC6VTCBKQf9VqJ8WHaLmiSSYYKKJLMw4wgYheNiBgBS68aeeeBzCRQsy4HADDCu+
                    QGMLDpx0gREwNtgAAAU+kOKNMtgLpJA21FCjjDnIOEIOOHIoYwgQ6nrDjTr+KMMKOfIQwoo7EFRj
                    jXfFNNAMectYAw0v1pjjCym+AKOONXLUY8JQCVbRk0s3yZREXTqVjJ2CIfZnVH407McTJpyA4gsv
                    loiCCS+kAEKnNAayBzFTnPAvii8wyeQJkgYAwAEnAiFjhxCq5KCIPQY5ww1C/gi0jTHccEOHMPhg
                    QYgoVjCkETHybYKLNJSoY4kg4rhjjTTchddeNMAOe40zuhjjjC20aKOONKD/kAKUwuxRLOK5GYKn
                    U4VJJKfhP3ihO9SJS/MnHCimCGMLL3bIoo0rAr0it14kHsiPJNIoowgnwkiBJAEUAMCDN9qQwYQL
                    drrAAhvu8AMPdsNoQ44soICDiTP2wOCDPvT4wwws8JAjCDbqGAGMPthAo4oxqH2Xz6/DRkO/ONYQ
                    I4w14nDjjBqskGYgfCTy23uEhLkbb802bZiR7ycF3MVAitBiCi1qREMKLeoA4wkP7iConC+cuKOO
                    HAyQgRVgIDkESAAGtkAHGVygBBSAgAwYAAE9fMIRfUhUF9BgPz9sIQl0cE0h8LCGPKRhCnXgwhby
                    gIMm4EEPbAjDnrrmHTZUpIuGanBhGOSQhitwwQxgEEIWaoUh9A2xIJJA2PhGxIu9cYOIHVLfQKYR
                    BB94QQteIANsnDAFjlQgCOkYSDXCIAX/GaEBD1jBBxIwAAR0QARCmAMagOABBkRgCBXIwB8mgQg/
                    1OENP5jCHJ4gByawSRJ2CFAWunOERDDBAW6gg5jScIY4vAENMWTDJTF5yXgFSlxSMMEX3DEQfcRD
                    H/qQWxPnBg7x/yExM+zYmypQuSH1dY8OPZgCFLQgBig4oQpDaEIXhgCAQAyEG06YwRxeUoMQfGAB
                    CXgACVKwBC90QQgt6AAADnAEFPTAEHk4gxLQsAc/1sEHUQADC6CQhzawIQ9MMMIbanCFNOwAD3yw
                    Q/HGIAYYvsuSbaCWXe6gBzLYMApbmEQ5DIMYe9yje7GcmytWycrL+AMTDQOEPBz6mMBRrB/2GMgj
                    kkCjtokBC3Iogxb0IAYALMAVA2mFF15Fhiv0oAUcoAAIavACVUkAABdQ1gSaYAQ6HOIMasDBEPZA
                    BiB8wQdNuIMd7JCHOIDBD2LYQRt44IJBGMIOY0PD1shQVHexQf8sbwCdP+UwQzrMYSxZyAMzBjKP
                    fIzKH/NoaEYJZg9BXMoyEs0MMvYmDLwyhh8VctFAwMEIKzzBik8wgharYAQ2tIoKMxjBJwZCjkqE
                    4QYdwAAIUKCCGuRACDdAwEoLQJIN8MAIhMiDGOBAhB34YQ0POEIc0oCGOLThDnIoAh3U8IIp7EUs
                    ZHCLnmwYSXe1wax04MMc4iIH5rphDHyIgxmucSGIFGYf/NjHKQdLKcBeyq+aqcdeO+WIw4YXIfbI
                    xz3mOpBoXK8JTWgDIwhRhz3YAS5+0MMa6GCHJhxAEQRpRzAYQYUWXKABJjjCCGLmpAAEwANJ4MIb
                    5sCGs+XADGv/kEEV9FCHPOShC1KYwxK0WM461EFQekrDi18MtuWSCXRycAsc1mCGP+ThCoAA0Tkk
                    lg+FSmS97JWUEU/EiPJmxh+q2Bs2jJyQfZisH0FaxQx6IAc8pOEPl6iEIS5xiE/Y4jp9mMOYIAAE
                    DTV0HtIIhi68oIAfVIELSNABCggAAAQAgTvZaUMhPlACPOBBDWCYAx7gMAUiBCILK9jWGOQwljM0
                    j9IzjsNk3yBJO7xhTGhoQhoakYUzeNFWEvlufKO8Im506hZLzow39uaJVCNEHxTzBzuC4IEyDCIQ
                    h0gEIOYAvTlgohJ2OANWvAAGD3DBQi0ySCiiQA5/wKMe61jG/yLkkAkTTvIMbQAED24gLjU8Ugn4
                    wp4clIDMMLhhTxs5w7vhLWM+ueENWYMDGe4QiDaQQQcz2EIcSBEIIUhC2oaR2D7uOusNkSKiri5f
                    wwqucAo5RBg+gMJ6AMSGPnBhV2t5gx2+0AU9yMEIGkjCNCSGj3zgo9aGuQaQEXIPS1zBCVyIAxpA
                    9wY1EC0NYTgCFfYghBgUTQ1iGMPNzcCGMsyL6WaY9IzdMIc9yCEOcsgWGB4MBjzQ4Q6EUwQ6LtRs
                    iXPIREd0dWYs1TBYjt0h3bOGFaTABWQGgQt2CAINwtCFLJAUB0Jgwxhy8AEA+GEgGHKIPlguMYWy
                    Qx8SUcfG5f+gMfyE4Qy7W4MantCFNLggClzowtDKQKT3cEFAZTD96d2yJ+bGIQ93+MIYlPACEhgi
                    ECooAx+E4HcaFGEV87hQ28e+IVg0/Ox6tejDJK6PdyDGIfeDghvwUIUu5EENLhDCGLA+hBL8QBBL
                    sAEQBBCBahzclA9xSD/OMY56uCgae/hCFpzAqjQYvQxiQEIZzrAEJMxBBUl4Qx3O4PWoIC966Avm
                    5fToYtLSgCnk4A5OrAWOQAmOQAbwYBbWoAfEgA2W4C6goAx0gSD64R7AK/gWAx7QK0SU7Ow0Qxb2
                    xkfGbh6CBDFcgQM8QAvY6gwMwQ+EIAeiwAyQoAhQoAj+4Ab/eAALQIAB9qB7CGPKBiIb8qAQcuEd
                    /CEY9kAM3KAFQqANekgNwgoNkqAI4AAKZIAMvGAM6OCExAAM8MKK1GCazCAMvEBRxoCH5GAOzlAI
                    RKAAYoAKCgcLmOARZOEIYEAQ+CQQviAHbKHwvGsESXAhbIH4VNCVLCqUJE4xmE8JMsAK9sAP3IAP
                    1oAIlkBqwEANeFAPjCAKaMAEwgAGToEg8uEcSkMZ+GAM7qAMDuEU9iAP+kAGBEAHsKDm4iKsmCAG
                    eOgJysB53GCHuuALwgAMumALsKAL4PCEtqALEGVrkEAGRiIAVCAKuqBtsEAJuGkRWCAMgIMPyGAI
                    cgEwGLER/xVCHk7QM1JQBZnMFFpQ4fqhoVxED27g+SjJuohACqYAC/6PB8gg6JhABGCgDhTACejB
                    4AaiF/JOEVwCDcRADbjABWIgGNbhCmagCIKACQpHC34gCpTuC6xAGrFgmsAgn7zgCn4JDJTgC29g
                    BoCACVxgAxaAJCDABpJACnxACIIABU7gBpTgENxgCe5ALOLgClChyNyRMXCB1ehxRFatYQSBEqOs
                    o5iPIOJAB1aFCsogEPpACqhg3exACoKg9WpgBnjACrQAAJTA94gsEriAC+CgCvMgEF5MCJ6AGhLD
                    Fa4ACpSgOZaACJrAC8zACqZADGzEC7wAdo7gB3YAB3IgBv9WQAeyQA9KQRvMwEkEIAFsQJdYoARG
                    AAJiwAJwAAxs0QrQQMPooAwiQR0IAiqj8iDgERLpkaL2BhZmrR/ooTDkxgcyQAvCoArcYISq4Av8
                    wBDuQAe8gBHQAAduYAv2gAoAAAnAbiBgQQviABKQKQ244F2OwA0eRh/aoTDaYRk4QQt0wAd0AAdm
                    wAdeIAZ+YAZWAAaqIgVCiwZuIAr6YBSYQSvvAAAEgAA0YAigYAvgwAYiYAQ+AAV04AZ8TF2+oAww
                    jA3wIBsSAx/a8TYH4hEvpdWqckSsYW8AAfmiLB8kovz0AQYowAzQgAvqIPqAoAwUIal8oA0mQQpQ
                    YAouaQn/AIAJBsYWyCAO+MARGmEQZnEKxuAI2AAxSkkJ0RMcrCEYUsENvkAJdgAIjgAK2kYNGuEV
                    kqEaqGE7DUIWRoAkKIAH7EwI9uAJSAAHYgAKeMANFMEFdOAKSsoOoAflLqQePvQ2TVA3q9IfKGFv
                    WGHWVs4fUiMYXuAGcgyHAqELgIAMQOgKiGALFCELeGBomEAIGiAT/OEcbqEO3MAQ8GAPAIENMMjz
                    uuCOAKPxQjDhIHJ76mExmJAdhJQkDqABMMADiAARwuAEVsALnEALFoEKUAAKuOAL/qwMANNRPRRE
                    E2L4RrREM0Ua9uYPIo699CFuFIMQgMAL4EAMyqAP+mAK/6yAECwhDoxgB8IgEMCARqOAB5ygCK4h
                    GwYBLyNBEOiADuAgh8ikCnaAAuggMezBoxAOBAGjMfpBiO7Bo9IhCnyVJBggBEggDewgB1hgC8RA
                    CgyBH6cADp5ACvigDGqlRWzVWv0BHUCEvLRVU5CsU2TNyA4j5QYiEIxAPWJACQpBEJoADFyhE4Lg
                    BpwgDuhgDLDADH4gBvKFEvZgDfzADurg0uygEAwhDcBADFYgBWQBowpLYgZ1Q/ahDAIAABpgACxA
                    BoBgCpDgDxylCL6gCLrAEjLGcnbAByjBIeaq/Fy2IESBKmeWRKihW6c1vPahHhAuSPxhFngADLag
                    BJzADv8agQ7YABHKQAkgLTLHBAtagAkmYRGqrhA64Q+8YA4GIRHqAO6eAANUIBR+xEXgq2DQwAAc
                    IAKkAwuirgooQQ2SYAdsYAkQ6QqOAAh84AhoYPxCUIgClyC0oWEKN1P4wRL2BhJSQ3GFcyCo4TXU
                    4IXMAIS4EArsABDM4Arg0guM4AfoABQaQQ8MoRAeYRDu4BACbA2CgAha4ANSofAiQpRadkVewQFW
                    AAcUoAbMAA/iIAvwIAyKgAdOAAioAIOYoAcSswqawfxa7nkfomZDhESnd0Sid29SJLzoytb8YROa
                    oNzsYAqAwGq74A3Cdw8g05+ugAnQYBEeARISwRD6IK3/VvUbrcAJMiAIkMF/EYMwbHNSoEAATCAF
                    zCAPvGAKosAInsAHkuBVxGA9ngAKsCAM4KARxOEhLISDiUF6Q1hTDgYrtTKj7mFCGs8f7MEQ/LLb
                    oKAGhoB2ZGoR+sD/7sAMB6ETMuEPCGES9ADD+sAQ1OAL2KAHHMALOBQfPEoxDqNsZckfumEGKuAI
                    UnIKguoIskAJtIC1vqMNMOcJnAAP6sASQGMRnxceDIFw03hEzKFbTUFxuafw/KEcXnINjqAHQAAA
                    UAAPzIAJ3AAQus0ZDcESJMEQBGER/GA7AEEP0sAK3CALACAJGFY44YuuIKZhwQEKeqAKrCALwgAJ
                    nA4L/8CgBnjAC9rgDMbTCZyAERYBCxxhQuBhiRvRyS5lHmd5RFihW63BhJVYQ9SBD/jnBjaASgBA
                    B9YGDAZBEopADU6hERqhD+xgEPYgDgRhEIxH1IxgBN4gUhjXZPaB5VoEH+5BnzkkH3LVHwABAo5T
                    C85gClDSCX6xCK6gDZqCDJrADBCBEwIBDjphHTh4hGX2n0lkHoCmYRThITMqZ8svHbTgBJzgBDRA
                    AiJgJAygChzBEAChC4qgEVShESJBEfLgahdhE9BACeTJBmSgFX6kYe8qYu0hgDvkuwYiFiogB2Yg
                    CMDA52RACbCADLxYLObACF5AC/4gE0yhEL7glg/Oo//0AaqDzx4coVMSRqkzxRe61QUd6h7koaHO
                    AQzAgBcy4QFIogJ6AAAkAA3q4AdQABAkQQ8uYRMKIZIE4RDMgPRilQZwATA4ypIppTSCxBx0AgEW
                    AAjaOgVqYAuEgAr4QAnawAsmAABmIA8qwREIoYdbylEXCh/mYWDGTkSTmrNHZB84ZW+0IaotpJT8
                    gR5Sgxg6YRJ6IAROAAAKIAIaYAwmYQ8oARQwYQ/SgA6wLQu2gApKQAiYKB+H25v9Zh8m1iFcwUke
                    4IVcoAOWQKfzwAm2oAVWKgWSgBGUFBUsoQ9iQUPwoR7sgXGDzxti9kT6Cr1JBBu61REcd7DwwUXs
                    4bD/YIFZ8gwAjOAR+sAPMKGp84AO9KAMtmAGToALCo5iSgPCv4eUFOMRnMQH5OADMoAJcOC3smAG
                    OocBPEAF9MATLKETSGET8OAX/AEf0oEfTGbs8MGDQ4TG8WZwFdWhFvH8MEQfBBXh7kEVtKAESAIB
                    mkAPHgET7IA7WAi3pKDLQQGjHmK4C2JUMJ3KKeUeVI6UbKUL0vYBdCACBiAHKoAE3uALcCbPJgAF
                    wKASHsESQmETNCEQbIEf5AFDcnzWWNBQ8fwf4qGpG0Z7UCln86EwWLQg5uETCpwKRqKn2uAQ+uAQ
                    FoEOvoB6piAGzCCDzY9swSvTMb1g6mGl7QEG/UEd/7Bgc/KsAPKsCvzhEGBmAjBgBdYADwSBUy5h
                    EJzgA1d87E5Us38db8arYQyhjYeoNBYX8VykMFbBC/YgaEIgAHbSBLL2EBwhD7jACpYgBNggBsuv
                    u0ZQykWeEcF9UEs+Yi0kl/3BG1IgbQHAAAwAm1rxHoyAJjonAqjgxQChEiqhEwQBEaBs16NMHhAB
                    jQNeYax3b0CBpSMGHtjBwRlqIOgBFRQzD/4ADVoA5kniBxaBC4vOCLwAFgYmH+S7lIg7cA4i0xfj
                    5BlKrxFvICSBJFLrBFJhHLqHFWaCJiLXDf4gECRBFToBFBShE+Jh7PT8vI+eRGC2W32Bbqb0ruiB
                    vP8VgxxiQQ2wAHrAwAg2YCZihgGegDvcgAoSQQod9fAA50LEtowNIo5No+34oXZLZhuooRq4Afkk
                    XG4Kq7vuwZR2/PVVA2YAgAa8yJvTgCYOAAj24BAYQRFWrBEs4RCyAHIULnw6xZ8Tn0Q8G0WZKGIQ
                    PvL9FjH02h/MgRTsIC7KQA26oAYegAAKQAAaADkuoAjGYAteQK4NTtMfIjWuQRSE4RkAAlakV+z8
                    GTxosN++g+9IZQHyI0ocO5S8ITzYL18+fgbz4dOnz2AdACTF+OsHjp08f+VOkGzypw+eNJHYgCkE
                    yEuUcRd7+vwJNChQcID+GD2K9M+/pUybOn0KNar/1KiYklo1qmil0K0/+YXsd+9ev4PHUskyRaqN
                    ljFn2JjBIqMBSQMGBJBcUGFECABsgCo8aK0LCxQujAi5AMBEF1/2FtoTt01cvJOwvPQQwuSGhxpV
                    jlwxZpAjxov25vnbN/aNBTyjWF2q5ImVKXfDPgCYweSIFRtTpqjYMgbRkDj1uBo/HpQeo6tIpzp/
                    Dj2qO0HMk2IKifz42NBj++1SMyULnDhVztBBg4UIiwUABpAUIEACEDZryHzRkObgvnsG26mj9w01
                    6CgTRAM2+OACCj7UQAAAOZgxhyOSjJFCBjHcwcofKtTwxRhfcOEDCkHEIMEQwaADTTLHTKOOP/K8
                    /xOPOL90Ugo2BtWTiRqYPCLHIJA0csoprZwjTRsRJKACE1HI8EQOTHRxBRhCuJNdlcjxo0l1Rm0S
                    XZdeTtWMlkjBYuVW/Wy3z0L4iGJGHHS08YcgcFjBRA8iQNBgewa4BwIajVTChx90CPFEMf54Q8wt
                    u7wSCSGNAPKGGSxQQAIMOIRAgQQnGAHGHGJAcQUXUPQQRBVeVBFDCl4AAscXaayxhRFKhDHFFmiA
                    scUXbyRiyiZsVAHGF16c8UYhriCSRBxrxCGII5tYUokpllzSzDBMoHBFGHXMUccRQtTxgRG6lEmu
                    ULSIyciX6q7LFCpiHqVMuT/pw988Wn0iwxZ3/P8Rhw9CSPHCCIgBYIACHjAxhhUwGBGpFlM0AYQH
                    BTARiBxmhHHGGVtQEYYdY2CxhRidBYEDETwQ0YYhdtixh5t9DIJIIoAUYkcdighCSCWRUGJIHn4Q
                    4scbYIBBxhptoGGfCgyk4MQbfECRgAUzGPFFGGXkoccfZ4whRx95nFGIKa+wogkmr7Syxg8sFHDF
                    SfK+fRAz77JL95f3KPLuH4BYBPdF+cSDj0FsAFCDDjv0kAAAFTywQQsyNJFGIZHwAYgigPAhhxpg
                    jLEGHGFEoUYcc4yOxx58vJxIIY0g4oglk1AyiSWUNKJIIogwUsmziyTCCCJ3ALKIIL8PIgcdgajz
                    IcYcbZixhhvL7iHIIIAEIhMeePzByCSFDM0vGmzYgcgeX9Chshpl4LHLNcQEw8sw0whjRRfpYNe3
                    vESJmUrd+kcXTlHvGtKi+hnkHsUxyCsCEQo2RIAkCNDBFejgCEpoQhKIUEQgJuIoP4xuDoUoxB4W
                    AQlE6AEPfghEIRBxCEEcwhF7OEQjAsGI2RFCEIl4xCMgQQjJDeINb7iDHdRABz2sIQxrMMMZymCF
                    V6VhDnIoQxzuwIc9YK0PfWBEIwZRO0dcAhKb8EQoTuGJSnSiNazwxCtScQlRvMIVp+BFMoBhDFzY
                    Ihff8Mc6yCFAcqkDEeja/58fn2OMvP0BElqp35l6gg9MJC4JeHAUI2xoOdMFwhBA80MiAjEHSSZi
                    EYwIxMz+4AfqzIEN49FDH/RwOj3AgQ1zyEMd4EAG88DBDEYcQywv1gUiyqENapDDyvoQCFTu4XeF
                    oCIV+cAHLN7QEZ0wRSg+4QlRdOITt7gFNFthC1q0AhSXAAUrcPELU2gCFqkABSlm4Y14iOaQeRSK
                    PCTRxz/KUyqgEKQmAtfOg/BDNGIAQBcWYYc58EEQgujDHdyABj8oQg9kSIMhHGEI6YHSD39YRCQM
                    8QYvkIFbYfhCGcyAhjWo4Q11kEMd8mCHNHShCU/wApSygIUqZEELV6iCFP+sQIaEgQENcLjDHeqw
                    h0HIpBCLGATQoKcISFQiE5eIxCU84YlMdOIUnxBFLmZRCeCNIhaowAQjDKGIp1bCEZyQBCdOoYpa
                    pEIaHdmHPvKRT5/ogxNzm6ddn5IPRwiSFKKJq0GUcQIKtKEOaZDDHvQgB5L6ARB0MAMYzoCHQ1DC
                    Eo44BCAoWrlF8MsNdcDDG8RQtDac4VRV+ALRjGaGLoCBs3DI2BmKVkQuTCEKM61CFazAhTH00i1m
                    IIMc8kCHOrihDXooBCMcYcVKYMISkmjEIyaRCW/SAhWScIQnTgGKSAxCD3oABCNUYYtb8CxmmEAE
                    JcpxEHrYw68I4Ycp3nX/i7vKtynvoE7eWMFef9SDCAvwwiA62Ac2lGENdljsHLjAhAdG1A97mMMa
                    PDQ0jK2BDXUgRCIIQQhA3KENY9iCFayABSpA4QlRqAIVtlBYN6ThDXSQAxzg4IYzhIEMbKDDT+WA
                    Y27VwQ6RcsMbxtBRL7DFaGyIgx9kUgc6rMwPgxhEJl6xilCQQpqb4MQoVAGLVUTCE9R1RCQWoYhB
                    CKIZA8Rnfv0Bi3flb75s/sc0BPkHW7BXFUI4Qx7moNk5FBeiceBCEpQABSy4FAtMGIIQftCDHvjg
                    B0SwQkjLIIYvhMwMZbBPFZzABChMgQpSeAKJl+CEKjwhCU3oDRVsOwUp/1yhoWdoAx2whoc54EEQ
                    eeDsD1st4I6KIWMd3ZwRyYAGx7JBD3m4Qx9WSAlKPCJ1gvCDI3b0CEtkog9ouIQszuEPkJzZH7Z4
                    V7ra3OZgwNkXcWXHTAXhBVeToViFmEMYtCCGOmxrDnFwAxvGMKw3XA9nhYgoH/LQYFr29gtWaAIR
                    gnCEKoRBDBsDlRjM8AUthOFVAidDGMxg0jawgQ1umEgU90CHZclha3TAg4qNKFIgz7gMXQi1GKyW
                    Bjj0YRF8RGkd3hAGLuRhhiDHwyLygAZNMIIXBlFvfonhbXArnRRwBk07eTGGONRBDM6TNRu6MFsq
                    fNgKtsqDIAxxQkhcov8TmZAEI/iAhzy4KRCE4EMc2EAGLlDhCU0wAhCeAFOtc4EMcODxGu5gCETw
                    QQ8bHoNu4W7LMyzLh3bI3El5CQc5bDAObXADHUoeCEHQwQtTuMIY2uCHSVTiEHmw3i7f0AdENLux
                    UdACI0zxiUcMIhbFsYeZ30a/gwSyrkoHtyWaLi99LEQj/vjFENQQqD+YNHol7EMcIH6FLphh4xDf
                    Aheq9oUrOOEIQ1hCqp/gBCQU4cReCAMYuICFTlshC1k4dRa6YEtceeHh8n7DGUKKTBsX2/6qTcMY
                    4J8G91dpaaBxakBLPtZKILcGWBAFXXAGfUAJicB3eLAGaeAGv0MIf1D/UoulB3XwB5ZgCLYzCpOB
                    EexUJuZwEbsnJr3HgsshSE5XJf2gDx/hD43hD48AAzbGB3+AB3bAB5PUB1xgBFcgB6hEUXpDCHVg
                    BmnAhGnABoMlB0jjIVcQBU3ABEugBEhwBFtYBEDQA0CwBFhwcZVWaWMABmFAeWcgeWvALW8gOiwD
                    CDCDCIUQCHfwBkVESm7gYzzkJnOwSmqgBmuwLHRQBmnQCJsQCGlgfmvAB4XAB8vzBn5wCIgQCBr3
                    CLOwC4XABsmAEfywD/xgguWiglrCgiz4DhkoSMBgJV5hEKiBD8tAbYCwMiilB3QAiEdDBnGgSr7E
                    XVjzY0YkcGYgBlwA/1NYMAVJ0H1NgIVJgARJYAQ/oAM2gANB0AQgtn7XNwZG1AVi6GIaIwZe4AUd
                    sgZ0sAdUJAgxM4eC8Erccgd4wF3c5UPzFgdyEAdmWAeNMAlyMAaotwiPQAh08AaAAF2YkAmesAqz
                    4AqjYAdiMAr8cRL7BIrbUS5Ip2alyILoYF95I2cx+BX+gAxhYAXfAwceOAiL0AbhUQeUUF4b9lt+
                    4Ac9qGKAmAZocH9dcFtXkH5HgGiJlmg8oAM+sARU4AW11AVigAZooAZt8AaS91pwcARRQB9/91PP
                    twVOIJRb0AU0Vgd+MHjFZgd0MDrylmRM5IfD6AZfYwaKgAmiAAujMP8ITxhKgfAHHQgHa8BDb2BC
                    hyAJyABXfRWKVqILebNmFtl74uA/eQMLfcUV/VAP67UQ0WAFYCA8HXWUaGAIjcAHwVUzdBAHLyZQ
                    iCAJl4AJzWUIfnAHtlgGH4U0WhAFTwAFUQCbUuAEWvAGanAGFuiDgCAIgfBfk6gIGOYIOdAEg0AJ
                    xsUIVtQIjYBD7UgHdRlsRvQqHVc8pWc91elKbJAxaXAxoFcIfsBLfJA7j2AIMVQJkxAIdiAKxKAM
                    w7AJnQAOp9Fe5MIPsiCYhGmR2wBnf4AKtycU+wBXGeEPzeAFWrAGckCAb/AFURA5jvCPdEBD0SNm
                    l5N2wyQH9dEFWfD/BV/AflywMU7gBK4ZBVIwBVYgBUnABE8wBbeFBU+gBFEQPwPWBuYHB0FJHx7S
                    BeK4lYHAdpT0B3cWB50JB28wXG9gBz7UjnnAB28AB5iEBnsQCMCGUHcQCaWwCmgxCp2ACeVpCcFj
                    CcfTWYUQDf5we4p5Je7yLlxinxYpN3DmCetlHPpQDwvhD5gQfeEBBVtABlsgBVzgBnZQl0LaBnPg
                    BmOgBVRQYksABERABEWwhUiABEBwAzRgAzqQAzUAAzAgA5KKA9EYAzmAcF2oA0LgjEVQBIoaBDdg
                    A0WAfklwAzuQAz0wBFzIA0uQBa35BKoWMmQgBrvKq2WQnYHYBiK1/weY8AmH4Et5cHpFygYYI3X2
                    N310MAgqsweNIAl9QG4O2YoSeRz44Al5821papHKkJ+SQCVbwQ/3kA9jMQ+FMAU95AbAESlcsAZ9
                    sAcqFQZh0AVesKJJkAROMKJWMFtOsARaeAQ+EAMq0AI0sKlBIARDYARJsARJAAVeQDS0VAZh4AZ4
                    AJYuFqRMVAcdhAc+VZ0/dXn0BgdtoJ2p6QXXFwZjUAbBtnAui5Rp8EpekAeg0AmCEEV4IAds4ISt
                    5I6AwDqR8COREAmSIE2h0Ai+0A9umq3Z4Q7wlHTgap/FkJ+K8J5CcUhqoghPgJS2aYE+qwZ1oAe1
                    OQd0gJ0HKqRpoP+LdaAsF6taBBcFrykFVKAFWoCVYCAGY7CrL2s0SroGIdUGcKBkeEBFUsRdVMSV
                    PahkdpAHfUBRXFlsLXa2l7ctUblxT4iyZfAGgyAJIWQIh0CHoKQ3pAszirAcdpBDhrAImZAIwlCD
                    7aWtW0EOeDO1VFu1+QkI0GAmMmgQm8AxXXCjensGgThcR+mzZcAGbtiZ2Hl/ZuAhWwBTstkESVAE
                    hkYEJ/qaKWoFNpWiWqBau2pLqgmIFqur50uTZ0BLuvqyRnR/TDhhIqUGAWiBvKSdZEAGK/uyIdVx
                    gigHdwCPc+CGdQDAiwUzjrBUmaAIXyAL/iAWo3Ec0HCYWvKtuGv/n9eQn3+AC2R6EfUwD43ZDo1Q
                    Ai1glRO3BltzlB9FBkMjBr7KhGhwsTOGr1oQU7NVvaU6BEVgBEZwBH/GBB7qoleQBbmitysbji1L
                    BoXYhEfpWk18RCEFiFFsgKmZU7xqeElMS2lgccwjpGygBmhAgPPoYm6AY50ppM8nsEswBD2gBYPA
                    VvggkbMbFLggSGhqweCKDRkMCoXUE/cAD+vwDdzACmLgjDiAAiAQAoTxAiiAAjNgAzBwAzqgAirg
                    Ai7QAiqAAiPQAR2wARhQARMwAQ6wAAhAAANAAAVAFweQAArAAA6gABawApPMAi5wqY58A5vKAz7g
                    AzrAy5SaA5Xa/wKV/AIvcKmXvALHjMwtQMwyMAM1cAOoegOvGgSLaqKgpmpFmQW9AQVKMAQ7cAOX
                    gQS0RTQ8FQifIAu2oAzusA/4sBFynByiIEiDecd4PMHvgrVBoQ/xsF7xAA27sAqS4AfbYgdncAVa
                    oAYq9kQcNx6r1Bb09gbByoSQ9gVdgJWmdcW3yYRvQGxYczp9oEK+eVyPoAgjnQgljQgoNImbtAir
                    Y1QYhmGGgFj0Zm8nzAU0LGJWmARCcAMswALCuQVvkAcVJUGf8Eyk4Aq+sAzW4A3koM5wQw4uWJHz
                    bMH3A2eAALvIsQ/0EA/wsNXrsA7wAA/s8A7wcA7poA7ssA7nMP8O5FAO5UAO4iAO4PANbR3X4CAO
                    5nAO3+AN4LDW5YDX5wDY54AOg50O68AO7QAj8jAPYWEP9lAP9UAP2Ioc+mAP9DAPjg0P6BAO22AN
                    2bAN09AMy/AM2OAN7nAPHOxXxlDP1SHPUo27qAhnokAP20bbtW3bPWEP7yVIrs3btgtnjMANty3c
                    wx1X4KBXu83bvN0JGRxnqE3czw3d5tptglTByS3VZjqueBTd283dPmEOlPDb1i3ey8DcgKALudfd
                    6T3c/KALq83a4g3fhsnckpC16m3ftQ0O4A1n8QXf/f17zC0Ls33fAx5X9iAL7s0c1d3f4o3d+YkI
                    zEDgEV4/0ODp29664Be+FM/A3EahCeIg4R9uJeJAV/nZ2hje35Ow4X/ACuUK4i0OFO7ACgie4CZO
                    40uRZhsuCLrgtC7O4/bAC7BdxzUu5P8g42JiCL6A3jxO4PoADIbA3EMO5SO+4YpgDEmu5N2tD8ZQ
                    4dQN5V3+DymOFcSw41ce3fag5Rvu5WmuCmD+B4aAC3xM5sItD7rg5Mxtx2nu5Y3A5oLACtod57Vt
                    Dq6QkRmM54W+FLvA5kbBCdJg5X9eP/pADVLO3CVu6F5eT4muCLpQEI4uQOygC1uen3de6ZUO1WzO
                    Ccww5pyeHfjADJLO3Ar/PuqVjgyJfhSCgArUwJ+qHhT4QA2qMOgbzt+xLuxMIQy0fhSEwAq4rus/
                    weusAOQpHuzDLu1L4QvGXuuioAwBpOvqoAyi8OvQPu3h7hS8YO1IAQmyQA0CruT0QA2yAAnlHu3i
                    Lu//QO7ljhSSAAvQsOkEzg7QAAtSC+/zLvBO8Qulbu9tLgq8IA3osN3oIA28IAp1bu+MEO8Db/H/
                    YPAHbxSAYAmowAvQIA7qnk/0IA7QwAuoYAlFnuiwfvEtvwkaLyaCIAmxgQu+4AxKzdTuAOcHIQ/u
                    4A7k4A3W4Ay+gAtlJAnfDvN/IOotz/RNsQsZn/RRL/VGQfFNb/VTkQpTd6/1SU/pV+/1TvHyWy/2
                    YL70X2/2URH2Y6/2WlL2Z+/2UpH1ay/3f9D1b2/3U3ELaT/3ML8JFX/3f98lqQD1e//qdQ/4h+8l
                    eU/4JO73iO/4+nMLgr/4R8EIqdD4j4/5d5UKcT/1m5/5ny/Vmy/6gin6hg/66hIQADs=">
                    <h3 style="text-align: center;font-weight: bolder;font-size: 2vw;">IPHEYA IT SOLUTIONS</h3>
                </td>
            </tr>
            <tr>
                <td style="width:80%; padding:5%;background: #fff;border: 2px solid #ddd; text-align:center; font-size: 1vw;font-family: &#39;Gill Sans&#39;, &#39;Gill Sans MT;&#39;, Calibri, &#39;Trebuchet MS&#39;, sans-serif;">
                    Hy '.$name.',<br><br>'.$message.'
                    <br><br>'.$btnLink.'
                </td>
            </tr>
            <tr align="center" style="padding-top:2% ">
                <td> Follow-us on </td>
            </tr>
            <tr align="center">
                <td>
                    <a href="https://www.facebook.com">facebook</a> |
                    <a href="https://www.twitter.com">twitter</a> |
                    <a href="https://www.instagram.com">instagram</a>
                </td>
            </tr>
            </table>';
            return $body;
        }
        public function emailBody($name, $message)
        {
            $body='<table style="max-width:800px; padding:1% 10% 5%; width:100%; background: #eee;font-family: &#39;Gill Sans&#39;, &#39;Gill Sans MT&#39;, Calibri, &#39;Trebuchet MS&#39;, sans-serif;">
            <tr>
                <td style="text-align:center">
                    <img img alt="Ipheya Logo" width="30%" heigh="30%" src="data:image/gif;base64,R0lGODlhKwErAfcAAAAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwgICAkJCQoKCgsLCwwMDA0NDQ4O
                    Dg8PDxAQEBERERISEhMTExQUFBUVFRYWFhcXFxgYGBkZGRoaGhsbGxwcHB0dHR4eHh8fHyAgICEh
                    ISIiIiMjIyQkJCUlJSYmJicnJygoKCoqKisrKywsLC0tLS4uLi8vLzAwMDExMTIyMjMzMzQ0NDU1
                    NTY2Njc3Nzg4ODk5OTo6Ojs7Ozw8PD09PT4+Pj8/P0BAQEFBQUJCQkNDQ0REREVFRUZGRkdHR0hI
                    SElJSUpKSktLS0xMTE1NTU5OTk9PT1BQUFFRUVJSUlNTU1RUVFVVVVZWVldXV1hYWFlZWVpaWltb
                    W1xcXF1dXV5eXl9fX2BgYGFhYWJiYmNjY2RkZGVlZWZmZmdnZ2hoaGlpaWpqamtra2xsbG1tbW5u
                    bm9vb3BwcHFxcXJycnNzc3R0dHV1dXZ2dnd3d3h4eHl5eXp6ent7e3x8fH19fX5+fn9/f4CAgIGB
                    gYKCgoODg4SEhIWFhYaGhoeHh4iIiImJiYqKiouLi4yMjI2NjY6Ojo+Pj5CQkJGRkZKSkpOTk5SU
                    lJWVlZaWlpeXl5iYmJmZmZqampubm5ycnJ2dnZ6enp+fn6CgoKGhoaKioqOjo6SkpKWlpaampqen
                    p6ioqKmpqaqqqqurq6ysrK2tra6urq+vr7CwsLGxsbKysrOzs7S0tLW1tba2tre3t7i4uLm5ubq6
                    uru7u7y8vL29vb6+vr+/v8DAwMHBwcLCwsPDw8TExMXFxcbGxsfHx8jIyMnJycrKysvLy8zMzM3N
                    zc7Ozs/Pz9DQ0NHR0dLS0tPT09TU1NXV1dbW1tfX19jY2NnZ2dra2tvb29zc3N3d3d7e3t/f3+Dg
                    4OHh4eLi4uPj4+Tk5OXl5ebm5ufn5+jo6Onp6erq6uvr6+zs7O3t7e7u7u/v7/Dw8PHx8fLy8vPz
                    8/T09PX19fb29vf39/j4+Pn5+fr6+vv7+/z8/P39/f7+/v///wAAACH5BAEAAP8ALAAAAAArASsB
                    AAj/AP8JHEiwoMGDCBMqXMiwocOHEAWmmjjxj8WLGC9SnBixo8ePIEOKHEmypEmSFTOqXMmy5R+O
                    J2PKnEmzps2at1Ixcsmzp8+LjFLdukm0qNGjSB3m/Mm0aVOhSaNKnUr1oU6nWLMyDVq1q9evNG9t
                    0kq27E9GQ8GqXcsWYSqzcOP6TNW2rt2pY+Xq3dty092/gGPm5Uu4cEa/gRMrbvjWsOPHGhdLltxr
                    J+TLkNFO3lyXE2aMgBx5QkXLFzNp3sC5W+2vtevWq92B8yaNmS9aqDw5AvQZMeffVC1DlmQKlzNu
                    8F4rX868+Wt43JzhMiXpMSPg2I0KE05YkCZbzsjp/3NOvrz51/rIObOlSRBhzdnjn/RlmJEqZOb4
                    nd/Pfz8/c8iowl1caclnoEf08YUIK86w09+DEPLHjjOsIKJXgQdmqFAwfHECDDkRhijifuQA4xmB
                    GqZYkDF6CUIKM/KMKOOM5cnDDCnumYWhivItoxcozNBD45BENkcPM6DAtSOPvzUSFyXECFnklFS+
                    Rg8xlJR1HZO/lQIXIbKIU+WYZLYmjiyEkOUbl4n9AhclyuBT5pxk6qNMllrRxSZgj5iFCjd0Bjon
                    N6iQtaddsJQlCCwOCupomezIkqNTax7qFW9aGcJLjI92WqY8vBiSlaVehUKWIb7Y4+mqc9rji6hO
                    be9JalSTOiUILqqyqmuZ9uhS60+zIlWLVoDIwumuyJIpDy2YMlVpsDNhohUp6CRr7ZzqmBIrtDRR
                    o5Uk2lwr7qB4MqUntyWxkpUhxOg37rtj8mMMrGehS5ImWamSHLz8jgmPulvZCxI5aTrlCDb9Jkym
                    No40taTAC0mTFS1yKmwxlfjY8hTEDsWClSPeXCxyleA0XC/HCo2ClSsVj+wykfrIEjDKB5nMFCII
                    v6xzkdhYCCzNBPnMFCf77mw0jfCc6BPQ/4xTMFO6uHv01DLyo4u5KIvTrE+IZNNcP2CHDTa8+OzD
                    j3792NMP1RBqIzRP5/+i683WPWnSzj5ii3323mevPS4/8+TjTzzt5DOP1GyTl/c7+M5lLzZOtZLP
                    PnjnDTbfe/st7tprI+PLPYnvZ/k+MjsOrcRMATIM35a3Hja8a5ezhiWhi265P8rQzZKsljLTFCHa
                    YO666/yes0UT09R+XuutcfO0S7yz6ftW5wyft8hybgJAIsovf3tr6gy4+6GQM2VJPNZfPzIdMvzS
                    2j2ad68c867JI21P0aeoNVOgqJ2+2LAbmz/8hookZMFr96iH/L72PdfggxSmU9E5dNcSVOiDH8QT
                    GQb9YQ/Q+eMZY+iBIgRXD8QtsD/8KFRP4nYgdjyPJ7C4IAbpdzG/3UP/VecoxBCmkLyz5SN+J+QP
                    P2gRQQPBQxFMsQXraGixtZ3NH/nYRBRsMArX7GM8QQyRxlaYoer8BBcDTJ/L9KFAf7hiDDmYQxn9
                    oQ8sZjFCV+vJgRrnEzCG0Xoiu6I9hKSMNHRhCssYID8o98YRAWNp8VFFEhmoPovxQ3D+aIcdrNAF
                    UHgQH4cr5IhwgUjgFGORjARgHjnYCDFQYQ53i4c/9gFJTYpoi9ADDjeYAgvFNVBkp4hCGZpgC0He
                    Yx+tMaEr+0NEnuQvMfB4YQWF+TJ+KLAf+NCHPSqmDCyYQQq0G+Aq/QbEYfZHhS5hYWD0AYmfeIKZ
                    L+uHB9emD8Glww1l/wiDG87hzSnxI0k8edhdIOgTSbSMbSbshySsEAc6BDIfraznjPBxP5csZnr4
                    c4f89lExZJihDlKgxfsSqlAZwcNm4wtMOSioEkKAqHZ+08fa1gGJNmzBC9XaYEeJpA5lZuSYa8EH
                    SFsCiJyFLm34cJc9QNEGL8wgFv4QUgdnSiRukDQydwFYT4DRPXVqLhhvwMIR+iCnfvBDHh5kKo2I
                    IUe7ROMnqlggRaHoi0OUgQpyAIc/zgZWsRbJFcasSzxsqhJK/LN2+khONqSgBjio4RqtwUc9gmpX
                    IuHDEjx5lleU5hJESFR+/BCSPkyBBjCMoRTvk1Jji3REnrCFrD4J1/8C+yG4ZTDhD0owAzD7UQ83
                    jrapT7WIWtjxK5bo4o348MMWuoAFhNVDHsB8JDpvG6EEtQSnUaGjSzix3ND9Ig1vUEIt7/EOeOgn
                    H2Fl7ozuaVqvOMMnhGhUEOEhiTEw4RCu4cc99GM28RLJHXy9SFfmQS+XMKOQwmBDF5wQsh/WQ4Gs
                    tG+RUNeXqoDTJaiQH2O1eY9EWEEKnJgrPdQpuCcqmEhSZQlVwuETRoi2dtNcZWugQQYkRKHDtp3f
                    h2Vkj53eVCr8KGdPqDHRffxSSqjgAhFA0RqwAZM53Zzxg8rXEnESRRg+Sav8fomPyflDHXHAQiOO
                    jA95JDmMSh5RohzzihR69JcliDhx7X45V3/UwxRP4MM6oMjGXC3HqwIMM4ToIT6MSLYmeO0JNE54
                    QdckQw1tQAYHyThXjhY5c1/WM3m8ReaiqCO3FvFEEF8Hj0Zk4RX+uEc+UnzDr8lY0vzhZ0hv4g9R
                    9EQQ6gii2UA3jSuwwRxQzMfZLhhpVIvIhS7R50m84ZPfBvEeqjwHH8jgU9dIUznvSIYuXrELYhxj
                    F7/oRjzmMUDv4iM5rHVXPvDRa+Y6V8Q28Yd0dxfj7ulHH5QIgiOqwQtdEGMbrrmhrt3RCSYc4Qtd
                    kEMlPGGIQICiFbzgxjkEd4/5+gMfDh+kr3Mc/2ybWMMn0nijfp5xhSTMgQ+MwAMYPLENcoiWF0YA
                    AAACAIEIKGAETMjRKEqxilZkI1f5kId+POxrf1y80jLxB2R5gomqqs8diPBCFr5ABzp84QlMGAQk
                    OpGcc9SBC43IBCDkcIg0gIAALICCGjahCkp44hWvuMYFn+kufPw1zJ6o+Ex+zhMxKe97sMiCGUpg
                    hDLg4AdN2EALxLAETEhjFJ1QhStMAQtkLAMa0YgECzxggykA4hKTyAQpPgEMTo27Nfaws6TNUd6Y
                    CL0nEb475ty1ijUYoQIx0AERfpADEMRgBzmIQxWucApAqOEUu7iEHvBACFfQ4gwQOAEQ4PCHRf9o
                    whTB+EUmXZNnVAeaJcIGCZN5Wi3VY641tMCBBZyQhBV8IQo8qAIPTqAEMcDABYjYhSpMUYo2KGEH
                    RCiELphhCBk4IAiEYAeGoAnDUAu2UA0epA9H1nPskFumR1ks4Qry0w9mY2QEBAJFQAh5wAZ0gAZ3
                    UAdJsARtkAd0MAidUAmJAAmXgAmB0AJhMApWoAa9AAtVsABn0AeFcAiVYAqWAArB8A5QRG7UV26j
                    VUzYdxLk0BOAoF6A1WH2MB7T4AZsEAmawAiWoAqgcAqv4AmIEAmPkAd88AiA8AZ8IAmL0AdbsAWg
                    kAdKgAETQAupwAEVAAZxgAdYkAeOQAmR8Fv/9iA4+TAe+kAP7WZf8NBbGGES/vBgEbhACrgP9qBA
                    1/AESAAHgnAIfDAIkdAIktAJqIALt2ALv8AKnZAHa8AGYSAFTGBrRaAARmAHFzAAS+ACAOAARuAG
                    WiAGeeAHi6AIyQBJ4cZhklY6R0gS74BpS3hC9uAO4xEPgkAEXBAGY/AGbdAGe1AIhSAIfaAIgYAJ
                    toAJpXALtxAINiABD6ACRVADHBACY4AGFWABIBAAAOABVBAIZ/AFb9AJlKAHqdAo/KBSFEiEdlWI
                    z1USsNQSEnhC8yAl2MAERUAEO0AFVvAEUcAFarB1bFAHYoAHgbAHj8AJpyALtAAJVnACOTAE/w2g
                    AB5gBWfAASpHAABAAW0QBlVQB5SQCWrQB7bwDOPhVUUmaUa4EiSBD/l1EbF2Ql4FOvWQBh6QAj3A
                    BDxAAzswAyKwAkfABU/gBHHQBWPQBmTwBXOQCbpgDbRQBjawABhwA0oQBScQAAKAACo3A16ABnMg
                    B3HACCFnCojFRvRVXaPlDk8FXQ/BIjyRekEkD6rkD56gBF8wjV1QBnAQBkTwARKgAlEgBTgwA1KQ
                    BEjwBFQQBWGwCKFgCW1wAyvgAisgAxvwAAMAAC4JAEmQB2awBmVQCGdABrWwCjlTOQBpVyGmEiLh
                    D+XSEnYXRPWQK5XABWkgB3ZwB4sQCYngCP97wAMMgARnIAMp8AI9MARLgARGUAQ9gARtYAhf4AIX
                    cAEx0AADcAACMADwKAJbcAZucAdpwAScYA2QQAokNIgfhg4u8WcOQWw8oQlZRDnPRg5qMARt4Ady
                    YAZpoAZ1MAiPgAhBEAN6wAdl8AIugAM8EAQ+EAREsAVXkAVoEAOs2ZoN4JYF8AAIYANrEAZlMAVm
                    gAif0AlxtUoQt5t2hU/o5hFmtGNZVGXO5HNNYAV0QAQ4oANCMAV6cAiFQAl28ANw4Afa+AU9MANO
                    0AQbOgVIAAVgYAQHoHJgOgAFEAAIoAArQAQ0AARO8AY44AXBQAaL0Br0YA98eVvbpxLZpxD/+GCI
                    GMEI+hk68nVk6eAENaAFCwAAKRAESOAEYvAGePAGXwAIcBClgZAGWNAES/ADO7ADQUAGPXAEY1AG
                    Y2ADWbACYKpyEqABFAAEYNBxQhAJmJAFv2BlE6djKwGYCqEMPeELheR2beQPjaADV3ABFXADV9AG
                    ZlAGSyAERtAFiJAHckAHcNCiO6AEVZAEU/AEN1ACGeYP7FAN/kANghAHMAAAH6AGHMABdPADGRAG
                    czAImXAGg7BGvgZlLcGjEKgSgHAsb6QP3EYLY0AGVgAFRDAGgrCRc/AGZsAGfnAHcwAHbfAGalAC
                    MTAFPiAFWEAD3coc4NAHEngGA8ADCAAB/z1ABnPwBXkgCunQc3LKpy/REe7QE6agSfoAP60xCu7q
                    CH5ABnigB3fgB5VQCYBgB3IgB3OABmSwBm2QjlrABFOQApTAHPYQD/9EDR0AABFwAzsABGPQBVGw
                    BMfgZo6mZL2ZER1xbixhDYXkiJBUC3yACaEACYRQB3HABnxwCGxwBVEQB3dAB2vQBXHZBh4gAVvA
                    BVnwAJ/ARmajUoU2bu3UGogAADYQqmhABUTAAwDQCQO0gJI2S/cKEf7gRS2hCHXKNn8ITPAABigg
                    BEdgA2QQCHKgB3sQBljaBI0gCGSwBVggBWBwBh4wAFQABlKAAhFmD4dzD/TgdlwWD0LCDv86AAA3
                    oANP4AMsIANCcAvBxLJ9ZhH+eRD8yRN2pEnuAgwk8JIrEKN5EAdnwANGAAUD+AZhcAVUIAVdoASH
                    6gV4oANKkHEX9IdYpDn3sC/i8AIA4AI1kAJGkAJmsLJ/OmNoa7YP8cAqgWuF9Ei65g/nAAVNQAiE
                    gAd4sAdwEAdk8IyaYAhm0AVhAAZQcAU7oHJmQAg3AAbdoJcUyBxnk0D+UAxWoAEq1wAGAAYxgqO3
                    xQ5AtxChyxNR60r6EA/jYQtJAAeoIApz0AV2MAiGgAhp4AaREAdqQAVkoAZJoAQzoHJn0AhTQATu
                    o1jlkWD+sA6b0Ad9gAd2UAvZy7Lq1mD/DaEOUzVM+SAlljABEiAFeGAGWoAGcFAHdPAEeXAIZpC7
                    WXAFTPADIeCSUvAJdrAAkgB6G9YcT/SrQDRqQnxbgrmjC2GvLnFZmvSHrSEJLLACPhAFacAHkHoG
                    W6ADkDAIY5AFZBAFPwAFNdABFgAAI/AImnABb9AaS8y5zuYOqsIPbmdCofdDdiwPRYwQiMkT2eRK
                    moMKdKgFVzAIi3AHf4AHQKADoaAIZIAFYFAFQXAEIjACFpAAAPAEvGAHNsALiTW2+1APfiMPMdKH
                    9PBM/2jH/pCvUKWnLmsRvDpMUiMKLXADXLAGgPCwg0AFDGACiiAJdpAGWvAEVgAEDIAB/xXAAABQ
                    AXkACkQwB36DN81xRQ8HOl6laxhUXwSNWqSMEHe6EhSsSf2ggG4WCCkwBotAB12QBWNABC5ZAErw
                    nIRwBktABjwQAAqQAa35AFzwB1xQS9p0ZHmWN8C0z4NEW2MraUT8uQnhD8K4OwqlQPIwBkUgCH7g
                    Bk7AAzcQAgJwqAKwA2KQxVRAAxcQABfAAQlgAD3gBDQgBVxABc4QTPMATJ7MQNRH0K4huniqEP5g
                    qyyhUd7UD5vsCSqwAimAAQ7gAGLaAB2wAPA4sihQAgAgAC/pBHNwCosABoUQCBhVBKl3wRQocZLN
                    H3G0Et1b1i4BKN50QeNBD3uwAA2AAv8i0AMv0AAZgAEPAI9gSgAOoHJVAAuwwAhNsANLAARWUAYl
                    CYR0WjnK3NvlAQ7VTBC66hKC8HZZVMP7sA6g0wze8Hn9MAxN0AAFMAEGwJ4BAI8KQAbMYAo8sAFL
                    QAhvMAU3gAE0IAQ8BkXycEE0jd7moQ/5ddaK5BJE5k3ObA8+Bt/LIAU7MAIaYAEKQN0ooAnLkAku
                    QAKFYAutcAzg8AuVsAUmgAS5UGTjhlAWvh/awhJO9g/+gEQuQQz1pB/zAIRJJYRJhQkQAABpQAQZ
                    QAEqJwA8oAjd8AslYAOWYAmU0AqoYAvCQA3FAAtn8AODAIT1sM8N/OOuMcoqgVMxyxP/J8XQbFY2
                    91Ax45AFKlcBZ3AD8qxyRpAKxYAMSWADnlAHi9AJl+AJlMAJ9vYLuHAKSvAEclVncG4e33vTAwEN
                    PGEIpds9B5ZURRMLMyAAAWABI7ABBFAAMPAEbiAIm3AMUwAAedAIg6AJlJAImDAJjEAJtkAMoIAL
                    34AFPaAMRaY5fRPKkvY2EFwQ/vCTKyEKTIVBWAQLQLABLPACBsCaHZAGlZAHhiAInNAH0GsJdoAI
                    fJAIk2AIdskIknAKrtAIvxAOXZACofDSPLnPNrvprhHkK7Ekd+wS+FxPTlQPkNQKScADPJACrd4B
                    VLDrhkAGVfAIvjDGR4AHhQAHhRAJbYKgCIzQCHkoCrFgConQDPcQBgzQS384NjgM8K5xSEJuEPyA
                    acTt4W4mJdewBUBwBEagAyQgBGhgBnow1GqgBq/wCQBQAEggBn9ACIkgCHuQCIpw9cR8CqdQCJsw
                    DuUgBCcQI/qBD6pCSDLvD+r/bdYDQXo8IXquhEE+3g+OIARawAVIUAM3wKVisAc7sQes0AtPsHJJ
                    4AZ2sAhzoAeFAAjWSAiH8Ah6SAmFkAncsAwocMzqJHG8LfN7qvYC0d4tkcRJ/tWRdAZK4AVXMAQ7
                    MAVXsAV5oAiREAh0kAuPoHIKMPh5cAdkcIl20Ad+wAd7EAiFMAiNsAiQ8AjVkAodoGn6ICcuffat
                    0VC+SRDTzhOs0FFjQ4HK4AVVwAZMAARfwAZucAiHEPKBAAinAAcXAAAXEARVYFiF1QbK2bdxMAd5
                    MAh84Ae+TgrgMAYbICYAYa/fPnz9/B1EmFDhQoYNHT6EGFHiRIoKZf3BmDHj/61/Hf/546RRJEZj
                    FU2eRJnSH799By01EQNnjJM1f/IcMnSo0R9Jf/SoinCAyJUkVtZ0AeNGjpw2aNDAyYPmTZ1DlHZp
                    K3GDnz99/fptVRlW7FiyDpGNzJjK40dDaDVyKxtXrkN++QzOo4NEDhkzZtwI2kNnD6BBfzzVafIH
                    QgEkWZI0ueIFzRk0atRMRiNnjRs3bBxlAkcKgJiD+vx9tTtXtUKvDPvpA9tyNURwbv8wWkvPdkZ6
                    s32T3Se7mpgtdsqEodMn0CA/ewLlQeRqjwMADTzAMPJFzBQqXLJo6ULGaZkyadCMOWNHEat7fQDE
                    scd1pel++PKB/X2Q3z37sP8NIgzuP9b2wS8hfOzBZx998MmvIXt2W6u23RRpsMKU7vEHFingYOMN
                    O/LwIxBBAikEEj4UecULAACwoIQYwChDEEHQ8CIMvs4oYwwwsujiiymW8AIRTJSxpgUA5IDnNIP4
                    mQceBhtcsj9+/vvqq+D0SQ0hrwRMiMD97uHSwoMYsW0tZXb7gxMx15Ron6/8cAKP9PrA4w489vAD
                    kED8iMQTIQA4IAEARthiizkIKWTEQgjpY4420hAvjS6gsMINQhpRZhkRAFAjn5XqyUdBfmD7zSt+
                    CmRJH9kOsrK1MBcyqB4M2UwIlDI90gVNWmjllSFPpaFiizfSwPOOOeSoYw//PvD445JJYiiAgwdW
                    jOAFHYSoiQ9EHFFkkBHnqKMPm9aoAoxFFoGGlycAeQWdlQS8Z9W5tjy1QFZPy6ceep7UB7YpH8pH
                    oF4RsuXWj1BBs6SBB+7XH1V2WKOMNv4ARI87PgzREEAwqaQEAjDQAAcUVoSghB6gwCKNO/Ko444+
                    +tDDj0Uy2USSQOYYpBRjwoGGkTRQaYklJVXb8qtR7T0oH3rszeceVV9lSJpSvOn1LLfU+ggTNLFZ
                    mGFPQZHBjTLe2EMPPM7eQ7lFDMFkEQ0S0GABGKbwAAACLIAABB6eEIMM9OLwgw89CNEElmGCMcSQ
                    XGophQ5AWkjgE9NWugfp/7FcZUifedxZZ5xv0pHnvpPiCSUNADDplRvbsPanrd3c7ZpXAv0RRYY0
                    2IAjDjfikIMOO84OhBFM7ICggxAAEGCGJCowgAAAFCghCC3COGMOPupg1hBGJuEElV1IGaQODVAw
                    hQkAHHijm3srjMcYYm5BJZNF+qCklEgQYSQUXJCJ57SIxvnDFGpAAFn0Sh0Q+oc+0PSHycWuV5qY
                    QRriwCGlYC8Pd7jDIPJnOg+EIAIGwAEWltAA5FVHBlDYQhjWMIc5/E4PdaBDIiRRClmc4QMu6AQ8
                    srCiASxBGAfBRwP7BTWF8MMe9tjKqPCxxMnVoxzUCMYtNkEHOrSBDFv4Uf93pvAEKFQBKV1oQySC
                    gQ4sDaQfsvKHPGqxBynQ4AnFGBg/EMgONCHCgQs7RA3YEIc4tAEOdMjDHvaQhzwIwhCV2AIALlAE
                    HEyACDOgAKAMsKILDMELW9ACGcDQBj3QAQ6DwMQjALEGEbCgE71oRiw6gLwAhMAQ6zhIPeahD3rk
                    40lFDCIQ4eGplYClH/IQxzR0oYlBzCENYwhDGL7QhS1kAQtUmIIVrnAFKkThCUyAghOo8IZLoCIa
                    CQkHJtpAhAqAwRxdU8StvIEmS9yRVltBRxt6AIc5xOENbwAkH/ggyEFEAhNPAEAEqoAEDJwAAwAw
                    gALsFoAAiIAIS4ACGc7/sAQ10KEQl9iDHZ7AgAfQIRSRQEU4SDEtHgYBGAeBRzvsEY8GFhGN/pvd
                    Qd5RjFLIrw5foAIVrqAFnm6hC17wwhe80AWiFrVHX8hCFaRAhSp44RDB8Ecz8tAGJwDADQiRx8A0
                    cStooEkU7uRVM7LQBCq+oQ34zIO4/uCHP2QiEzAQAAm40AQOrOgAeBMAAQawogWoYAldEIMWrDCI
                    QuQBEFzQAADGkAkPeWIV7NBEAVa0IgQQojROik9DWqMlfJTDGK7QBCQI4YUsYFILXPgCF6yAhdJ6
                    AQxhAMMXZDvbL5DhOFqoghbM4AQhFAELf8CEFUrwiYPYI14DI8WtjIEm/1eAlVa1aGod5MCGDtVB
                    D38IhIgIAYpFACABQghDE1aQ1xK8IAYbmOyKFACDJTDBClO4AyIOEQcTXOAHe5CEHOKQCEyoAhyn
                    YAAAHiAoADBCP5stYoGcSA1hoOIQbfACT6uABS+IQQxg2AIXxiCGZHbYwh8Ww4apoIUvaGEL5ZmC
                    FLQgBCkcwg6qAOJW6jEwWNyKF2jihXPXdA9KYOEMcIDDGtYwFecgilGcyAMAGOAEMzDhAwAQwReQ
                    QAIETBYBk1TACmgQgynUgRFsqAAAUnAGPcgBZnqYhCVaIQ5aWMCuKwrDOfzBy4XcI7P8OMcybAEK
                    RcThwmHAwhQsvEykiP/BDObpCxk4zBfyNNoMYrhCF2AohRyMgQxVKAMWgBCGbCSNQS1lky/K5A9X
                    oAkZOhZTN+gwhTFIhQ1oYAMd9CAIRCRCEH0QxRpWxIM3lEEGAaABbz0gAGIDAAFVBkABUJBMOlih
                    AQjYgBC80AY/k8EPkKAEJmBxD1i4GQABWFEdIrKPbfDiFVv9ghSkcIUwmCEMXMARM7sQhjSowbZj
                    GAN5yCBRNKTB3/uGQx8i9gYnnAAOaYBCj3bAg2UoCR9C69WZruYPVqDJGaj2zVcQIgsohOENaKCD
                    HOaAhzwEghB/MIQiQJEKJYAbBG5QwxRGcIEAMMACIQiBBJA92R7Y4Qv/MZCAAlAwhCZA4QtmyIIT
                    3GCJSgxCze4oxhME8G3vmkI/p0rIPbxhi0WQSA5EKIIVprfh2HIYDK8VQxnc/YVWm0GibWADjvDd
                    xzb04Q0ziMEbVnCELyRh3j3YwjnnvJV5DMwZq/OHJ9AEF4zLReP7Mcg76ICDOgyCDTC0wx/4wAhH
                    9EERkwCFIT4wyQZ4QRFy4AHyKpCCIcDgAguYbAAWEAMc0KDKGMgACWqwgydogalj8MMhENGJTJii
                    HPJIhGQFtQKDVG4fx72HLhQhiEFQ9QlSEPsWaoSe8+TbDGcAfxrOAAa/nCcNdWCD35CJB0LU4QRZ
                    4EIF3LADDqjhp2Ug/0IcZuXAdU5c8buhmsaLC3rIKn/Ah6wShidgtTfAkTW4POdoBEcQPk4AhLpi
                    gAAoAVEAhST4thOogRDYK70CNwFYAAmwgA2YgAMwgAR4gAoogR/AArXjgr84BEe4BFEIBV6QB0qY
                    LAiABpg6CHSABU1ohDTggiuwAjAYA+9ALRv5PuoSP0WLrTJYgzMQgzQYljWwLTbAAz/ggjYQhAg4
                    AkMAARhQgypwAzEIjx+gEHfqP7RIBX9wBDSBHQEkC+MaFdkwhCBQA8lwtzXYg0IYhDsIhESIr1Mo
                    gwM4nwxQgCmwBCiwAAuIgL1SAAhogASYOsrKgAtwgAEIAAEogAxAgf8ekAIs5IIyICw5SIRU+Lxf
                    sIcymKwwUAh1eAVI+AMyuD4wOAMz4AKf+gIwSLvv6zfwMwPysBE4QIMvqKjKEL/0aAQoYAE/uAEU
                    uAMgwAE6+AI56MMr6AFYAKsDmrg53A13sEO5IIiDGAYg6AKZUIMyqKhkSZxGUAQ86IRIAAHv6gAV
                    YIANGIMsQAIpgIIi8IEjCIIPmDoBMAADeAAVAAFBGQADGIAQoAEfGIIo8ILV6oNG8JBISIRBOARV
                    iAdYBAAbmIaDWAdgEAVHAAMn+JErOIM0UMMvCIMQsy3wSyaJSoPNWAMzUAPz2Aw2uJ2QSy0sQACY
                    KQAfALI36IIzWAP/MOABJQjAO3KH3ZBDNCHHciSLgUCIR4ABPOALNNACN7ADfHqET/gERcC1OeCh
                    DdiBFQABnWIBD1CeI0ABC3gAAmCoARiAA8AADKgABAgA52kAFgiCHwgCJVgCKYgDQPgDOjiDPxiE
                    QHCEX8gHOAAACYgFf4gGSugDOdACKNAC0uIRn3oDNQjGvgA/8HMKf7sdNaC3ObC3N2ADNXCDQBCD
                    ElgDDZiCRxiBHjgbmWC1L1iBOHCuqbQNf2DM3cgsrFSJ/YgpeHADJrADMVCDL7gCD7kDPTikSXiE
                    TciEH0ivK9gDF6CCLKCBCFiRB9gAEBCBt+GhFWGAEPC2qcOAHDCC/yNAAiaYHi+wEzHITu2MBGcI
                    BxsIAEuohlHYAzFwgigAxmQCLAxbgzagDKfADDgwKzU4A006AzYYgxViAzMAMji4gjLggxYggyMY
                    ADIohDYwgzcYBDwogie4gh9oLrDCB6pcIOYUCyP6ivgwhohigz6wA3aTAz44hEIohEQwhExgBTfY
                    qwL4RAmwAjmoAip4ARygAimwAR0AAhWggIMsgARAgAywAAUgAAKosgDIABroAR9oLyZwxzBwg2OZ
                    AzqIhEowhkvoglGohD8YAxLDAitAiiuQgorqAi2AtTWwDPE7NPOAtcvYxTYQGzWoAzgIgz4wgx0Q
                    hCMoAS8AgjUQBP840AMygII7KAIhOILA0zEcRRMdDYvW0AcMmQUjAKqMMgOSuzZOgARFWIRP6IQT
                    sJsEMAASygBIgASC4oBRDIIdkIEQmICgSDYFmAAPaAABGABQXJEAmAATgAEeuIEcSIM24BExOBY9
                    OIQ6SIRa6IVOwEUqIA+h4otCWQOZCAM1WAM0KMZDUwMzQIN5JYM2GEs7qAMwyqg7+AEyuAMPeAMz
                    KAE2aAREkChCuAIVsIMgYIAp2AR/eD7L6RVWpUpXfVXZYAUmyIIwcBQ28IOUXQRMSDlFKJ2DtNYB
                    EDo5GAUegIAK2AAXAAEG6ICGJDY0HQAJoAAzzVaqA5QNoL0aUAL/3MoCf1MKPJAEUNCERGADQYUt
                    G2m1NDADIVM76kID9XPHR1EDO4ADRKWDOAgDNnADQ2CDH6gDJ1iCQYgAFVAEPoADl2EDJ8CdIcgC
                    KuAAOxgHf6CH/nEnjz1OkFUJjfOH8uECM+iDODgDQEAEQ5iEQyCES9gERKirvLpWu4EBKzCCFbiA
                    aONGC1iAAngAFECBCVCABtAACiAAARjBAjiAvbKbD4iBG3iBovABciWDOvgEYFAFO7CCJARGDrO0
                    MpjQCcVXYXSKM1ADOCiD5sVXOwCsOegDNrgAKtiDGJCDJqiBP+gDWGsDPOBbQZCBEhiELriDrcCH
                    yinc48xRxE0J/8XthN7zAjyogzlIhP7NhEOIBFZwhSZYEb3KRANgAS6ggg+QAAxAgRhogqSagibg
                    gQ0YgAKYgA2AAAJIAEERAASA0skSAA5QARPgASQ4rS7Ig0xwBVCogyuYghSaSXzTN3c8g1a7V0vr
                    VzbYyTJARixwA+llA33qAytYgkQggReQAxGwAkXYA7W1gzG4Aj4YAhPAAyaIAjh4Ahg7iOCIX7fw
                    h/ml35PQuH2ABCfYtzdwGULIg4vaBFKYBTsgIQa41kwUujR4BB5QKA1IAR7QAi0MAmlRKASwAAl4
                    AAyA3WSTXVCULACAABdgARpYrThoBVkwhCx4AvIDRnyzrUQ7tP8ywEkrHIPbcYMqDIMORYM7cIMw
                    2IM/CAM/IIMNoIMnmIAq+NezuYP9RYMssIMfaIC73dQvKA0iGhjDBeMxJmPTmIdCgILj2C9O2ARD
                    iNpWIAZGyAAeCsxMfIAaEINJ8IKDIgEbQIEZmAETeIEUkAAVDNoM2IAQyADJQki8DIACkIAFcNYD
                    2AAamINbCIZI2AIgiZja6mTKMA9FOzS3QwPyqDfLcAoyCIOxhCE38AMkEII/uAAgUIQYuAJLCAQ/
                    +gMn0II/YAKhCoI3WAMuIALiWolVPc7ktI1bQuaI2BLTcIc9mIJDzQNF0IRT6ARPgIVXcIUdsCtw
                    i11wswAj4AL/PSgCBFAAF6gBExCBDtCADsCADdAABDgADzABEOgACMjWA2hkAZiAFqAAKEgBACiD
                    VvAFR7BCewUDL3A0gr4dpCuDOLii2yFGyjgDP/oCmCNEK1AtFFgEGZgARhCEihK4K9CDvv0DHLCB
                    OfCDNriDIHgCdliJeJgxd1Kg4xRH27jKmJbpKTENeMgDJ1ADl+mCI2gDRogEVziFPwGAvQS3a90r
                    D5iCK4iDHrAbEfABJciBce6BF0ABEmAACWiBGRgBCXCe9EKevXoBCagCXGCDTYiFPmgqOniDMAiP
                    5iXonowDM4ioPBiDQpWDNCgDDiuPy2AhPyjZKcgBPhABKGAC/xcgGznAkTfIAjVoAw6QgjGwAhga
                    FhyYBP+hB3vYBzrrGuME4852i88G7YdQXH+ohSXggjj4A0TQgefhgBogAytQxHmWrABoXWpBAjFg
                    gxq4TBpIAi2QAiDwgR+ogeF+4BnwgHQeAAYgWkemDgDgAArwgGaYhlAYBJ/aWjPwPlDeN/Jwu7NS
                    u30FUZmkHjcwAztggy+4g7TJgR5gAxogBB0wAULK7jTQAzHoVyEQgxZQ7JDT7xxQg2EuDXlZGAVH
                    i6rcDXV48InwlHpYgyGoTjioBCJILwSwXeRZZAWggINygCVYhDswgYDagSG4gi1wgiTwgRzYASFY
                    giI4gQ/uxP9JEoAOqIFyxgDJKoE/+IVV4AO/wVC1I8bzxjdOvsI3cAPzxkI3wBE3MKs4sIMz4IM2
                    eII5kIIa4IMYKAI8AIM7CLKPe4MvwIIuqIDEwIM5QEZQLoJQ6KVTIWZeoSP/Q5OovHOH+I9MWAI9
                    QNs5AAUzyMSgQ54C2KuYXYAKIAHZA4NU8IMwO4AawAEfmIIoiIJmB10bAIEqKwAHmLoDgAGSbYIk
                    +IEBSABAcIZPkImjM4/U7Asj3zfbIg/odUDq8m40sCey4YMxkAM8mIHydQAmCAMqQIQ7MHIqQMaz
                    GoIpmAI44IN73d83iIIzoIbTwHYEi503HIk4/D/bYLxvb4j//fAHaGCBKTiEP5B1S+CCyfqAChCA
                    Azg2vFwRB5gAEhoBSzAEFlgRAyCBGJiBIiCCHOCBIugBEfhw202ADWAvHLgBKsCCHtDUXziF2EoD
                    GKFQine7JFe7iqdNs6J1mAvSswIDHRgEG7CBRUgBIpCEPJB1OxCEJpCCOXgDLbgBLWArfx2DN+AC
                    IRiFA/N5/kM8VbA4o3cI00gHMgiCMYgDOmmDR/iTCPCABGCoTyyAApBdu1GoFJ0F8ASABdDLJGYB
                    FegAB+D9bzsAsAaUEhCCCr4AHmCCGQgCReAFUPCzIBMqnnze1MT4wM/XcCX8f5WDYcmDL9AB9XeD
                    JKAAPfkdMXeUgzDQgy84gjPgAi+Q9TZoCjgACDBgtDABM85fv4T9/DFs6PAhxIgSJ06E9uciRoz/
                    qfy5yujxIjKKIkeSLGlSZColZuq4yRMHDSAtGzJAAGDzJoAABgLcbLBmjQEACwgAEIAhwwMHCHja
                    ZHrAwo4fOD4AiHBkBgo8rC7NGSMHzhk0YsqoSYPm7JkzZdaaaZv2TJqfa9CYiUPmzJizJsgcofGm
                    yBk+ftqMyYIGCpg0PJZwmUMojp03T7qsKQPFSix/+xCe7Oz5IbOPGv/xEp3R1+fUqlc3xHcoCJMw
                    bs6Y8bLmjpcMAAwMAHDgQYUFAQQQFQAgQQsQTXNCmAChAIAGGCYYt4kAiJQrNSzwrFCCRRpWpPCQ
                    dVNGDJs1acqaRUumTFszZ9XMjQ8XT5opYr7U/+HxxAcJf/jhxhhq5NGGEWxoUQQaQYBRiBpx9PEH
                    HWyoYQcXR4yRjz/8LMQaiBP5Ytof//xDDIkXuRIiixR9yNCH/fDjkIwv0mhJEFFgwQUXYshxxyF/
                    7MBBCRh4kAMWL9lwgFAOGEAUAUQdcIAACVS1AAMpsFABkwCw4EUkagyxgXEciIDAFbJscscZYbB0
                    BhhluKFeGu2d1dZaaZWRhoV4kdWGHYAgQQYXYUxhQxdj3CHHH3lkEQYeWaQhhAhwGBKHHG28gQcb
                    ZOABR15QbNRPPS2a2hAsJJroTIp/iHJqiB4+tM9C/Nxzj4z44ENrQvnQs5mNDN2DTjjNlNIHGP9c
                    mNFGGET4QIMNPzjoRSZf2FSCcsMFMEABCOw2wAAmmABDEBo40AYWPNARySNGcMABAiLsQIAJqKzy
                    hhlkjPEGG3GpQQYaFpqlFhpvtDnGGWRksUUacbRxBhx64OGDGmJYkYQMYYCRRx59EOZGGlwcEsUL
                    WsS5Bx9nqDFHGmGooYYZWlixCD3+1BMsrKyZouo/3rSKSc4syriPPjPmU08+ROuaj4c4O5SPOuFQ
                    A8wpgXhBgwlIXPEDCydkUAMNLWCRwx1MDLCABAzk1BsC3vIUgAYajGACBgtgoQkdbmQxxhpWUFAB
                    BjJ8UEEkshyyRoFvmCeGymWgsUZZdzb8rxn/aZjBxRggn8EGHnvUgQQVeahghBhw1BHHHHewsR8b
                    VdTBBA5z4GEGHJ++cZ4ZZXzhxRNRFKNZ0KZqwjM7rSoSvGoJ7ZMPPvfYk7Q9m/kDfakR6TMONcmw
                    ckgXRrgQggccbGAlDFcYkQMKFqxgwgpVqAGICwUYIP9NARBwwFI3GSAAAgwwIYspbvACMKAhBz1Y
                    gQNOIIMHWIEWiCiYG9yQqTF0gQyQY0+dzBIhN7zMQvCpExzmwAY26IEMLMjCC7JAiDzsaQ5goEJZ
                    3KACHSTCD2lww2DIwAY37NAMBCwDFjghLKchzzOM4Bk+WvUHfRRRJAp5oj6iSCuG7ONXE7lH/zqu
                    sQxWYKIRbvCBBQ6wgAEcIAM8SIMjalEIEHTABR/gAAvKEIYvWCIW7oDFAmzCLZ0wqQANSIC3iqIB
                    EiyhDI/IBB5G4KVADCINKyiAC07whVP4IQxlaMMcyGAGNZSBb3Bow1nqRB81sEEOcVCcG9qwBh6a
                    4Q12YAMa8hAGDCBhEHVoGAXB8AUwoEsKU6iCHOzgBz2wDA7/moMaKFOHLLDBHQjBhz2auBp+pMhE
                    /jBEq9AhzYk8sZsTWd4+5oGOa/giFIh4QxR4oIGbIOADNjCDKXDhDHV8KB7NOAYjZEAFUjDjGtFk
                    SCPelpMGUGACBlAABAKAgAPkwAxF+MIdtP+whCpgAQgAIMAaNlcFoXyBFaLgAhjg8AYxXGELcGHD
                    HERIGzTEhQ1tiCAcvtIGTdlBDnehQx1mWgclQAEQY9DCSryQhYoRBAmF6AMnHXahP6RBDGvAQhgk
                    cwVWMMQe/bgHh7bpGXVU8x/+sESrtKFViMiIH2Y9q/RohI98sCMby4CFIsTgBB04ACcY4AEV6CAL
                    d9RjHWR9UT2qp5lmrOILJiCKTRhwgQIogAQVAEBvMiCZAsCACVLIgyFIoQtHiIIXhIDEJ+QABlA8
                    4lGPcwMWruAy+sABDmmAj8pcKtIbyuENPzklG1D3hvW0dixacN9ET0eFxdBBDXoIoRx+gsn/NliQ
                    DWVYAxd4AAoYbQYf8hhrZ7hBolRYExWtCgl2EZIQWU3EHd9gxio8IYgyAAEEEUCAARyAgRg0gQ2B
                    GAZFljejfuxjRg0BxyawEIGmWEkAFKAAkzIgBEXaJAaFaAIQECGKW5DDvNZohz7YIY94qAMcnygE
                    GqhQBzRYAQ0Jq4McfFg5MYQhLcuiAx1upwaRqqW2b+hDHc6whkyhQQ0EmkIcmnADPpAhB11ogx/m
                    kLAx0AEPIpSDG+DgBjRgSAmHgAdn+FGPfaQ1vCNRxnZN9A9ctMoW2LWHFR2CD3Wggx3mGAc6sFGL
                    TBSCCzDwlgMq4AEayMETp3gGE5+2kCk2/6Qf+qAVP4rGEHiYYgg4EUABtmWCFOSxKi/QwANQYAZX
                    VMMa8fCHPOCRjm5cgxnDEIYwjMELXoRWDWhwAx1CJh8qwwENY6gcbcJABtV14Q1v4CUy0RCHCHYq
                    DGtAcRraAIcjO0EJb2DCfr6ACKSmYQxymoN62EAHYaeBDHYIAhe0Katw+tfLJCGzacT8DzCnaLpj
                    vUeg/aEPbnSEgmKoAx6aAIMXSGA3KKjBFPbQCmqUAx8uWsjQYIQQetyjIcVIAwouUIEGFABcE1hA
                    BE5gAp4QoAhs2IMqnmEPfHSDGtmYBjOIkQtawEI8mFDFJfhwSnyppUC19kKcHLeeNeSWLv95WEMX
                    2PAGOKyBX2k43RvGAAaUbuEJaegDHHLwBDUswQ0/aAIfEgEHsrh02D9JQ1jC0AVhkwEKt4BR08x9
                    ElHwzEQ+S9HxwlsPaTjiC1GoQQgecBMCeIAHKiABEObgi3loxr816ibiZaRof9jjn/uoxieeSgUo
                    kGChBdgACTqgAbUNIAqegEY62iGOcngjGbAIBScuMYlGFIIPdTCmgcyABUuVUC17gqUuwyAGMYyB
                    DL7HKRu+QMKI9WEMbJA5z7c+B6g/IQlqMEQdjOAEPJygBmtoAx3kIMcdDzs9kSsDHfYGBx50gopm
                    TYjaTQKJtv+DHkr85zYpYYUSPAcABaj/wAlsEIQkdMEPxoBHNZQDRGgZPpSVQsBI4jVEPtzDjKiD
                    J+QLIgxCGGCBD5yABxDABVxACJRACSTBI5gDOCiDMOwCKERCIAjCIggCbaDOHeSBHvBBICCCo4wB
                    IiTCGmyBGfResq3B7rlFWNQJHajFXehYIETGF9BBHrSMbX1BGTjMc6UBIbCBCDxBEFSBIPyBHahB
                    XtCBHlSI95nFsqBBGCABFojbWaFf+o1EErGfPxBCq4DDWI0PCPSAFozFH6TCM5DDO0hEPbhDwzEe
                    rpwfjSQe80yRPdxCigHCMAlCH4hBD9gADjDAAAQAC/gADGACNgjDIjjCJ3jCJ1hCBC6C/yQ4QiRs
                    wiiowiqwwivYAi50Qh78gSGcgRVUkBiQwQ11ihn8xAi9FL+Aga59gRvYwRaEwR4IARn0gRZ0AYzV
                    YhxUiBj+wRpYBSIwQh24ROX8SB28wUxZiInlyx9swRFAg7whxPkRURo6hDiQCCOomz8MT4qA1zYt
                    wzewgzq8Az3Qg43sA7zxAzyogz9AE3/VQ6Ad4CB6Ez9kVTcwAhaowSE05BXaQRpQgQ64VwVkwA7g
                    wAhgAAqUwR4YHR8MwiNQgiRYgiiMQim8AiyYwiZ0AiWUAWYBQhtowRm4gcaIQRpoY77Ahxn8YAZF
                    iFcUghDMgCAMQRHsARp4QRiI1BwYE/9KLZvwFWEb/MGvLd0cMJecWIirJYxtMcEsyNtmnKE5niND
                    hIZpcJeY+QMttAosnONVMdFVbRk/0EO82cpXkldBHqA+IoQrkMEX/AEjMoIlXEIi3NIXDEEIuBEK
                    FIEN+IACAEAV/IEViEAAJEAEBAEe6IEV8MAOHEEUQAEQvMAKkMAIiIEh9EFt5OAXfIFNKk61hcEY
                    8N57WFAIDUIbPIH2lUAdWEEFfIEh5MEbAIIdzIGvsUFepEEeHIIfZKEYmMEXyMbtMKEqlQVtkIEc
                    IIEjMESijVfaieVEpKVp3IK6/QMytIoljFWMvIg+3AOw1MhmEA369QM+DORfPVFDTEP/JaTFHhDC
                    HgxCJTxCISxCIUBXEVikBbgAGkzBDzCABOjBIOhAIAHADPyBHvRABTzABpjACOhdTnTBIewBB8XF
                    GHhBF4RBGszWToZSBqUBH9xBsh3BFuxBptXBEsyBHXAhH9hWxOgBxAjGHGzSbBCdGzhZsonQy4Ad
                    XPTAH1DRPsjDjJQjd04EJrCfiZhDqwAC/DURGo7EfpVbovmXPZQKP/TX4b3IPszCHHQBHzRCIPxB
                    JWhCkPwBIODBSOkACuwACtyAGbCBDgDABsRBFaCQbwBACSxCI1SBD+iAEUBBFtQAUeRAIQgCWKSF
                    ibEFn3hfGYDB0F3IHhzXHizBEZCB/wuUgRPAgB0UAiDMQZTt4hvMAR1gCk69gYm1AW5pypy41kx2
                    wRnAqhIUAodIzxRl6ZNChD5cYbqFpz4AQqtwQ7CahPOIV67gQ7l5wyZAWR4kAoAuwidkwh7YASEg
                    Qh18wRGswBJYgRAowRkcwhhwgAu40CJMAQBQAACgwCMIQhhUgRd4QRuUQQlYwBQcUW1xEov13lr4
                    3iaBgRgMG1wk12WywRDUQB8oABIoQpTdgQ55zioR2yq1lhv4mjbORZ3w5F3YgRkk5RbQwTfYTAEu
                    K0mQQ1exY5SmCDCorJbu14dAU1oZAx+oQR0MQiIcQiI4AiSUZh+gYCLcQRkwgQIsgf8YCAET6AAg
                    QEECWNkbeIEJAIAFDEAIIILRvkFqkgEHEEANEELRxthr+Z7S6Z7vvQd8RAYa1AEfWMETxNgUnEAZ
                    yMAR2AGO4QHi1EGFRJDfbqxItcEIjVCKfiz2XUgcFAEdhIO8FU1Yyqw/oIhpbEJ4epUstAopQC5F
                    RJFXhim0MkQ82MIfwEEeOIIjEEIfFIIjyKAeKAIjAIIbcAEUFIGRXQERcEEZzMENCAAJBAIneAIX
                    AMAFoAAA4MAgdEoTlIERxOsc/EEh4IHD0MValIGk9tjL1AEXZIGTlYEijIEKiAEfdAEJDEEsykEf
                    UO8d8FwcuNRMtW8ECe5PvMxZzC//XQhuXUSBF4gjZ3iT5j6Ed31n5f4Dq6SIIfSvRNyKeCFNVflC
                    IuQBHyCCJXDC6wKCICDrpuYBG3DBFBTBCoQA7SgBEaDBJKxBEDzABPSBJAwCEhxAAnCABwDBG1zB
                    DfTAENQVCQACIxwCS8ASW8BFB7nUG6gBFniBHcABEKxBIpEoElgBGDgCHtjBHaDBFdSBGDRB0bUv
                    Fo8Q5NSJib1FWqSBwcZBEIQjWYWpPjzukyKClIpZ8bSKORgwRNRDNNUKQ0hDJGyK6z6CI/glI0BC
                    INCBH7Bo2RHBEiwBDXwAEwACGUzBG9DBHYRBD0iAFkTBFERBTWRADOzAIMyBCviA/3Lw6R1IwrBx
                    kFrIR8KwxXxwQR0cQhi0ARQMAR24QA+kQRTYwR8EaRdwAZHF7hDk6uAObvy2h4vFBzGzQRMcAS9E
                    RFmdMRz7QxsXa+X6gxqnCDE0s0NwrowwBC+AFCI0wiM8wibLwSFMAiLoQR1EBiw1AQ74wA+gAARA
                    gSKkgRfgASFEAiL8QACIQSb4ARMYwAFoQAfQQBWUQZ11CRVswiCowUzRxXu4Wi1Or4lFSPiyQR2k
                    wBVIwQtk3xtAWR94QRHUQRiUWG7x3C9/YTcOLHxMLxnEgRZIwTEwBD1klTVDxHiaxjoGsD/8L4m8
                    ykwrnD/UTDx0wRH4gSMsQiAAwv+2BgIlNMJS6gEPjoET0AAKzAALAIAHwAEgbIEW4EEhQIIbuAAA
                    0IAZcBALLEAGWAALVEEk2AET9AAAYMAhNAIa/KvlUO9Z8FydqK8e7EAT0IEWoMEHCEEiMAsb2EEc
                    RFUc6EAZvEEVbHTAsC/8DgxarIXl3AX1nkESTMHv9EP0uCcay6wqhFkA/4MxtIogGFxPh2mH+EMy
                    EAHWGYIg8O0d4MEfRGCrFhcYMMEL7IAMgIDewQByUgGHVsIigMEN2AQJ9EElEMEBXMAGlIAXDEIc
                    6AEUAIARRAIWoAGn5KrjLNu9qYEXuIEeeIEZDAIPDEEf+MAVcIEW6MFx5fUXcEH/HNAAEwSCFurc
                    xc7JpPbe41wf12IB75VBElTBLzDEPJQKl/X0NbshNAcwV7WKN6S2oUmPLmxBFcBBH9jB9cnOH+AB
                    B20seCdBETQBD3DAbiABIgACFYQBJHQCIQjCEsRrG6iBFhyBBDRACKRAE0BKFFiJGogWtqnMG7RY
                    G3wBXlDBGOyBIFBBDOyBGXjA0kpBFjahYYMB7SzBKcNYVUpZRt1F0XGSvtxaKknBin+BFgxBGrz0
                    9NwMP9hDvCl4Oq4xO+5xipjZTB8a0WgGLaDBFvy4GDbMHXS4a3mBFpQBGTiBE/hATQgFGSyCMJIB
                    IHwCKYSCDABAEUDqHSQBADyA/weIABGM1Ax4CR/cRh6wmDZ2AfVS7xWcwR2MnRxwwBUkQgTsQHHR
                    Th/I0kKzgQ2kASC4Fh/sASn1i1qozIyHKHoYUxdUAXqMQRKwwRtrRvQoeESUhk2PtjWlSopAQk8r
                    hH8NwxZMgSqBQRccXR5ArxxkkhWQgRW8QAdAQJdAQBzA5B7EwaqHwQg0gPB6QR7YgQ0kgNp4ABTw
                    QRSAgABsASUkwmPoThzc4HskzBboQSAcgRJoQgtggB88gRMUgjEBO26RQRTASYW0sh64wS4BjKaA
                    EgUZ+UuBMWUcqJUxUfNsmXhJu0OAFQBb+z9QgxJpk7TPiDg8wRHgC49ciB6k7/+xvQEWSMEMiMAE
                    2AQBiEDAAwIfVEImYMKEjkBvtMCE6MAAQEBNFAB28MAG1IAhLAKKXZKcoAETkkEY0IUThFAMxMER
                    KEAYEEIUf4Ec7IEU4P0TfEFd+AEdfAEaYJsPeQH10kdlZwEZvF4WPIF8q8ETGAEl+JW83QxCHNqu
                    0Lw7tKy14wOywizNG00ZEIEP7cgazMFXxEGtTQEOpIAINCYGnIAd+AMlCB8YVAIopHggPIFNnICP
                    oPqevvVF5wETaAElZJSTuRblwIXi28EIQEEmbIAHxIEVyMlzvYG5poEVrMEPkMEgTNnm6EEcLCfY
                    VUYYIGUujhAayG4UlAEb7ID/D1jCHyaaAjJRgkt7act5ePoDJ7QKQGjyN5BgQYMHESZUuDBhP3/8
                    6O0bmGjJlStUtqSBU+ZJlixGZJTIAADAkGQEB1F5M6VNojldlJwQACBAD0B53rgAQOABl1JvXrxJ
                    tKaOHjtw3oj54iaOHShJDu2IIQgHDEB96ojxUgeQjytubLRxQyYMGTJi5rRJMwcMmjRkyowpW4YM
                    mzRatIxJ08WHkVIDJeKjxy+fv336BjpkuJhxY8f+QP2RPHlyqn+XMWfGDIxy58nwHocWzZBfP33y
                    EPuDRoXHFCZS9FoZMsRGChY0IkBYVZBfGy564igq9ciKiAkMAAyQ4qXGDgcA/xgcKBHnCJNBeujs
                    NTNHzho2cLKM+UJDERkCUe6gISNHj542YvpoKRLGRxlBbK6cYUNmjZcyd7wQw4wvyDCDLrjY4AKM
                    M95IY4gyvAHsHoL0KcyffErjZ7QNOTyIHkA8m0yzETFDJ8TOgOlQRQ770dCfQVB4QgkkoOgCiymM
                    mOG2Dz6QZSB+8PHnmDDUaOMPRMiI4goxVCAJgCDkwOKHAwBIIIQgXMiBkDvi0MMNNNxoYw034KAj
                    iBroqO+LAZZQxC460ABkjSr8KOOGLu5QI401xFqDLrrGMGOMMQVcg4wuxDhjjTDC0AKIPtpZUdJJ
                    ETLmRMlIJNEfSC6VTCBKQf9VqJ8WHaLmiSSYYKKJLMw4wgYheNiBgBS68aeeeBzCRQsy4HADDCu+
                    QGMLDpx0gREwNtgAAAU+kOKNMtgLpJA21FCjjDnIOEIOOHIoYwgQ6nrDjTr+KMMKOfIQwoo7EFRj
                    jXfFNNAMectYAw0v1pjjCym+AKOONXLUY8JQCVbRk0s3yZREXTqVjJ2CIfZnVH407McTJpyA4gsv
                    loiCCS+kAEKnNAayBzFTnPAvii8wyeQJkgYAwAEnAiFjhxCq5KCIPQY5ww1C/gi0jTHccEOHMPhg
                    QYgoVjCkETHybYKLNJSoY4kg4rhjjTTchddeNMAOe40zuhjjjC20aKOONKD/kAKUwuxRLOK5GYKn
                    U4VJJKfhP3ihO9SJS/MnHCimCGMLL3bIoo0rAr0it14kHsiPJNIoowgnwkiBJAEUAMCDN9qQwYQL
                    drrAAhvu8AMPdsNoQ44soICDiTP2wOCDPvT4wwws8JAjCDbqGAGMPthAo4oxqH2Xz6/DRkO/ONYQ
                    I4w14nDjjBqskGYgfCTy23uEhLkbb802bZiR7ycF3MVAitBiCi1qREMKLeoA4wkP7iConC+cuKOO
                    HAyQgRVgIDkESAAGtkAHGVygBBSAgAwYAAE9fMIRfUhUF9BgPz9sIQl0cE0h8LCGPKRhCnXgwhby
                    gIMm4EEPbAjDnrrmHTZUpIuGanBhGOSQhitwwQxgEEIWaoUh9A2xIJJA2PhGxIu9cYOIHVLfQKYR
                    BB94QQteIANsnDAFjlQgCOkYSDXCIAX/GaEBD1jBBxIwAAR0QARCmAMagOABBkRgCBXIwB8mgQg/
                    1OENP5jCHJ4gByawSRJ2CFAWunOERDDBAW6gg5jScIY4vAENMWTDJTF5yXgFSlxSMMEX3DEQfcRD
                    H/qQWxPnBg7x/yExM+zYmypQuSH1dY8OPZgCFLQgBig4oQpDaEIXhgCAQAyEG06YwRxeUoMQfGAB
                    CXgACVKwBC90QQgt6AAADnAEFPTAEHk4gxLQsAc/1sEHUQADC6CQhzawIQ9MMMIbanCFNOwAD3yw
                    Q/HGIAYYvsuSbaCWXe6gBzLYMApbmEQ5DIMYe9yje7GcmytWycrL+AMTDQOEPBz6mMBRrB/2GMgj
                    kkCjtokBC3Iogxb0IAYALMAVA2mFF15Fhiv0oAUcoAAIavACVUkAABdQ1gSaYAQ6HOIMasDBEPZA
                    BiB8wQdNuIMd7JCHOIDBD2LYQRt44IJBGMIOY0PD1shQVHexQf8sbwCdP+UwQzrMYSxZyAMzBjKP
                    fIzKH/NoaEYJZg9BXMoyEs0MMvYmDLwyhh8VctFAwMEIKzzBik8wgharYAQ2tIoKMxjBJwZCjkqE
                    4QYdwAAIUKCCGuRACDdAwEoLQJIN8MAIhMiDGOBAhB34YQ0POEIc0oCGOLThDnIoAh3U8IIp7EUs
                    ZHCLnmwYSXe1wax04MMc4iIH5rphDHyIgxmucSGIFGYf/NjHKQdLKcBeyq+aqcdeO+WIw4YXIfbI
                    xz3mOpBoXK8JTWgDIwhRhz3YAS5+0MMa6GCHJhxAEQRpRzAYQYUWXKABJjjCCGLmpAAEwANJ4MIb
                    5sCGs+XADGv/kEEV9FCHPOShC1KYwxK0WM461EFQekrDi18MtuWSCXRycAsc1mCGP+ThCoAA0Tkk
                    lg+FSmS97JWUEU/EiPJmxh+q2Bs2jJyQfZisH0FaxQx6IAc8pOEPl6iEIS5xiE/Y4jp9mMOYIAAE
                    DTV0HtIIhi68oIAfVIELSNABCggAAAQAgTvZaUMhPlACPOBBDWCYAx7gMAUiBCILK9jWGOQwljM0
                    j9IzjsNk3yBJO7xhTGhoQhoakYUzeNFWEvlufKO8Im506hZLzow39uaJVCNEHxTzBzuC4IEyDCIQ
                    h0gEIOYAvTlgohJ2OANWvAAGD3DBQi0ySCiiQA5/wKMe61jG/yLkkAkTTvIMbQAED24gLjU8Ugn4
                    wp4clIDMMLhhTxs5w7vhLWM+ueENWYMDGe4QiDaQQQcz2EIcSBEIIUhC2oaR2D7uOusNkSKiri5f
                    wwqucAo5RBg+gMJ6AMSGPnBhV2t5gx2+0AU9yMEIGkjCNCSGj3zgo9aGuQaQEXIPS1zBCVyIAxpA
                    9wY1EC0NYTgCFfYghBgUTQ1iGMPNzcCGMsyL6WaY9IzdMIc9yCEOcsgWGB4MBjzQ4Q6EUwQ6LtRs
                    iXPIREd0dWYs1TBYjt0h3bOGFaTABWQGgQt2CAINwtCFLJAUB0Jgwxhy8AEA+GEgGHKIPlguMYWy
                    Qx8SUcfG5f+gMfyE4Qy7W4MantCFNLggClzowtDKQKT3cEFAZTD96d2yJ+bGIQ93+MIYlPACEhgi
                    ECooAx+E4HcaFGEV87hQ28e+IVg0/Ox6tejDJK6PdyDGIfeDghvwUIUu5EENLhDCGLA+hBL8QBBL
                    sAEQBBCBahzclA9xSD/OMY56uCgae/hCFpzAqjQYvQxiQEIZzrAEJMxBBUl4Qx3O4PWoIC966Avm
                    5fToYtLSgCnk4A5OrAWOQAmOQAbwYBbWoAfEgA2W4C6goAx0gSD64R7AK/gWAx7QK0SU7Ow0Qxb2
                    xkfGbh6CBDFcgQM8QAvY6gwMwQ+EIAeiwAyQoAhQoAj+4Ab/eAALQIAB9qB7CGPKBiIb8qAQcuEd
                    /CEY9kAM3KAFQqANekgNwgoNkqAI4AAKZIAMvGAM6OCExAAM8MKK1GCazCAMvEBRxoCH5GAOzlAI
                    RKAAYoAKCgcLmOARZOEIYEAQ+CQQviAHbKHwvGsESXAhbIH4VNCVLCqUJE4xmE8JMsAK9sAP3IAP
                    1oAIlkBqwEANeFAPjCAKaMAEwgAGToEg8uEcSkMZ+GAM7qAMDuEU9iAP+kAGBEAHsKDm4iKsmCAG
                    eOgJysB53GCHuuALwgAMumALsKAL4PCEtqALEGVrkEAGRiIAVCAKuqBtsEAJuGkRWCAMgIMPyGAI
                    cgEwGLER/xVCHk7QM1JQBZnMFFpQ4fqhoVxED27g+SjJuohACqYAC/6PB8gg6JhABGCgDhTACejB
                    4AaiF/JOEVwCDcRADbjABWIgGNbhCmagCIKACQpHC34gCpTuC6xAGrFgmsAgn7zgCn4JDJTgC29g
                    BoCACVxgAxaAJCDABpJACnxACIIABU7gBpTgENxgCe5ALOLgClChyNyRMXCB1ehxRFatYQSBEqOs
                    o5iPIOJAB1aFCsogEPpACqhg3exACoKg9WpgBnjACrQAAJTA94gsEriAC+CgCvMgEF5MCJ6AGhLD
                    Fa4ACpSgOZaACJrAC8zACqZADGzEC7wAdo7gB3YAB3IgBv9WQAeyQA9KQRvMwEkEIAFsQJdYoARG
                    AAJiwAJwAAxs0QrQQMPooAwiQR0IAiqj8iDgERLpkaL2BhZmrR/ooTDkxgcyQAvCoArcYISq4Av8
                    wBDuQAe8gBHQAAduYAv2gAoAAAnAbiBgQQviABKQKQ244F2OwA0eRh/aoTDaYRk4QQt0wAd0AAdm
                    wAdeIAZ+YAZWAAaqIgVCiwZuIAr6YBSYQSvvAAAEgAA0YAigYAvgwAYiYAQ+AAV04AZ8TF2+oAww
                    jA3wIBsSAx/a8TYH4hEvpdWqckSsYW8AAfmiLB8kovz0AQYowAzQgAvqIPqAoAwUIal8oA0mQQpQ
                    YAouaQn/AIAJBsYWyCAO+MARGmEQZnEKxuAI2AAxSkkJ0RMcrCEYUsENvkAJdgAIjgAK2kYNGuEV
                    kqEaqGE7DUIWRoAkKIAH7EwI9uAJSAAHYgAKeMANFMEFdOAKSsoOoAflLqQePvQ2TVA3q9IfKGFv
                    WGHWVs4fUiMYXuAGcgyHAqELgIAMQOgKiGALFCELeGBomEAIGiAT/OEcbqEO3MAQ8GAPAIENMMjz
                    uuCOAKPxQjDhIHJ76mExmJAdhJQkDqABMMADiAARwuAEVsALnEALFoEKUAAKuOAL/qwMANNRPRRE
                    E2L4RrREM0Ua9uYPIo699CFuFIMQgMAL4EAMyqAP+mAK/6yAECwhDoxgB8IgEMCARqOAB5ygCK4h
                    GwYBLyNBEOiADuAgh8ikCnaAAuggMezBoxAOBAGjMfpBiO7Bo9IhCnyVJBggBEggDewgB1hgC8RA
                    CgyBH6cADp5ACvigDGqlRWzVWv0BHUCEvLRVU5CsU2TNyA4j5QYiEIxAPWJACQpBEJoADFyhE4Lg
                    BpwgDuhgDLDADH4gBvKFEvZgDfzADurg0uygEAwhDcBADFYgBWQBowpLYgZ1Q/ahDAIAABpgACxA
                    BoBgCpDgDxylCL6gCLrAEjLGcnbAByjBIeaq/Fy2IESBKmeWRKihW6c1vPahHhAuSPxhFngADLag
                    BJzADv8agQ7YABHKQAkgLTLHBAtagAkmYRGqrhA64Q+8YA4GIRHqAO6eAANUIBR+xEXgq2DQwAAc
                    IAKkAwuirgooQQ2SYAdsYAkQ6QqOAAh84AhoYPxCUIgClyC0oWEKN1P4wRL2BhJSQ3GFcyCo4TXU
                    4IXMAIS4EArsABDM4Arg0guM4AfoABQaQQ8MoRAeYRDu4BACbA2CgAha4ANSofAiQpRadkVewQFW
                    AAcUoAbMAA/iIAvwIAyKgAdOAAioAIOYoAcSswqawfxa7nkfomZDhESnd0Sid29SJLzoytb8YROa
                    oNzsYAqAwGq74A3Cdw8g05+ugAnQYBEeARISwRD6IK3/VvUbrcAJMiAIkMF/EYMwbHNSoEAATCAF
                    zCAPvGAKosAInsAHkuBVxGA9ngAKsCAM4KARxOEhLISDiUF6Q1hTDgYrtTKj7mFCGs8f7MEQ/LLb
                    oKAGhoB2ZGoR+sD/7sAMB6ETMuEPCGES9ADD+sAQ1OAL2KAHHMALOBQfPEoxDqNsZckfumEGKuAI
                    UnIKguoIskAJtIC1vqMNMOcJnAAP6sASQGMRnxceDIFw03hEzKFbTUFxuafw/KEcXnINjqAHQAAA
                    UAAPzIAJ3AAQus0ZDcESJMEQBGER/GA7AEEP0sAK3CALACAJGFY44YuuIKZhwQEKeqAKrCALwgAJ
                    nA4L/8CgBnjAC9rgDMbTCZyAERYBCxxhQuBhiRvRyS5lHmd5RFihW63BhJVYQ9SBD/jnBjaASgBA
                    B9YGDAZBEopADU6hERqhD+xgEPYgDgRhEIxH1IxgBN4gUhjXZPaB5VoEH+5BnzkkH3LVHwABAo5T
                    C85gClDSCX6xCK6gDZqCDJrADBCBEwIBDjphHTh4hGX2n0lkHoCmYRThITMqZ8svHbTgBJzgBDRA
                    AiJgJAygChzBEAChC4qgEVShESJBEfLgahdhE9BACeTJBmSgFX6kYe8qYu0hgDvkuwYiFiogB2Yg
                    CMDA52RACbCADLxYLObACF5AC/4gE0yhEL7glg/Oo//0AaqDzx4coVMSRqkzxRe61QUd6h7koaHO
                    AQzAgBcy4QFIogJ6AAAkAA3q4AdQABAkQQ8uYRMKIZIE4RDMgPRilQZwATA4ypIppTSCxBx0AgEW
                    AAjaOgVqYAuEgAr4QAnawAsmAABmIA8qwREIoYdbylEXCh/mYWDGTkSTmrNHZB84ZW+0IaotpJT8
                    gR5Sgxg6YRJ6IAROAAAKIAIaYAwmYQ8oARQwYQ/SgA6wLQu2gApKQAiYKB+H25v9Zh8m1iFcwUke
                    4IVcoAOWQKfzwAm2oAVWKgWSgBGUFBUsoQ9iQUPwoR7sgXGDzxti9kT6Cr1JBBu61REcd7DwwUXs
                    4bD/YIFZ8gwAjOAR+sAPMKGp84AO9KAMtmAGToALCo5iSgPCv4eUFOMRnMQH5OADMoAJcOC3smAG
                    OocBPEAF9MATLKETSGET8OAX/AEf0oEfTGbs8MGDQ4TG8WZwFdWhFvH8MEQfBBXh7kEVtKAESAIB
                    mkAPHgET7IA7WAi3pKDLQQGjHmK4C2JUMJ3KKeUeVI6UbKUL0vYBdCACBiAHKoAE3uALcCbPJgAF
                    wKASHsESQmETNCEQbIEf5AFDcnzWWNBQ8fwf4qGpG0Z7UCln86EwWLQg5uETCpwKRqKn2uAQ+uAQ
                    FoEOvoB6piAGzCCDzY9swSvTMb1g6mGl7QEG/UEd/7Bgc/KsAPKsCvzhEGBmAjBgBdYADwSBUy5h
                    EJzgA1d87E5Us38db8arYQyhjYeoNBYX8VykMFbBC/YgaEIgAHbSBLL2EBwhD7jACpYgBNggBsuv
                    u0ZQykWeEcF9UEs+Yi0kl/3BG1IgbQHAAAwAm1rxHoyAJjonAqjgxQChEiqhEwQBEaBs16NMHhAB
                    jQNeYax3b0CBpSMGHtjBwRlqIOgBFRQzD/4ADVoA5kniBxaBC4vOCLwAFgYmH+S7lIg7cA4i0xfj
                    5BlKrxFvICSBJFLrBFJhHLqHFWaCJiLXDf4gECRBFToBFBShE+Jh7PT8vI+eRGC2W32Bbqb0ruiB
                    vP8VgxxiQQ2wAHrAwAg2YCZihgGegDvcgAoSQQod9fAA50LEtowNIo5No+34oXZLZhuooRq4Afkk
                    XG4Kq7vuwZR2/PVVA2YAgAa8yJvTgCYOAAj24BAYQRFWrBEs4RCyAHIULnw6xZ8Tn0Q8G0WZKGIQ
                    PvL9FjH02h/MgRTsIC7KQA26oAYegAAKQAAaADkuoAjGYAteQK4NTtMfIjWuQRSE4RkAAlakV+z8
                    GTxosN++g+9IZQHyI0ocO5S8ITzYL18+fgbz4dOnz2AdACTF+OsHjp08f+VOkGzypw+eNJHYgCkE
                    yEuUcRd7+vwJNChQcID+GD2K9M+/pUybOn0KNar/1KiYklo1qmil0K0/+YXsd+9ev4PHUskyRaqN
                    ljFn2JjBIqMBSQMGBJBcUGFECABsgCo8aK0LCxQujAi5AMBEF1/2FtoTt01cvJOwvPQQwuSGhxpV
                    jlwxZpAjxov25vnbN/aNBTyjWF2q5ImVKXfDPgCYweSIFRtTpqjYMgbRkDj1uBo/HpQeo6tIpzp/
                    Dj2qO0HMk2IKifz42NBj++1SMyULnDhVztBBg4UIiwUABpAUIEACEDZryHzRkObgvnsG26mj9w01
                    6CgTRAM2+OACCj7UQAAAOZgxhyOSjJFCBjHcwcofKtTwxRhfcOEDCkHEIMEQwaADTTLHTKOOP/K8
                    /xOPOL90Ugo2BtWTiRqYPCLHIJA0csoprZwjTRsRJKACE1HI8EQOTHRxBRhCuJNdlcjxo0l1Rm0S
                    XZdeTtWMlkjBYuVW/Wy3z0L4iGJGHHS08YcgcFjBRA8iQNBgewa4BwIajVTChx90CPFEMf54Q8wt
                    u7wSCSGNAPKGGSxQQAIMOIRAgQQnGAHGHGJAcQUXUPQQRBVeVBFDCl4AAscXaayxhRFKhDHFFmiA
                    scUXbyRiyiZsVAHGF16c8UYhriCSRBxrxCGII5tYUokpllzSzDBMoHBFGHXMUccRQtTxgRG6lEmu
                    ULSIyciX6q7LFCpiHqVMuT/pw988Wn0iwxZ3/P8Rhw9CSPHCCIgBYIACHjAxhhUwGBGpFlM0AYQH
                    BTARiBxmhHHGGVtQEYYdY2CxhRidBYEDETwQ0YYhdtixh5t9DIJIIoAUYkcdighCSCWRUGJIHn4Q
                    4scbYIBBxhptoGGfCgyk4MQbfECRgAUzGPFFGGXkoccfZ4whRx95nFGIKa+wogkmr7Syxg8sFHDF
                    SfK+fRAz77JL95f3KPLuH4BYBPdF+cSDj0FsAFCDDjv0kAAAFTywQQsyNJFGIZHwAYgigPAhhxpg
                    jLEGHGFEoUYcc4yOxx58vJxIIY0g4oglk1AyiSWUNKJIIogwUsmziyTCCCJ3ALKIIL8PIgcdgajz
                    IcYcbZixhhvL7iHIIIAEIhMeePzByCSFDM0vGmzYgcgeX9Chshpl4LHLNcQEw8sw0whjRRfpYNe3
                    vESJmUrd+kcXTlHvGtKi+hnkHsUxyCsCEQo2RIAkCNDBFejgCEpoQhKIUEQgJuIoP4xuDoUoxB4W
                    AQlE6AEPfghEIRBxCEEcwhF7OEQjAsGI2RFCEIl4xCMgQQjJDeINb7iDHdRABz2sIQxrMMMZymCF
                    V6VhDnIoQxzuwIc9YK0PfWBEIwZRO0dcAhKb8EQoTuGJSnSiNazwxCtScQlRvMIVp+BFMoBhDFzY
                    Ihff8Mc6yCFAcqkDEeja/58fn2OMvP0BElqp35l6gg9MJC4JeHAUI2xoOdMFwhBA80MiAjEHSSZi
                    EYwIxMz+4AfqzIEN49FDH/RwOj3AgQ1zyEMd4EAG88DBDEYcQywv1gUiyqENapDDyvoQCFTu4XeF
                    oCIV+cAHLN7QEZ0wRSg+4QlRdOITt7gFNFthC1q0AhSXAAUrcPELU2gCFqkABSlm4Y14iOaQeRSK
                    PCTRxz/KUyqgEKQmAtfOg/BDNGIAQBcWYYc58EEQgujDHdyABj8oQg9kSIMhHGEI6YHSD39YRCQM
                    8QYvkIFbYfhCGcyAhjWo4Q11kEMd8mCHNHShCU/wApSygIUqZEELV6iCFP+sQIaEgQENcLjDHeqw
                    h0HIpBCLGATQoKcISFQiE5eIxCU84YlMdOIUnxBFLmZRCeCNIhaowAQjDKGIp1bCEZyQBCdOoYpa
                    pEIaHdmHPvKRT5/ogxNzm6ddn5IPRwiSFKKJq0GUcQIKtKEOaZDDHvQgB5L6ARB0MAMYzoCHQ1DC
                    Eo44BCAoWrlF8MsNdcDDG8RQtDac4VRV+ALRjGaGLoCBs3DI2BmKVkQuTCEKM61CFazAhTH00i1m
                    IIMc8kCHOrihDXooBCMcYcVKYMISkmjEIyaRCW/SAhWScIQnTgGKSAxCD3oABCNUYYtb8CxmmEAE
                    JcpxEHrYw68I4Ycp3nX/i7vKtynvoE7eWMFef9SDCAvwwiA62Ac2lGENdljsHLjAhAdG1A97mMMa
                    PDQ0jK2BDXUgRCIIQQhA3KENY9iCFayABSpA4QlRqAIVtlBYN6ThDXSQAxzg4IYzhIEMbKDDT+WA
                    Y27VwQ6RcsMbxtBRL7DFaGyIgx9kUgc6rMwPgxhEJl6xilCQQpqb4MQoVAGLVUTCE9R1RCQWoYhB
                    CKIZA8Rnfv0Bi3flb75s/sc0BPkHW7BXFUI4Qx7moNk5FBeiceBCEpQABSy4FAtMGIIQftCDHvjg
                    B0SwQkjLIIYvhMwMZbBPFZzABChMgQpSeAKJl+CEKjwhCU3oDRVsOwUp/1yhoWdoAx2whoc54EEQ
                    eeDsD1st4I6KIWMd3ZwRyYAGx7JBD3m4Qx9WSAlKPCJ1gvCDI3b0CEtkog9ouIQszuEPkJzZH7Z4
                    V7ra3OZgwNkXcWXHTAXhBVeToViFmEMYtCCGOmxrDnFwAxvGMKw3XA9nhYgoH/LQYFr29gtWaAIR
                    gnCEKoRBDBsDlRjM8AUthOFVAidDGMxg0jawgQ1umEgU90CHZclha3TAg4qNKFIgz7gMXQi1GKyW
                    Bjj0YRF8RGkd3hAGLuRhhiDHwyLygAZNMIIXBlFvfonhbXArnRRwBk07eTGGONRBDM6TNRu6MFsq
                    fNgKtsqDIAxxQkhcov8TmZAEI/iAhzy4KRCE4EMc2EAGLlDhCU0wAhCeAFOtc4EMcODxGu5gCETw
                    QQ8bHoNu4W7LMyzLh3bI3El5CQc5bDAObXADHUoeCEHQwQtTuMIY2uCHSVTiEHmw3i7f0AdENLux
                    UdACI0zxiUcMIhbFsYeZ30a/gwSyrkoHtyWaLi99LEQj/vjFENQQqD+YNHol7EMcIH6FLphh4xDf
                    Aheq9oUrOOEIQ1hCqp/gBCQU4cReCAMYuICFTlshC1k4dRa6YEtceeHh8n7DGUKKTBsX2/6qTcMY
                    4J8G91dpaaBxakBLPtZKILcGWBAFXXAGfUAJicB3eLAGaeAGv0MIf1D/UoulB3XwB5ZgCLYzCpOB
                    EexUJuZwEbsnJr3HgsshSE5XJf2gDx/hD43hD48AAzbGB3+AB3bAB5PUB1xgBFcgB6hEUXpDCHVg
                    BmnAhGnABoMlB0jjIVcQBU3ABEugBEhwBFtYBEDQA0CwBFhwcZVWaWMABmFAeWcgeWvALW8gOiwD
                    CDCDCIUQCHfwBkVESm7gYzzkJnOwSmqgBmuwLHRQBmnQCJsQCGlgfmvAB4XAB8vzBn5wCIgQCBr3
                    CLOwC4XABsmAEfywD/xgguWiglrCgiz4DhkoSMBgJV5hEKiBD8tAbYCwMiilB3QAiEdDBnGgSr7E
                    XVjzY0YkcGYgBlwA/1NYMAVJ0H1NgIVJgARJYAQ/oAM2gANB0AQgtn7XNwZG1AVi6GIaIwZe4AUd
                    sgZ0sAdUJAgxM4eC8Erccgd4wF3c5UPzFgdyEAdmWAeNMAlyMAaotwiPQAh08AaAAF2YkAmesAqz
                    4AqjYAdiMAr8cRL7BIrbUS5Ip2alyILoYF95I2cx+BX+gAxhYAXfAwceOAiL0AbhUQeUUF4b9lt+
                    4Ac9qGKAmAZocH9dcFtXkH5HgGiJlmg8oAM+sARU4AW11AVigAZooAZt8AaS91pwcARRQB9/91PP
                    twVOIJRb0AU0Vgd+MHjFZgd0MDrylmRM5IfD6AZfYwaKgAmiAAujMP8ITxhKgfAHHQgHa8BDb2BC
                    hyAJyABXfRWKVqILebNmFtl74uA/eQMLfcUV/VAP67UQ0WAFYCA8HXWUaGAIjcAHwVUzdBAHLyZQ
                    iCAJl4AJzWUIfnAHtlgGH4U0WhAFTwAFUQCbUuAEWvAGanAGFuiDgCAIgfBfk6gIGOYIOdAEg0AJ
                    xsUIVtQIjYBD7UgHdRlsRvQqHVc8pWc91elKbJAxaXAxoFcIfsBLfJA7j2AIMVQJkxAIdiAKxKAM
                    w7AJnQAOp9Fe5MIPsiCYhGmR2wBnf4AKtycU+wBXGeEPzeAFWrAGckCAb/AFURA5jvCPdEBD0SNm
                    l5N2wyQH9dEFWfD/BV/AflywMU7gBK4ZBVIwBVYgBUnABE8wBbeFBU+gBFEQPwPWBuYHB0FJHx7S
                    BeK4lYHAdpT0B3cWB50JB28wXG9gBz7UjnnAB28AB5iEBnsQCMCGUHcQCaWwCmgxCp2ACeVpCcFj
                    CcfTWYUQDf5we4p5Je7yLlxinxYpN3DmCetlHPpQDwvhD5gQfeEBBVtABlsgBVzgBnZQl0LaBnPg
                    BmOgBVRQYksABERABEWwhUiABEBwAzRgAzqQAzUAAzAgA5KKA9EYAzmAcF2oA0LgjEVQBIoaBDdg
                    A0WAfklwAzuQAz0wBFzIA0uQBa35BKoWMmQgBrvKq2WQnYHYBiK1/weY8AmH4Et5cHpFygYYI3X2
                    N310MAgqsweNIAl9QG4O2YoSeRz44Al5821papHKkJ+SQCVbwQ/3kA9jMQ+FMAU95AbAESlcsAZ9
                    sAcqFQZh0AVesKJJkAROMKJWMFtOsARaeAQ+EAMq0AI0sKlBIARDYARJsARJAAVeQDS0VAZh4AZ4
                    AJYuFqRMVAcdhAc+VZ0/dXn0BgdtoJ2p6QXXFwZjUAbBtnAui5Rp8EpekAeg0AmCEEV4IAds4ISt
                    5I6AwDqR8COREAmSIE2h0Ai+0A9umq3Z4Q7wlHTgap/FkJ+K8J5CcUhqoghPgJS2aYE+qwZ1oAe1
                    OQd0gJ0HKqRpoP+LdaAsF6taBBcFrykFVKAFWoCVYCAGY7CrL2s0SroGIdUGcKBkeEBFUsRdVMSV
                    PahkdpAHfUBRXFlsLXa2l7ctUblxT4iyZfAGgyAJIWQIh0CHoKQ3pAszirAcdpBDhrAImZAIwlCD
                    7aWtW0EOeDO1VFu1+QkI0GAmMmgQm8AxXXCjensGgThcR+mzZcAGbtiZ2Hl/ZuAhWwBTstkESVAE
                    hkYEJ/qaKWoFNpWiWqBau2pLqgmIFqur50uTZ0BLuvqyRnR/TDhhIqUGAWiBvKSdZEAGK/uyIdVx
                    gigHdwCPc+CGdQDAiwUzjrBUmaAIXyAL/iAWo3Ec0HCYWvKtuGv/n9eQn3+AC2R6EfUwD43ZDo1Q
                    Ai1glRO3BltzlB9FBkMjBr7KhGhwsTOGr1oQU7NVvaU6BEVgBEZwBH/GBB7qoleQBbmitysbji1L
                    BoXYhEfpWk18RCEFiFFsgKmZU7xqeElMS2lgccwjpGygBmhAgPPoYm6AY50ppM8nsEswBD2gBYPA
                    VvggkbMbFLggSGhqweCKDRkMCoXUE/cAD+vwDdzACmLgjDiAAiAQAoTxAiiAAjNgAzBwAzqgAirg
                    Ai7QAiqAAiPQAR2wARhQARMwAQ6wAAhAAANAAAVAFweQAArAAA6gABawApPMAi5wqY58A5vKAz7g
                    AzrAy5SaA5Xa/wKV/AIvcKmXvALHjMwtQMwyMAM1cAOoegOvGgSLaqKgpmpFmQW9AQVKMAQ7cAOX
                    gQS0RTQ8FQifIAu2oAzusA/4sBFynByiIEiDecd4PMHvgrVBoQ/xsF7xAA27sAqS4AfbYgdncAVa
                    oAYq9kQcNx6r1Bb09gbByoSQ9gVdgJWmdcW3yYRvQGxYczp9oEK+eVyPoAgjnQgljQgoNImbtAir
                    Y1QYhmGGgFj0Zm8nzAU0LGJWmARCcAMswALCuQVvkAcVJUGf8Eyk4Aq+sAzW4A3koM5wQw4uWJHz
                    bMH3A2eAALvIsQ/0EA/wsNXrsA7wAA/s8A7wcA7poA7ssA7nMP8O5FAO5UAO4iAO4PANbR3X4CAO
                    5nAO3+AN4LDW5YDX5wDY54AOg50O68AO7QAj8jAPYWEP9lAP9UAP2Ioc+mAP9DAPjg0P6BAO22AN
                    2bAN09AMy/AM2OAN7nAPHOxXxlDP1SHPUo27qAhnokAP20bbtW3bPWEP7yVIrs3btgtnjMANty3c
                    wx1X4KBXu83bvN0JGRxnqE3czw3d5tptglTByS3VZjqueBTd283dPmEOlPDb1i3ey8DcgKALudfd
                    6T3c/KALq83a4g3fhsnckpC16m3ftQ0O4A1n8QXf/f17zC0Ls33fAx5X9iAL7s0c1d3f4o3d+YkI
                    zEDgEV4/0ODp29664Be+FM/A3EahCeIg4R9uJeJAV/nZ2hje35Ow4X/ACuUK4i0OFO7ACgie4CZO
                    40uRZhsuCLrgtC7O4/bAC7BdxzUu5P8g42JiCL6A3jxO4PoADIbA3EMO5SO+4YpgDEmu5N2tD8ZQ
                    4dQN5V3+DymOFcSw41ce3fag5Rvu5WmuCmD+B4aAC3xM5sItD7rg5Mxtx2nu5Y3A5oLACtod57Vt
                    Dq6QkRmM54W+FLvA5kbBCdJg5X9eP/pADVLO3CVu6F5eT4muCLpQEI4uQOygC1uen3de6ZUO1WzO
                    Ccww5pyeHfjADJLO3Ar/PuqVjgyJfhSCgArUwJ+qHhT4QA2qMOgbzt+xLuxMIQy0fhSEwAq4rus/
                    weusAOQpHuzDLu1L4QvGXuuioAwBpOvqoAyi8OvQPu3h7hS8YO1IAQmyQA0CruT0QA2yAAnlHu3i
                    Lu//QO7ljhSSAAvQsOkEzg7QAAtSC+/zLvBO8Qulbu9tLgq8IA3osN3oIA28IAp1bu+MEO8Db/H/
                    YPAHbxSAYAmowAvQIA7qnk/0IA7QwAuoYAlFnuiwfvEtvwkaLyaCIAmxgQu+4AxKzdTuAOcHIQ/u
                    4A7k4A3W4Ay+gAtlJAnfDvN/IOotz/RNsQsZn/RRL/VGQfFNb/VTkQpTd6/1SU/pV+/1TvHyWy/2
                    YL70X2/2URH2Y6/2WlL2Z+/2UpH1ay/3f9D1b2/3U3ELaT/3ML8JFX/3f98lqQD1e//qdQ/4h+8l
                    eU/4JO73iO/4+nMLgr/4R8EIqdD4j4/5d5UKcT/1m5/5ny/Vmy/6gin6hg/66hIQADs=" >
                    <h3 style="text-align: center; color:#000;font-weight: bolder;font-size: 2vw;">IPHEYA IT SOLUTIONS</h3>
                </td>
            </tr>
            <tr>
                <td style="width:80%; padding:5%;background: #fff;border: 2px solid #ddd; color:#000; text-align:center;font-size: 1.5vw;font-family: &#39;Gill Sans&#39;, &#39;Gill Sans MT;&#39;, Calibri, &#39;Trebuchet MS&#39;, sans-serif;">
                    Hy '.$name.',<br><br>'.$message.'
                    
                </td>
            </tr>
            <tr align="center" style="padding-top:2% ">
                <td> Follow-us on </td>
            </tr>
            <tr align="center">
                <td>
                    <a href="https://www.facebook.com">facebook</a> |
                    <a href="https://www.twitter.com">twitter</a> |
                    <a href="https://www.instagram.com">instagram</a>
                </td>
            </tr>
            </table>';
            return $body;
        }


        public function btnLink($href,$value)
        {
            return '<a id="button" href="'.$href.'" style="padding: 2%;background-color: rgba(45, 76, 204, 0.94);display: block;width: 50%;border: rgba(45, 76, 204, 0.94);border-radius: 2px;font-weight: bolder;color: #fff;align-self: center;margin: 3% auto;text-align: center;font-size: 2vw;cursor: pointer;">'.$message.'</a>';
        }
#faqs
public function getfaqbyId($id)
{
    $sql ="SELECT * FROM faqs WHERE f_id=$id";
    $qey =mysqli_query($this->connect(),$sql);
    if(!$qey)
    {
        die("Error".mysqli_error($this->connect()));
    }
    return mysqli_fetch_assoc($qey);
}

#event 
public function getallevents()
{
    $sql ="SELECT * FROM events";
    $qey =mysqli_query($this->connect(),$sql);
    return $qey;
}

public function getEventbyID($id)
{
    $sql ="SELECT * FROM events WHERE id=$id";
    $qey =mysqli_query($this->connect(),$sql);
    if(!$qey)
    {
        die("Error".mysqli_error($this->connect()));
    }
    return mysqli_fetch_assoc($qey);
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
#info 
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
    // echo mysqli_fetch_row($log->countTasks('P005A5A'))[0];
    // while($th = mysqli_fetch_assoc($all))
    // {
    //     echo $th['project_name'];
    // }

#end of testing--------------------------
?>
