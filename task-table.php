 <?php
   
 	
 		$con=mysqli_connect("localhost","root","");
 		
 		if(!$con)
 		{
			die("Connection Failed".mysqli_error($con));
		}

 		$createDatabase ="CREATE DATABASE kethiwe";

		$crate= mysqli_query($con,$createDatabase);

 		$con=mysqli_connect("localhost","root","","kethiwe");

 	 	$sql="CREATE TABLE Task
		(task_id int(11) NOT NULL AUTO_INCREMENT,
		 PRIMARY KEY (task_id),
		 Name varchar(30),
		 Duration varchar(30),
		 DurationType varchar(15),
		 Location Text;
		 StartDate Date,
		 EndDate Date,
		 Description Text,
		 DatePosted DateTime)";
		 if(!mysqli_query($con,$sql))
		 {
			echo "Error Creating Table".mysqli_error($con);
		 }
		 else
		 {
			echo "Table Task Created Successfully";
	   	 }


	   	 $sql="Create Table employeetask(employee_id int(11) NOT NULL,
			 task_id int(11) NOT NULL,
			 PRIMARY KEY(employee_id,task_id),
			 FOREIGN KEY(task_id) references Task(task_id),
			 FOREIGN KEY(employee_id) references employees(employee_id) )";
			 
			 if(!mysqli_query($con,$sql))
			 {
				echo "Error Creating table".mysqli_error($con);
			 }
			else
			{
				echo "Table taskEmployee Created Successfully";
			}
	   	 mysqli_close($con);
 
 
 ?>