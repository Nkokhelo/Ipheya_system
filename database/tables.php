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
 /* mysqli_select_db($con,"ipheya");
#CREATE TABLE clients
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
             FOREIGN KEY(ClientID) REFERENCES clients(client_id),
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
<<<<<<< HEAD
         
        -$sql="CREATE TABLE Task
=======
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
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
         /* $sql="Create Table employeetask
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
<<<<<<< HEAD
              
=======
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
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
<<<<<<< HEAD
                }
                
                $sql="CREATE TABLE included_departments
                      (
                          request_id int(11),
                          department_id int(11),
                          primary key(request_id,department_id),
                          foreign key(request_id) references serviceRequest(RequestID),
                          foreign key(request_id) references RepairRequest(RequestID), 
                          foreign key(department_id) references departments(department_id)
                      )";
                      if(!mysqli_query($con,$sql))
                      {
                        echo "Error! ".mysqli_error($con);
                      }

#22 june----table for notifications on our system.....
                $sql ="CREATE TABLE notifications 
                    (
                      notific_id int(11) NOT NULL AUTO_INCREMENT,
                      user_email varchar(100),
                      notific_message varchar(150),
                      notific_date datetime,
                      unread int(3),
                      notific_link varchar(500),
                      primary key(notific_id),
                      foreign key(user_email) references Users(Email)
                    )";
                    if(!mysqli_query($con,$sql))
                    {
                      die("Error!".mysqli_error($con));
                    }

                    $sql ="CREATE TABLE suppliers
                          (
                              supplier_no varchar(10) NOT NULL,
                              company_name varchar(100),
                              address varchar(100),
                              line2 varchar(100),
                              line3 varchar(100),
                              line4 varchar(100),
                              post_code varchar(10),
                              contact_name varchar(150),
                              telephone varchar(13),
                              mobile varchar(15),
                              fax varchar(15),
                              web varchar(100),
                              email varchar(200),
                              primary key(supplier_no)
                          )";
                          if(!mysqli_query($con,$sql))
                          {
                            die("Error".mysqli_error($con));
                          }
                          $sql =" CREATE TABLE purchases(
                                  item_no int(11) NOT NULL,
                                  item_code varchar(11) NOT NULL,
                                  supplier_no varchar(10)NOT NULL,
                                  purchase_date datetime,
                                  quantity int,
                                  unit_price double,
                                  total_price double,
                                  item_image longblob,
                                  PRIMARY KEY(item_code),
                                  FOREIGN KEY(item_no) REFERENCES QoutationItems(QoutationItemID),
                                  FOREIGN KEY(supplier_no) REFERENCES suppliers(supplier_no)
                                  )";
                          if(!mysqli_query($con,$sql))
                          {
                            die("Error".mysqli_error($con));
                          }*/
                         
                         $sql ="CREATE TABLE programs
                         (
                            program_no varchar(11) primary key not null,
                            name varchar(50) not null,
                            description varchar(150)
                         )";
                          if(!mysqli_query($con,$sql))
                          {
                            die("Error".mysqli_error($con));
                          }

                        //   $sql ="CREATE TABLE project
                        //  (
                        //     project_no varchar(11) primary key not null,
                        //     program_no varchar(11),
                        //     name varchar(50) not null,
                        //     duration datetime not null,

                        //  )";
                        //   if(!mysqli_query($con,$sql))
                        //   {
                        //     die("Error".mysqli_error($con));
                        //   }
?>
=======
                }*/
?>
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
