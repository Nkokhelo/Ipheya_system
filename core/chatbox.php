<?php
   $con = mysqli_connect('localhost','root','','ipheya');

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

?>
