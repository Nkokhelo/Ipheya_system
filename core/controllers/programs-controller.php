<?php
#21401824 Me Zenzile
        $logic = new Logic();
#save
    if(isset($_POST['save_program']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $name =$_POST['program_name'];
        $description =$_POST['description'];
        if(($name ||$description)=='')
        {
            $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-alert"></span> Please fill up all forms');
        }
        else
        {
            $client_unique = uniqid();
        	$program_no ="PRG00".strtoupper(substr($client_unique,4,4));
            $query = mysqli_query($db,"INSERT INTO `programs`(`program_no`,`program_name`,`description`) VALUES('$program_no','$name','$description')");
            if(!$query)
            {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Error :</strong> occured during execution<br/>Please try again'.mysqli_error($db));
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Program saved succesfull');
            }
        }
    }

#update
    if(isset($_POST['update_program']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $id = $_POST['id'];
        $name =$_POST['program_name'];
        $description =$_POST['description'];
        if(($name ||$description)=='')
        {
            $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-alert"></span> Please fill up all forms');
        }
        else
        {
            $query = mysqli_query($db,"UPDATE `programs` SET `program_name` = '$name', `description`='$description' WHERE `programs`.`id` = $id");
            if(!$query)
            {
                
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Success :</strong> occured during execution<br/>Please try again'.mysqli_error($db));
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Program saved succesfull');
            }
        }
    }
#delete
    if(isset($_POST['delete_program']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $id = $_POST['id'];
        $name = $_POST['delete_name'];
            $query = mysqli_query($db,"UPDATE `programs` SET `archive` = 1 WHERE `programs`.`id` = $id");
            if(!$query)
            {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Success :</strong> occured during execution<br/>'.mysqli_error($db));
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-ok"></span>Success :</strong> has been achived!<a href="programs.php?archived=arch">View Archived Programs?</a>');
            }
    }
#save Project
    if(isset($_POST['save_project']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $project_name =$_POST['project_name'];
        $program_no =$_POST['program_no'];
        $description =$_POST['description'];
        $sdate =$_POST['sdate'];
        $edate =$_POST['edate'];
        $employee_no =$_POST['employee_no'];
        $client_no =$_POST['client_no'];

        $client_unique = uniqid();
        $project_no ="P00".strtoupper(substr($client_unique,6,4));

        $query ="INSERT INTO `projects` (`id`, `project_no`, `program_no`, `project_name`, `description`, `start_date`, `end_date`, `employee_no`, `client_no`)
        VALUES(NULL,'$project_no','$program_no','$project_name','$description','$sdate','$edate','$employee_no','$client_no')";
    $result = mysqli_query($db,$query);
        if(!$result)
        {
                die($query);
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Error!</strong>'.mysqli_error($db));
        }
        else
        {
              $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong> Project saved !');
        }
    }
#view program
    if(isset($_GET['view']))
    {
        $p_no = $_GET['view'];
        $feedback = array('alert'=>'','message'=>'');
        $program ='';
        $get_project = '';
        $pi=0;
        $presult = $logic->getallProjets();
        $program = $logic->getProgramByNo($p_no);
        while($projects = mysqli_fetch_assoc($presult))
        {
            if($projects['program_no']==$p_no)
            {
                $no = $projects['project_no'];
                $get_project .="<li><a href='viewproject.php?pview=$no&prog=".$_GET['view']."'><b>".$projects['project_name']."</b></a></li>";
                $pi++;
            }
        }
        // $get_project =rtrim($get_project,', ');
        if($get_project =='')
        {
            $pi=0;
            $feedback =array('alert'=>'alert alert-info', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-alert"></span> Info :</strong> No project under this program <a class="alert-link" data-toggle="modal" data-target="#addproject" onclick="">Create new project?</a>');
        }
        //TODO: Here You should allow a user to enter a client No of employee no 
    }

#view project
    if(isset($_GET['pview']))
    {
        $project_no = $_GET['pview'];
        $p_expenses ='';
        $p_income='';
        $viewproject ='';
        $employee='';
        $client ='';
        $proj ='';
        $query = "SELECT SUM(ei_amount) as amount FROM expense_income WHERE e_or_i ='i' AND project_no='".$project_no."'";
        $p_income = mysqli_fetch_assoc(mysqli_query($logic->connect(),$query))['amount'];
        if($p_income==null)
        {
            $p_income=0;
        }
        $query = "SELECT SUM(ei_amount) as amount FROM expense_income WHERE e_or_i ='e' AND project_no='".$project_no."'";
        $p_expenses = mysqli_fetch_assoc(mysqli_query($logic->connect(),$query))['amount'];
        if($p_expenses==null)
        {
            $p_expenses=0;
        }
        $viewproject = $logic->getProjectByNo($_GET['pview']);//get project data from a a database
        $employee= $logic->getEmployeeByEmpNo($viewproject['employee_no']);//get employee information from a database
        $client = $logic ->getClientByNo($logic->getProgramByNo($viewproject['program_no'])['client_no']);// get client information from a database       
        $related_proj = $logic->getRelatedProject($_GET['pview']);
        //get related Projects
        while($all = mysqli_fetch_assoc($related_proj))
        {
            if($all['project_no']!= $_GET['pview'])
            {
                $proj .="<li><a href='viewproject.php?pview=".$all['project_no']."'><b>".$all['project_name']."</b></a></li>"; 
            }
            
        }

        $tasks_no = mysqli_fetch_row($logic->countTasks($_GET['pview']))[0];
        while($all = mysqli_fetch_assoc($related_proj))
        {
            if($all['project_no']!= $_GET['pview'])
            {
                $proj .="<li><a href='viewproject.php?pview=".$all['project_no']."'><b>".$all['project_name']."</b></a></li>"; 
                
            }
        }

    }

#getallprograms
    $result = $logic->getallPrograms();
    $presult = $logic->getallProjets();
    $prog_list='';
    if(!$result)
    {
        die(mysqli_error($db));
    }
    while($programs = mysqli_fetch_assoc($result)):
        if($programs['archive']==0)
        {
            $prog_list .= "<tr><td>".$programs['program_no']."</td><td>".$programs['program_name']."</td><td>".$logic->numOfProject($programs['program_no'])."</td>
            <td aling='right'><a href='viewprogram.php?view=".$programs['program_no']."' class='btn btn-xs btn-default' class='btn btn-xs btn-default'>View <span class='glyphicon glyphicon-eye-open'></span> </a>
            <button data-toggle='modal' data-target='#addprogram' class='btn btn-xs btn-default' onclick='editprogram(".$programs['id'].")'>Edit <span class='glyphicon glyphicon-pencil' ></span> </button>
            <button data-toggle='modal' data-target='#addprogram' class='btn btn-xs btn-default' onclick='deleteprogram(".$programs['id'].")'class='btn btn-xs btn-default'>Archive <span class='glyphicon glyphicon-ban-circle'></span> </button></td></tr>  ";
        }
    endwhile;
    
    if(isset($_GET['archived']))
    {
        $prog_list='';
        $result = $logic->getallPrograms();
        while($programs = mysqli_fetch_assoc($result)):
            if($programs['archive']==1)
            {
                $prog_list .= "<tr><td>".$programs['program_no']."</td><td>".$programs['program_name']."</td><td>".$logic->numOfProject($programs['program_no'])."</td>
                <td aling='right'><a href='viewprogram.php?view=".$programs['program_no']."' class='btn btn-xs btn-default' class='btn btn-xs btn-default'>View <span class='glyphicon glyphicon-eye-open'></span> </a>
                <a class='btn btn-xs btn-default' href='programs.php?restore=".$programs['program_no']."'>Restore <span class='glyphicon glyphicon-refresh'></span></a> </td></tr>  ";
            }
        endwhile;
    }
    if(isset($_GET['restore']))
    {
        $prog_no =$_GET['restore'];
        $query = mysqli_query($db,"UPDATE `programs` SET `archive` = 0 WHERE `programs`.`program_no` ='$prog_no'");
        // die("UPDATE `programs` SET `archive` = 0 WHERE `programs`.`program_no` =$prog_no");
        if(!$query)
        {
            $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-warning-sign"></span>Error :</strong> occured during execution<br/>'.mysqli_error($db));
        }
        else
        {
            $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><strong><span class="glyphicon glyphicon-ok"></span>Success :</strong>Program has been Unachived! <a href="programs.php">View Programs?</a>');
        }
    }
    if($prog_list=='')
    {   
        $prog_list ="<tr>
            <td colspan='4'>
            <div class='alert alert-info'>
                <strong><span class='glyphicon glyphicon-info-sign'></span> Info :</strong> No program was found!
            </div></td>
        </tr>";
    }
?>