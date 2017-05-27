<?php
$log = new Logic();

#add task View 
		$assign=mysqli_query($db,'select * from Employees');
		$task="";$task_error='';
		$descr="";$descr_error='';
		$dura="";$dura_error='';
		$duraType="";$duraType_error='';
		$Sdate="";$Sdate_error='';
		$Edate="";$Edate_error='';
		$Dposted=date('Y-m-d H:i:s');$Dposted_error='';
		$feedback='';
		$removed ='';
		// $cid=$rid ='';

#find basic client info before a form can be viewed
	
  if(isset ($_GET['ri']))
     {
        $cid = $_GET['ci'];
        $rid = $_GET['ri'];
		$type = $_GET['type'];
        $clientQR = $log->getClientsById($cid);
        $client=mysqli_fetch_assoc($clientQR);
		if($type=="Service")
		{
			$req = $log->getServiceRequestById($rid);
		}
		else 
		{
			$req = $log->getMaintananceRequestById($rid);
		}
        $request=mysqli_fetch_assoc($req);
		$name =$log->getServiceNameByID($request['ServiceID']);
	 }
#Saving a task
		if(isset($_POST["submit"]))
		{
			$task=$_POST["task"];
			$descr=$_POST["descr"];
			$duraType=$_POST["duraType"];
			$dura=$_POST["dura"];
			$Sdate=$_POST["Sdate"];
			$Edate="";
			$loca =$_POST['location'];
			$sum_date = "";
			$cid = $_POST['ci'];
			$rid = $_POST['ri'];
			if($duraType=="day")
			{
				$Edate = (new DateTime($Sdate.'+'.$dura.'day'))->format('Y-m-d');
			}
			else if($duraType=="week")
			{
				$Edate = (new DateTime($Sdate.'+'.$dura.'week'))->format('Y-m-d');
			}
			else
			{
				$Edate = (new DateTime($Sdate.'+'.$dura.'month'))->format('Y-m-d');
			}
			$insert ="INSERT INTO `task` (`task_id`, `Name`, `Duration`, `DurationType`, `Location`, `StartDate`, `EndDate`, `Description`, `DatePosted`, `request_id`)
			 VALUES (NULL, '{$task}', '{$dura}', '{$duraType}', '{$loca}', '{$Sdate}', '{$Edate}', '{$descr}', '{$Dposted}', '{$rid}')";

			if(!mysqli_query($db,$insert))
		    {
				$feedback="<p class='alert alert-warning'>Error ".mysqli_error($log->connect())."</p>"; 
				$clientQR = $log->getClientsById($cid);
				$client=mysqli_fetch_assoc($clientQR);
				if($type=="Service")
				{
					$req = $log->getServiceRequestById($rid);
				}
				else 
				{
					$req = $log->getMaintananceRequestById($rid);
				}
				$request=mysqli_fetch_assoc($req);
			}
			#the reason I used this is tha header is not working...
			echo("<script>location.href='alltasks.php'</script>");
		}
#Display all task in employee Create Task Form

		$alltasklist ='';
		$alltask=$log->getallTasks();
		$tasksAll='';
		while($alltasks =mysqli_fetch_row($alltask))
		{
			$alltasklist.="<div class='col-sm-12'><input type='radio' name='task' value='".$alltasks[0]."' />".$alltasks[1]."</div>";
			$tasksAll.="
			<form action='CreateTask.php' method='GET'>
				<div class='col-sm-12 bhr' style='padding-top:10px;'>
				 	<div class='col-sm-1'>
					 	<h1>$alltasks[0]</h1>
					 </div>
				 	<div class='col-sm-6'>
					 	<b>Title</b> $alltasks[1]<br/>
						<i><h4>$alltasks[7]</h4></i>
						<b>Date</b> $alltasks[5]
					 </div> 
					 <div class='col-sm-2'>
					 	<b>Duration</b>
						 <h5>$alltasks[2] $alltasks[3]</h5>
					 </div>
					 <div class='col-sm-3'>
					 	<b> </b><br/>
						 <div class='form-group'>
						 	<div class='btn-group-vertical'>
								<a type='submit' href='AssignTask.php?assign=".$alltasks[0]."' name='assign' class='btn btn-xs btn-success ' value='$alltasks[0]'><span class='glyphicon glyphicon-plus'></span> Assign</a>
								<a type='submit' href='alltasks.php?delete=".$alltasks[0]."' name='delete' class='btn btn-xs btn-danger ' value='$alltasks[0]'><span class='glyphicon glyphicon-trash'></span> Delete</a>
							 </div>
						 </div>
					 </div>
				 </div>
				 </form>
			";
		}

#add employees to task
		if(isset($_GET['assign']))
		{
			$taskid = $_GET['assign'];
			$task_result = $log->getTaskById($taskid);
			$title = $description = $date =$duration ='';

			while($task_arr = mysqli_fetch_assoc($task_result))
			{
				$title = $task_arr['Name'];
				$description = $task_arr['Description'];
				$date = $task_arr['StartDate'];
				$duration = $task_arr['Duration']."-".$task_arr['DurationType'];
			}
#Display all free employees
			$freeemployees ='';
			$add = false;
			$allList=$log->getallEmployees();
			$allEmptask = $log->getallEmployeeTasks();
			while($allemployees = mysqli_fetch_assoc($allList))
			{
				if(mysqli_fetch_assoc($allEmptask)!='')
				{
					while($allemptask = mysqli_fetch_assoc($allEmptask))
					{
						if($allemployees['employee_id']!=$allemptask['employee_id'])
						{
							$freeemployees.="<div class='col-sm-12' id='".$allemployees['employee_id']."_".$allemployees['name']."_".$allemployees['email']."_".$log->getDepartmentNameByID($allemployees['department'])."_".$taskid."'><div class='col-sm-4' id='empname'>".$allemployees['name']."</div><div class='col-sm-4' id='email'>".$allemployees['email']."</div><div class='col-sm-4' id='department'>".$log->getDepartmentNameByID($allemployees['department'])."</div></div>";
						}
					}
				}
				else
				{
							$freeemployees.="<div class='col-sm-12' id='".$allemployees['employee_id']."_".$allemployees['name']."_".$allemployees['email']."_".$log->getDepartmentNameByID($allemployees['department'])."_".$taskid."'><div class='col-sm-4' id='empname'>".$allemployees['name']."</div><div class='col-sm-4' id='email'>".$allemployees['email']."</div><div class='col-sm-4' id='department'>".$log->getDepartmentNameByID($allemployees['department'])."</div></div>";
				}
			}
		}
#if remove employee from taks on assing use case not update use case#display all employee task
		if(isset($_GET['remove']))
		{
			$allList=$log->getEmployeeById($_GET['remove']);
			while($allemployees = mysqli_fetch_assoc($allList))
			{

				$removed .="<div class='col-sm-12' id='".$allemployees['employee_id']."_".$allemployees['name']."_".$allemployees['email']."_".$log->getDepartmentNameByID($allemployees['department'])."'><div class='col-sm-4' id='empname'>".$allemployees['name']."</div><div class='col-sm-4' id='email'>".$allemployees['email']."</div><div class='col-sm-4' id='department'>".$log->getDepartmentNameByID($allemployees['department'])."</div></div>";
			}
		}
		if(isset($_POST['saveassignment']))
		{
			$empids = $_POST['EmpId'];
			$TaskId =$_POST['Task'];
			foreach($empids as $empid)
			{
				$insertQ ="INSERT INTO employeetask VALUES($empid,$TaskId)";
				if(!mysqli_query($log->connect(),$insertQ))
				{
					die('Error');
				}
			}
			header("Location:TaskInformation.php");
		}
#view all activities
		$taskInfo ="";
		$emptask = $log->getallEmployeeTasks();
		while($arr = mysqli_fetch_row($emptask))
		{
			$taskInfo .="<tr><td>".$log->getTaskNameById($arr[1])."</td><td>".$log->getEmployeeNameById($arr[0])."</td></tr>";
		}
#Delete Task
		if(isset($_GET['delete']))
		{
			$id =$_GET['delete'];
			$remove ="DELETE  FROM task WHERE task_id ='$id'";
			if(!mysqli_query($log->connect(),$remove))
			{
				$error ="Error ".mysqli_error($log->connect());
				return $error;
			}
			
		$alltasklist ='';
		$alltask=$log->getallTasks();
		$tasksAll='';
		while($alltasks =mysqli_fetch_row($alltask))
		{
			$alltasklist.="<div class='col-sm-12'><input type='radio' name='task' value='".$alltasks[0]."' />".$alltasks[1]."</div>";
			$tasksAll.="
			<form action='CreateTask.php' method='GET'>
				<div class='col-sm-12 bhr' style='padding-top:10px;'>
				 	<div class='col-sm-1'>
					 	<h1>$alltasks[0]</h1>
					 </div>
				 	<div class='col-sm-6'>
					 	<b>Title</b> $alltasks[1]<br/>
						<i><h4>$alltasks[7]</h4></i>
						<b>Date</b> $alltasks[5]
					 </div> 
					 <div class='col-sm-2'>
					 	<b>Duration</b>
						 <h5>$alltasks[2] $alltasks[3]</h5>
					 </div>
					 <div class='col-sm-3'>
					 	<b> </b><br/>
						 <div class='form-group'>
						 	<div class='btn-group-vertical'>
								<a type='submit' href='AssignTask.php?assign=".$alltasks[0]."' name='assign' class='btn btn-xs btn-success ' value='$alltasks[0]'><span class='glyphicon glyphicon-plus'></span> Assign</a>
								<a type='submit' href='alltasks.php?delete=".$alltasks[0]."' name='delete' class='btn btn-xs btn-danger ' value='$alltasks[0]'><span class='glyphicon glyphicon-trash'></span> Delete</a>
							 </div>
						 </div>
					 </div>
				 </div>
				 </form>
			";
		}
		}

?>