<?php
// error_reporting(0);
#Connection
   $con = mysqli_connect('localhost','root','');

   if(!$con)
   {
     echo '<<[Connection failed'.mysql_connect_errno().']>>';
   }
   else
   {
     $sel =mysqli_select_db($con,"ipheya");
     if(!$sel)
     {
        $create_db = mysqli_query($con,"CREATE DATABASE ipheya");
        if(!$create_db)
        {
            die("Error ".mysqli_error($con));
        }
     }
     else
     {
        // echo '{--Connected--}';
     }
   }

   #select database
  mysqli_select_db($con,"ipheya");
  $sqli="CREATE TABLE serviceHistory
                        (
                          historyID int NOT NULL AUTO_INCREMENT,
                          PRIMARY KEY(historyID),
                          ClientID int(11),
                          FOREIGN KEY(ClientID) REFERENCES clients(client_id),
                          ServiceID int,
                          FOREIGN KEY(ServiceID) REFERENCES services(service_id)
                        )";
                           if(!mysqli_query($con,$sqli))
                          {
                            die("Error".mysqli_error($con));
                          }

          mysqli_close($con);
<<<<<<< HEAD


/*#CREATE TABLE clients
=======
#CREATE TABLE clients
>>>>>>> bec65a2119fb5dad88eb5b5905279959b699debf
   $sql = "CREATE TABLE clients
           (
             client_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(client_id),
             name varchar(100),
             surname varchar(100),
             email varchar(100),
             password varchar(255),
             postal_address text,
             contact_number varchar(10),
             province varchar(100),
             account varchar(255),
             archived int,
             token varchar(255)
           )";
   if(mysqli_query($con,$sql))
   {
     echo '{--TABLE clients created--}';
   }
   else
   {
     echo '<<[CREATE clients FAILED: '.mysqli_error($con).']>>';
   }

#CREATE TABLE departments
   $sql = "CREATE TABLE departments
           (
             department_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(department_id),
             department varchar(100),
             email varchar(100)
           )";
   if(mysqli_query($con,$sql))
   {
     echo '{--TABLE departments created--}';
   }
   else
   {
     echo '<<[CREATE departments FAILED: '.mysqli_error($con).']>>';
   }

#CREATE TABLE employees
   $sql = "CREATE TABLE employees
           (
             employee_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(employee_id),
             name varchar(100),
             surname varchar(100),
             title varchar(10),
             date_of_birth date,
             gender varchar(100),
             email varchar(175),
             phone_number varchar(10),
             identity_number varchar(13),
             postal_address text,
             residential_address text,
             department int,
             FOREIGN KEY(department) REFERENCES departments(department_id),
             password varchar(255),
             token varchar(255)
           )";
   if(mysqli_query($con,$sql))
   {
     echo '{--TABLE employees created--}';
   }
   else
   {
     echo '<<[CREATE employees FAILED: '.mysqli_error($con).']>>';
   }



#CREATE TABLE quotation

	$sql = "CREATE TABLE qoutation(
                                QoutationID int(3) NOT NULL AUTO_INCREMENT,
                                PRIMARY KEY(QoutationID),
                                Title varchar(30),
                                Summary varchar(300),
                                PaymentMethord varchar(15),
                                TotalDue double,
                                ExpiringDate Date,
                                QoutationDate Date,
                                SeviceID int(3) NULL,
                                status varchar(1),
                                RepairID int(3) NULL)";

       if(mysqli_query($con,$sql))
       {
         echo '{--TABLE qoutation created--}';
       }
       else
       {
         echo '<<[CREATE TABLE qoutation FAILED: '.mysqli_error($con).']>>';
       }

#Create Table Users
     $sql ="CREATE TABLE Users(
                  User_Id int(11) NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(User_Id),
                  UserName varchar(256) NOT NULL,
                  Email varchar(256) NULL,
                  EmailConfirmed bit NOT NULL,
                  Password varchar(500) NOT NULL)";
        if(mysqli_query($con,$sql))
        {
          echo '{--TABLE users created--} <br/>';
        }
        else
        {
           echo '<<[FAILED TO CREATE TABLE users : '.mysqli_error($con).']>> <br/>';
        }

       $sql = "CREATE TABLE Roles(
                Role_Id int(11) NOT NULL AUTO_INCREMENT,
                PRIMARY KEY(Role_Id),
                Name varchar(50) NOT NULL
         )";
        if(mysqli_query($con,$sql))
        {
          echo '{--TABLE roles created--} <br/>';
        }
        else
        {
          echo '<<[FAILED TO CREATE TABLE roles : '.mysqli_error($con).']>> <br/>';
        }

#Create table userroles
       	$sql ="CREATE TABLE UserRoles(
                Role_Id int(11) NOT NULL,
                User_Id int(11) NOT NULL,
                PRIMARY KEY(Role_ID,User_Id),
                FOREIGN KEY(Role_Id) references Roles(Role_Id),
                FOREIGN KEY(User_Id) references Users(User_Id)
                )";

       if(mysqli_query($con,$sql))
       {
         echo '{--TABLE rolesusers created--}<br/>';
       }
       else
       {
         echo '<<[FAILED TO CREATE TABLE rolesusers : '.mysqli_error($con).']>> <br/>';
       }

       $createRole = "Insert into roles VALUES (NULL,'Admin'),(NULL,'Client')";
       if(!mysqli_query($con,$createRole))
       {
         die("Error in roles".mysqli_error($con));
       }

       $users ="Insert into users VALUES (NULL,'Admin@gmail.com','Admin@gmail.com',true,'Admin@2017')";
       if(!mysqli_query($con,$users))
       {
         die("Error in users".mysqli_error($con));
       }
       $id = mysqli_insert_id($con);
       $users ="Insert into userroles VALUES (1,$id)";
       if(!mysqli_query($con,$users))
       {
         die("Error ur".mysqli_error($con));
       }

#CREATE TABLE targets
     $sql = "CREATE TABLE targets
            (
              target_id int NOT NULL AUTO_INCREMENT,
              PRIMARY KEY(target_id),
              ip_address varchar(50),
              first_visit date,
              last_visit date,
              total_visits int
            )";
      if(mysqli_query($con,$sql))
      {
        echo '{--TABLE targets created--}';
      }
      else
      {
        echo '<<[CREATE TABLE targets FAILED: '.mysqli_error($con).']>>';
      }
      #CREATE TABLE targets
      $sql = "CREATE TABLE target_clients
             (
               target_client_id int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(target_client_id),
               target_id int NOT NULL,
               FOREIGN KEY(target_id) REFERENCES targets(target_id),
               client_id int,
               FOREIGN KEY(client_id) REFERENCES clients(client_id)
             )";
       if(mysqli_query($con,$sql)){
         echo '{--TABLE target_clients created--}';
       }
       else{
         echo '<<[CREATE TABLE target_clients FAILED: '.mysqli_error($con).']>>';
       }
#Client Requests
 #CREATE TABLE serviceRequest
   $sql = "CREATE TABLE ServiceRequest
           (
             RequestID int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(RequestID),
             ClientID int(11),
             FOREIGN KEY(ClientID) REFERENCES clients(

             ),
             ServiceID int,
             FOREIGN KEY(ServiceID) REFERENCES services(service_id),
             Description text,
             RequestDate date,
             RequestStatus varchar(50),
             SurveyingDate date,
             Duration int,
             Warrant int,
             DueDate date,
             RequestType varchar(11)
           )";
    if(mysqli_query($con,$sql)){
      echo '<BR>{--TABLE ServiceRequest created--}';
    }
    else{
      echo '<BR><<[Failed TO CREATE ServiceRequest : '.mysqli_error($con).']>>';
    }

 #CREATE TABLE MaintenanceRequest
    $sql = "CREATE TABLE MaintenanceRequest
           (
             RequestID int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(RequestID),
             ClientID int,
             FOREIGN KEY(ClientID) REFERENCES clients(client_id),
             ServiceID int,
             FOREIGN KEY(ServiceID) REFERENCES services(service_id),
             Description text,
             RequestDate date,
             RequestStatus varchar(50),
             MaintenanceFrequency varchar(50),
             MaintenancePeriod int,
             EndDate date,
             RequestType varchar(11)
           )";
    if(mysqli_query($con,$sql)){
       echo '<BR>{--TABLE maintenance created--}';
     }
     else{
       echo '<BR><<[Failed TO TABLE maintenance: '.mysqli_error($con).']>>';
     }

 #CREATE TABLE technical_observation
     $sql = "CREATE TABLE TechnicalObservation
            (
              RequestID int NOT NULL AUTO_INCREMENT,
              PRIMARY KEY(RequestID),
              ClientID int,
              FOREIGN KEY(ClientID) REFERENCES clients(client_id),
              ServiceID int,
              FOREIGN KEY(ServiceID) REFERENCES services(service_id),
              Observation varchar(100),
              Description text,
              RequestDate date,
              RequestStatus varchar(50),
              PhysicalAddress text,
              RequestType varchar(11)
            )";
      if(mysqli_query($con,$sql))
      {
        echo '<BR>{--TABLE technical_observation created--}';
      }
      else
      {
        echo '<BR><<[Failed TO technical_observation FAILED: '.mysqli_error($con).']>>';
      }

 #Create Table repair request
        $sql = "CREATE TABLE RepairRequest
            (
              RequestID int NOT NULL AUTO_INCREMENT,
              PRIMARY KEY(RequestID),
              ClientID int,
              FOREIGN KEY(ClientID) REFERENCES clients(client_id),
              ServiceID int,
              FOREIGN KEY(ServiceID) REFERENCES services(service_id),
              Description text,
              RequestDate date,
              RequestStatus varchar(50),
              SurveyingDate date,
              RequestType varchar(11)
            )";
      if(mysqli_query($con,$sql))
      {
        echo '<BR>{--TABLE  RepairRequest created--}';
      }
      else
      {
        echo '<BR><<[Failed TO CREATE RepairRequest: '.mysqli_error($con).']>>';
      }


#CREATE TABLE services
      $sql = "CREATE TABLE services
             (
               service_id int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(service_id),
               service varchar(100),
               min_duration varchar(50),
               durationType nvarchar(20),
               description text,
               department int,
               FOREIGN KEY(department) REFERENCES departments(department_id)
             )";
       if(mysqli_query($con,$sql))
       {
         echo '{--TABLE services created--}';
       }
       else
       {
         echo '<<[CREATE TABLE services FAILED: '.mysqli_error($con).']>>';
       }
       mysqli_close($con);
#CREATE TABLE QoutationsItems

      $sql = "CREATE TABLE QoutationItems
             (
               QoutationItemID int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(QoutationItemID),
               Description varchar(300),
               Name varchar(100),
               UnitPrice varchar(50),
               Quantity int(5),
               QoutationID int(3),
               Supplier varchar(30),
               Status varchar(1),
               PurchaseDate datetime,
               FOREIGN KEY(QoutationID) REFERENCES qoutation(QoutationID)
             )";
       if(mysqli_query($con,$sql))
       {
         echo '{--TABLE Quotation Items created--}';
       }
       else
       {
         echo '<<[CREATE TABLE Quotation Items FAILED: '.mysqli_error($con).']>>';
         $sql ="Create Table Ticket
          (
          Id int(6) unsigned auto_increment primary key,
          ClientID int(11),
          Subject varchar(50) not null,
          RequestType varchar(30) not null,
          ProblemDescription text not null,
          Status varchar(50),
          DatePlaced datetime
          )";
          if(!mysqli_query($con,$sql))
          {
              die('Error'.mysqli_error($con));
          }
          else{
            echo 'Done';
          }
          $sql ="Create Table Ticket
          (
          Id int(6) unsigned auto_increment primary key,
          Subject varchar(50) not null,
          RequestType varchar(30) not null,
          ProblemDescription text not null,
          DatePlaced datetime
          )";
          if(!mysqli_query($con,$sql))
          {
              die('Error'.mysqli_error($con));
          }

        $sql="CREATE TABLE Task
        (
          task_id int(3) NOT NULL AUTO_INCREMENT,
          PRIMARY KEY(task_id),
          Name varchar(30),
          Duration int(3),
          DurationType varchar(15),
          Location varchar(50),
          StartDate date,
          EndDate date,
          Description Text,
          DatePosted DateTime,
          request_id int(11) not null,
          foreign key(request_id) references serviceRequest(RequestID),
          foreign key(request_id) references RepairRequest(RequestID)
        )";

        if(!mysqli_query($con,$sql))
        {
          die("Error Task".mysqli_error($con));
        }
          $sql="Create Table employeetask
          (
            employee_id int(11) NOT NULL,
            task_id int(11) NOT NULL,
            task_date Date,
            PRIMARY KEY(employee_id,task_id),
            FOREIGN KEY(task_id) references Task(task_id),
            FOREIGN KEY(employee_id) references employees(employee_id)
          )";

          if(!mysqli_query($con,$sql))
          {
            echo "Error Creating table".mysqli_error($con);
          }
          else
          {
            echo "Table taskEmployee Created Successfully";
          }
           $mvelo="Create Table Surveying
            (
              SurveyingID int NOT NULL AUTO_INCREMENT,
              Primary KEY(SurveyingID),
              RequestID int(11),
              FOREIGN KEY(RequestID) REFERENCES serviceRequest(RequestID),
              FOREIGN KEY(RequestID) REFERENCES RepairRequest(RequestID),
              Description text,
              Image LongBlob
            )";
            if(mysqli_query($con,$mvelo)){
                echo '<BR>{--TABLE Surveying created--}';
              }
              else{
                echo '<BR><<[Failed TO CREATE Surveying : '.mysqli_error($con).']>>';
              }
                $sql="CREATE TABLE payments
                (
                    payment_id varchar(50),
                    PRIMARY KEY (payment_id),
                    Amount_Paid float(10,2) NOT NULL,
                    Date DateTime,
                    payment_status varchar(255),
                    client_id int(11),
                    FOREIGN KEY(client_id)references clients(client_id)
                )";
                if(mysqli_query($con,$sql))
                {
                  echo '{--TABLE Payments created--}';
                }
                else
                {
                  echo '<<[CREATE TABLE Payments FAILED: '.mysqli_error($con).']>>';
                }
                $sql = "CREATE TABLE suppliers
                (
                  supplier_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(supplier_id),
                  supplier_no varchar(50),
                  company_name varchar(50),
                  address varchar(50),
                  line2 varchar(50),
                  line3 varchar(50),
                  line4 varchar(50),
                  post_code varchar(10),
                  contact_name varchar(50),
                  telephone varchar(11),
                  mobile varchar(11),
                  fax varchar(11),
                  email varchar(175),
                  web varchar(175)
                )";
                if(mysqli_query($db,$sql))
                {
                  echo '--Table suppliers has been created successfully--<br>';
                }
                else{
                  echo 'Table supplier not created: '.mysqli_error($db).'<br>';
                }
                $sql = "CREATE TABLE supplier_contact
                (
                  scontact_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(scontact_id),
                  supplier_id int,
                  FOREIGN KEY(supplier_id) REFERENCES suppliers(supplier_id),
                  postal_address text,
                  telephone varchar(10),
                  mobile varchar(10),
                  fax varchar(10),
                  web varchar(75),
                  email varchar(175)
                )";
                if(mysqli_query($db,$sql))
                {
                 echo '--Table supplier_contact has been created successfully--<br>';
                }
                else{
                  echo 'Table supplier_contact not created: '.mysqli_error($db).'<br>';
                }
                $sql = "CREATE TABLE supplier_agreement
                (
                  sagreement_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(sagreement_id),
                  supplier_no varchar(20),
                  deposit varchar(10),
                  liability_clause text,
                  discount varchar(10),
                  delivery_fee varchar(10),
                  start_date date,
                  end_date date,
                  warranty varchar(50)
                )";
                if(mysqli_query($db,$sql))
                {
                 echo '--Table supplier_agreement has been created successfully--<br>';
                }
                else{
                  echo 'Table supplier_agreement not created: '.mysqli_error($db).'<br>';
                }
                #temporary client account
                $sql = "CREATE TABLE tc_account
                (
                  tc_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(tc_id),
                  email varchar(175),
                  name  varchar(75),
                  surname varchar(75)
                )";
                if(mysqli_query($con, $sql))
                {
                  echo '{{tc_account Created}}<br>';
                }
                else{
                  echo '{{tc_account not created: '.mysqli_error($con).'}}<br>';
                }

                #chat
                $sql = "CREATE TABLE chat
                (
                  chat_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(chat_id),
                  client_email varchar(175),
                  employee_id varchar(20)
                ) ENGINE=InnoDB AUTO_INCREMENT=20170000 DEFAULT CHARSET=latin1";
                if(mysqli_query($con, $sql))
                {
                  echo '{{chat Created}}<br>';
                }
                else{
                  echo '{{chat not created: '.mysqli_error($con).'}}<br>';
                }
                #message table
                $sql = "CREATE TABLE message
                (
                  message_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(message_id),
                  chat_id int,
                  message_time DateTime,
                  message_from varchar(100),
                  message_to varchar(100),
                  message_body text
                ) ENGINE=InnoDB AUTO_INCREMENT=21790000 DEFAULT CHARSET=latin1";
                if(mysqli_query($con, $sql))
                {
                  echo '{{message Created}}<br>';
                }
                else{
                  echo '{{message not created: '.mysqli_error($con).'}}<br>';
                }

                #feedback
                $sql = "CREATE TABLE feedback
                (
                  feedback_id int NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(feedback_id),
                  client_email varchar(175),
                  rating decimal,
                  feedback_time DateTime
                ) ENGINE=InnoDB AUTO_INCREMENT=170000 DEFAULT CHARSET=latin1";
                if(mysqli_query($con, $sql))
                {
                  echo '{{feedback Created}}<br>';
                }
                else{
                  echo '{{feedback not created: '.mysqli_error($con).'}}<br>';
                }
                #programs
          $sql="CREATE TABLE `programs`
          (
            `id` int(5) NOT NULL,
            `program_no` varchar(11) NOT NULL,
            `program_name` varchar(50) NOT NULL,
            `description` varchar(150) NOT NULL,
            `client_no` varchar(11) DEFAULT NULL,
            `archive` tinyint(1) DEFAULT NULL
          )";

          #project
          $sql="
          CREATE TABLE `projects` (
            `id` int(5) NOT NULL,
            `project_no` varchar(11) NOT NULL,
            `program_no` varchar(11) NOT NULL,
            `project_name` varchar(50) NOT NULL,
            `description` varchar(150) NOT NULL,
            `start_date` datetime DEFAULT NULL,
            `end_date` datetime DEFAULT NULL,
            `employee_no` varchar(11) NOT NULL,
            `quotation` varchar(11) NOT NULL,
            `duration` int(3) NOT NULL,
            `duration_type` varchar(15) NOT NULL,
            `department` varchar(15) NOT NULL,
            `service` varchar(15) NOT NULL,
            `budget` double DEFAULT '0',
            `no_of_emp` int(4) NOT NULL,
            `patner` varchar(30) NOT NULL,
            `visibility` int(11) NOT NULL,
            `daily_hours` int(3) NOT NULL,
            `charge` float NOT NULL,
            `status` varchar(11) NOT NULL DEFAULT 'not stated',
            `archive` int(11) DEFAULT '0'
          )";
          #events
          $sql="CREATE TABLE `events` (
            `id` int(11) NOT NULL,
            `title` varchar(255) NOT NULL,
            `color` varchar(7) DEFAULT NULL,
            `start` datetime NOT NULL,
            `end` datetime DEFAULT NULL,
            `description` text,
            `category` varchar(100) DEFAULT NULL,
            `image` longblob
          )";
   #meetings

    $sql="CREATE TABLE `meetings` (
      `meeting_id` int(3) NOT NULL,
      `name` varchar(50) NOT NULL,
      `email` varchar(50) NOT NULL,
      `m_title` varchar(150) NOT NULL,
      `m_description` text NOT NULL,
      `color` varchar(7) NOT NULL DEFAULT 'yellow',
      `m_start` datetime NOT NULL,
      `m_end` datetime NOT NULL,
      `is_client` tinyint(4) NOT NULL,
      `is_notified` tinyint(1) NOT NULL DEFAULT '1'
    )";
    #FAQs
    $sql="CREATE TABLE `faqs` (
      `f_id` int(11) NOT NULL,
      `department_id` int(11) DEFAULT NULL,
      `question` text,
      `answer` text,
      `category` varchar(50) DEFAULT NULL,
      `name` varchar(50) NOT NULL,
      `email` varchar(50) NOT NULL
    )";
    #Expense_income
    $sql="CREATE TABLE `expense_income` (
      `id` int(5) NOT NULL,
      `ei_name` varchar(50) NOT NULL,
      `ei_type` char(1) DEFAULT NULL,
      `ei_description` varchar(300) DEFAULT NULL,
      `ei_date` datetime NOT NULL,
      `ei_payment_type` varchar(50) NOT NULL,
      `ref_no` varchar(15) DEFAULT NULL,
      `ei_amount` varchar(50) NOT NULL,
      `other` varchar(50) DEFAULT NULL,
      `supplier_no` varchar(10) DEFAULT NULL,
      `client_no` varchar(11) DEFAULT NULL,
      `project_no` varchar(11) DEFAULT NULL,
      `category_id` int(11) NOT NULL,
      `e_or_i` char(1) DEFAULT NULL,
      `file` longblob NOT NULL
    )";
    #purchase
    $sql="CREATE TABLE `purchases` (
      `item_no` int(11) NOT NULL,
      `item_code` varchar(11) NOT NULL,
      `supplier_no` varchar(10) NOT NULL,
      `purchase_date` datetime DEFAULT NULL,
      `arrival_date` date DEFAULT NULL,
      `quantity` int(11) DEFAULT NULL,
      `unit_price` double DEFAULT NULL,
      `total_price` double DEFAULT NULL,
      `item_image` longblob
    )";
    #message

?>
