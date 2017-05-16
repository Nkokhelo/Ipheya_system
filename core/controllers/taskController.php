<?php 
		$log = new Logic();
		$assign=mysqli_query($db,'select * from Employees');
		$task="";$task_error='';
		$descr="";$descr_error='';
		$dura="";$dura_error='';
		$duraType="";$duraType_error='';
		$Sdate="";$Sdate_error='';
		$Edate="";$Edate_error='';
		$Dposted=date('Y-m-d');$Dposted_error='';
		$feedback=''; 
		
		if(isset($_POST["submit"]))
		{
			if($_POST["task"]==null)
			{
				$task_err=1;
			}
			else
			{
				$task=$_POST["task"];
			}
			
			if($_POST["descr"]==null)
			{
				$descr_err=1;
			}
			else
			{
				$descr=$_POST["descr"];
			}
			
			if($_POST["duraType"]==null)
			{
				$duraType_err=1;
			}
			else
			{
				$duraType=$_POST["duraType"];
			}
			
			if($_POST["dura"]==null)
			{
				$dura_err=1;
			}
			else
			{
				$dura=$_POST["dura"];
			}

			if($_POST["Sdate"]==null)
			{
				$Sdate_err=1;
			}
			else
			{
				$Sdate=$_POST["Sdate"];
			}
			
			if($_POST["Edate"]==null)
			{
				$Edate_err=1;
			}
			else
			{
				$Edate=$_POST["Edate"];
			}
			$insert="INSERT INTO `task` (`task_id`, `Duration`, `DurationType`, `StartDate`,`EndDate`, `Description`, `DatePosted`)
					 VALUES (NULL, '$dura', '$duraType', '$Sdate', '$Edate', '$descr',NOW())";
			if(!mysqli_query($db,$insert))
		    {
				$feedback="<p class='alert alert-warning'>
								Could Not INSERT".mysqli_error($con).
							"</p>"; 
			}
			else
			{
				$feedback= "<p class='alert alert-info'>
								Data INSERTED successfully
							</p>";
			}
		}

		$freeemployees ='';
		$add = false;
		$allList=$log->getallEmployees();
		$allEmptask = $log->getallEmployeeTasks();
		while($allemployees = mysqli_fetch_assoc($allList))
		{
			while($allemptask = mysqli_fetch_assoc($allEmptask))
			{
				if()
				{
					
				}
			}
		}
		
?>