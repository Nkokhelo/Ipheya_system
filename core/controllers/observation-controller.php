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
		$table ='';
		$client ='';
		// $cid=$rid ='';
#find basic client info before a form can be viewed
  if(isset ($_GET['ri']))
     {
        $cid = $_GET['ci'];
        $rid = $_GET['ri'];
				$type = $_GET['type'];
        $clientQR = $log->getClientsById($cid);
				$client=mysqli_fetch_assoc($clientQR);
				$allList=$log->getallEmployees();
				$allemp ='';
				while($empl = mysqli_fetch_assoc($allList))
				{
					$allemp.="<option value='".$empl['employee_id']."'>".$empl['name']."</option>";
				}
				if($type=="Service")
				{
					$req = $log->getServiceRequestById($rid);
					$table ='servicerequest';
				}
				else
				{
					$req = $log->getMaintananceRequestById($rid);
					$table ='maintenancerequest';

				}
				$request=mysqli_fetch_assoc($req);
				$name =$log->getServiceNameByID($request['ServiceID']);
			}
			#Saving a task
			if(isset($_POST["submit"]))
			{
						$task=$_POST["task"];
						$duraType=$_POST["duraType"];
						$dura=$_POST["dura"];
						$Sdate=$_POST["Sdate"];
						$emp_id = $_POST['employee'];
						$Edate="";
						$phase=0;
						$loca =$_POST['location'];
						$sum_date = "";
						$cid = $_POST['ci'];
						$rid = $_POST['ri'];
						$descr = mysqli_real_escape_string($db, $_POST["descr"]);
						$descr = sanitize($descr);
						#this are the calculations of the end date... "HINT: You can add them by week or day or months"...
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
						$insert ="INSERT INTO `observation_task` (`task_id`, `t_name`, `duration`, `d_type`, `location`, `s_date`, `e_date`, `description`, `date_posted`, `request_id`,`r_type`, `complete`, `status`,`employee_id`)
						VALUES (NULL, '{$task}', '{$dura}', '{$duraType}', '{$loca}', '{$Sdate}', '{$Edate}', '{$descr}', '{$Dposted}', '{$rid}','{$type}',0,'created',{$emp_id})";
						if(!mysqli_query($db,$insert))
					   {
											die($insert);
											$feedback=$log->display_error("Error".mysqli_error($log->connect()));
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
								else
								{
									$log->notify('Admin',$client['email'],'Obsever has been sent for '.$name.' request' ,'/ipheya/client/history.php');
									$log->updateStatus('observation',$rid,$table);
								}

				header("Location:allobsevartions.php");
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
			$isequal=false;
			while($allemployees = mysqli_fetch_assoc($allList))
			{
				if(!$log->isEmployeeAssigned($allemployees['employee_id']))
				{   #TODO this code is unfinished all you have to do is check employees by date or do date calculations!!
					$freeemployees.="<div class='col-sm-12' id='".$allemployees['employee_id']."_".$allemployees['name']."_".$allemployees['email']."_".$log->getDepartmentNameByID($allemployees['department'])."_".$taskid."'><div class='col-sm-4' id='empname'>".$allemployees['name']."</div><div class='col-sm-4' id='email'>".$allemployees['email']."</div><div class='col-sm-4' id='department'>".$log->getDepartmentNameByID($allemployees['department'])."</div></div>";;
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
			$error="";
			$errort="";
			foreach($empids as $empid)
			{
				#check if this association exist
				$select = "SELECT * FROM employeetask WHERE task_id = $TaskId AND employee_id = $empid";
				$task_empl =mysqli_query($db,$select);
				$task_empl = mysqli_fetch_row($task_empl);
				if(count($task_empl)>0)
				{

					$errort.="<div class='alert alert-danger alert-dismissable' style='opacity:1;'>  <a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>Unable to assign ".$log->getEmployeeNameById($empid)." in the same task more than once!</div>";
				}
				else
				{
					$insertQ ="INSERT INTO employeetask VALUES($empid,$TaskId)";
					if(!mysqli_query($db,$insertQ))
					{
						$errort.=$log->getEmployeeNameById($empid)." Database error";
					}
					else
					{
						$Success.="<div class='alert alert-danger alert-dismissable' style='opacity:1;'>  <a  class='close' data-dismiss='alert' aria-label='close'>&times;</a>Unable to assign ".$log->getEmployeeNameById($empid)." in the same task more than once!</div>";
					}
				}
			}
			if($errort=="")
			{
				header("Location:TaskInformation.php");
			}

			else
			{
				$error=$errort;
				header("Location:AssignTask.php?assign=".$TaskId);
			}
		}
#view all activities
		$taskInfo ="";
		$emptask = $log->getallTasks();

		while($arr = mysqli_fetch_row($emptask))
		{
			#TODO>@FIXIT you have an error here it should show only one task and the number of emlpoyees within that task!!!
			$task = mysqli_fetch_row($log->getTaskById($arr[1]));
			$taskInfo .="<tr><td>".$arr[1]."</td>
							 <td>".$log->no_ofEmployees($arr[0])."</td>
							 <td>".$arr[2]." ".$arr[3]."</td>
							 <td>".(new Datetime($task[5]))->format("d M")." to ". (new DateTime($task[6]))->format("d M Y") ."</td>
							 <td><a href='../'><span class='glyphicon glyphicon-open-file'></span> View </a> || <a href='../'><span class='glyphicon glyphicon-edit'></span> Edit </a></td>
							 </tr>";

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
