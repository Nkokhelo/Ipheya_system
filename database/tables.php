<?php error_reporting(0);
   $con = mysqli_connect('localhost','root','');
   if(!$con){
     echo '<<[Connection failed'.mysql_connect_errno().']>>';
   }
   else{
     echo '{--Connected--}';
   }
   #select database
   mysqli_select_db($con,"ipheya");
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
   if(mysqli_query($con,$sql)){
     echo '{--TABLE clients created--}';
   }
   else{
     echo '<<[CREATE clients FAILED: '.mysqli_error($con).']>>';
   }

   #CREATE TABLE company_roles
   $sql = "CREATE TABLE company_roles
           (
             company_role_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(company_role_id),
             company_role varchar(100)
           )";
   if(mysqli_query($con,$sql)){
     echo '{--TABLE company_roles created--}';
   }
   else{
     echo '<<[CREATE company_roles FAILED: '.mysqli_error($con).']>>';
   }

   #CREATE TABLE departments
   $sql = "CREATE TABLE departments
           (
             department_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(department_id),
             department varchar(100),
             email varchar(100)
           )";
   if(mysqli_query($con,$sql)){
     echo '{--TABLE departments created--}';
   }
   else{
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
   if(mysqli_query($con,$sql)){
     echo '{--TABLE employees created--}';
   }
   else{
     echo '<<[CREATE employees FAILED: '.mysqli_error($con).']>>';
   }

   #CREATE TABLE roles
   $sql = "CREATE TABLE roles
           (
             role_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(role_id),
             employee_id int,
             FOREIGN KEY(employee_id) REFERENCES employees(employee_id),
             email varchar(175),
             role varchar(100)
           )";
   if(mysqli_query($con,$sql)){
     echo '{--TABLE roles created--}';
   }
   else{
     echo '<<[CREATE roles FAILED: '.mysqli_error($con).']>>';
   }

   #CREATE TABLE general_requests
   $sql = "CREATE TABLE general_requests
           (
             gr_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(gr_id),
             user_id varchar(100),
             FOREIGN KEY(user_id) REFERENCES clients(email),
             service varchar(100),
             description text,
             request_date date,
             request_status int,
             duration varchar(100),
             warranty varchar(100),
             due_date date
           )";
    if(mysqli_query($con,$sql)){
      echo '{--TABLE general_services created--}';
    }
    else{
      echo '<<[CREATE TABLE general_services FAILED: '.mysqli_error($con).']>>';
    }

    #CREATE TABLE maintenance
    $sql = "CREATE TABLE maintenance
           (
             mr_id int NOT NULL AUTO_INCREMENT,
             PRIMARY KEY(mr_id),
             user_id varchar(100),
             FOREIGN KEY(user_id) REFERENCES clients(email),
             maintenance varchar(100),
             description text,
             request_date date,
             request_status int,
             maintenance_frequency varchar(50),
             maintenance_period varchar(50),
             end_date date
           )";
    if(mysqli_query($con,$sql)){
       echo '{--TABLE maintenance created--}';
     }
     else{
       echo '<<[CREATE TABLE maintenance FAILED: '.mysqli_error($con).']>>';
     }

     #CREATE TABLE technical_observation
     $sql = "CREATE TABLE technical_observation
            (
              tr_id int NOT NULL AUTO_INCREMENT,
              PRIMARY KEY(tr_id),
              user_id varchar(100),
              FOREIGN KEY(user_id) REFERENCES clients(email),
              observation varchar(100),
              description text,
              request_date date,
              request_status int,
              physical_address text
            )";
      if(mysqli_query($con,$sql)){
        echo '{--TABLE general_services created--}';
      }
      else{
        echo '<<[CREATE TABLE general_services FAILED: '.mysqli_error($con).']>>';
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
      if(mysqli_query($con,$sql)){
        echo '{--TABLE targets created--}';
      }
      else{
        echo '<<[CREATE TABLE targets FAILED: '.mysqli_error($con).']>>';
      }
      #CREATE TABLE targets
      $sql = "CREATE TABLE target_clients
             (
               target_id int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(target_id),
               client_id int,
               FOREIGN KEY(client_id) REFERENCES clients(client_id),
               address varchar(50)
             )";
       if(mysqli_query($con,$sql)){
         echo '{--TABLE target_clients created--}';
       }
       else{
         echo '<<[CREATE TABLE target_clients FAILED: '.mysqli_error($con).']>>';
       }
      #CREATE TABLE services
      $sql = "CREATE TABLE services
             (
               service_id int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(service_id),
               service varchar(100),
               min_duration varchar(50),
               description text,
               department int,
               FOREIGN KEY(department) REFERENCES departments(department_id)
             )";
       if(mysqli_query($con,$sql)){
         echo '{--TABLE services created--}';
       }
       else{
         echo '<<[CREATE TABLE services FAILED: '.mysqli_error($con).']>>';
       }
      mysqli_close($con);
?>
