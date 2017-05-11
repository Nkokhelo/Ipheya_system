<?php

 $con = mysqli_connect('localhost','root','','ipheya');

 if($con->connect_error)
 {
     die("Connection failed: ". $con->connect_error);
 }

 $sql="Create DataBase mytickt";
 if($con->query($sql)===TRUE)
 {
     echo "Database created successfully";
 }
 else{
     echo "Error creating database:".$con->error;
 }
 $sql ="Create Table Ticket
 (
 Id int(6) unsigned auto_increment primary key,
 Subject varchar(50) not null,
 RequestType varchar(30) not null,
 ProblemDescription text not null,
 DatePlaced datetime
 )";

 if($con->query($sql)===TRUE)
 {
    echo "Table Ticket was created successfully";
 }
 else{
     echo "Error creating table ".$con->error;
 }
 
$sql = "INSERT INTO Ticket(Subject,RequestType,ProblemDescription,DatePlaced) 
               VALUES('{$sub}','{$req}',{$desc},NOW())";

       
       if($con->query($sql)===TRUE)
       {
           echo "New records created successfully";
       }
       else{
           echo "Error:".$sql."<br>" . $con->error;
       }


       $sql="Select Id, Subject, RequestType, ProblemDescription From Ticket";
       $Output=mysqli_query($con, $sql);

       if(mysqli_num_rows($Output)>0)
       {
           while($row=mysqli_fetch_assoc($Output))
           {
               echo "Id:".$row["Id"]."<br>". "Subject:". $row["Subject"]."<br>".
               "Type of Request:".$row["RequestType"]."<br>"."Problem Description:".$row["ProblemDescription"];
           }
       }
       else{
           echo "0 output";
       }

    //    $ql="Delete from Ticket where Id>0";
    //    if($con->query($sql)===TRUE)
    //    {
    //        echo "Record deleted";
    //    }
    //    else{
    //        echo "Error deleting record:".$con->error;
    //    }
 $con->close();
?>