<?php
        $logic = new Logic();

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
            $query = mysqli_query($db,"INSERT INTO `programs`(`program_no`,`name`,`description`) VALUES('$program_no','$name','$description')");
            if(!$query)
            {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Error occured during execution<br/>Please try again');
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Program saved succesfull');
            }
        }
    }
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
            $client_unique = uniqid();
        	$program_no ="PRG00".strtoupper(substr($client_unique,4,4));
            $query = mysqli_query($db,"UPDATE `programs` SET `name` = '$name', `description`='$description' WHERE `programs`.`id` = $id");
            if(!$query)
            {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Error occured during execution<br/>Please try again');
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Program saved succesfull');
            }
        }
    }
    if(isset($_POST['delete_program']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $id = $_POST['id'];

            $query = mysqli_query($db,"UPDATE `programs` SET `archive` = 1 WHERE `programs`.`id` = $id");
            if(!$query)
            {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Error occured during execution<br/>'.mysqli_error($db));
            }
            else
            {
                $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> Program saved succesfull');
            }
        
    }
    if(isset($_POST['save_project']))
    {
        $feedback =array('alert'=>'', 'message'=>'');
        $project_name =$_POST['project_name'];
        $project_no =$_POST['project_no'];
        $program_no =$_POST['program_no'];
        $description =$_POST['description'];
        $sdate =$_POST['sdate'];
        $edate =$_POST['edate'];
        $employee_no =$_POST['employee_no'];
        $client_no =$_POST['client_no'];

        $client_unique = uniqid();
        $program_no ="P00".strtoupper(substr($client_unique,6,4));
        $query ="INSERT INTO `projects` (`project_no`,`program_no`,`description`,`start_date`,`end_date`,`client_no`,`employee_no`)
        VALUES('$project_no','$program_no','$description','$sdate','$edate','$client_no','$employee_no')";
        $result = mysqli_query($db,$query);
        if(!$result)
        {
                $feedback =array('alert'=>'alert alert-danger', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Error!</strong>'.mysqli_error($db));
        }
        else
        {
              $feedback =array('alert'=>'alert alert-success', 'message'=>'<button type="button" class="close" style="color:red"data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> <strong>Success!</strong> Project saved !');
        }
    }

    if(isset($_GET['view']))
    {
        $p_no = $_GET['view'];
        $program ='';
        $result = $logic->getallPrograms();
        while($programs = mysqli_fetch_assoc($result)):
            if($programs['program_no']==$p_no)
            {
                $program=$programs;
            }
        endwhile;

    }

    $result = $logic->getallPrograms();
    $prog_list='';
    while($programs = mysqli_fetch_assoc($result)):
        if($programs['archive']==0)
        {
            $prog_list .= "<tr><td>".$programs['program_no']."</td><td>".$programs['name']."</td><td>5</td>
            <td aling='right'><a href='viewprogram.php?view=".$programs['program_no']."' class='btn btn-xs btn-default' class='btn btn-xs btn-default'>View <span class='glyphicon glyphicon-eye-open'></span> </a>
            <button data-toggle='modal' data-target='#addprogram' class='btn btn-xs btn-default' onclick='editprogram(".$programs['id'].")'>Edit <span class='glyphicon glyphicon-pencil' ></span> </button>
            <button data-toggle='modal' data-target='#addprogram' class='btn btn-xs btn-default' onclick='deleteprogram(".$programs['id'].")'class='btn btn-xs btn-default'>Archive <span class='glyphicon glyphicon-ban-circle'></span> </button></td></tr>  ";
        }
    endwhile;

    if($prog_list=='')
    {   
        $prog_list ="<tr>
            <td colspan='4'>
            <div class='alert alert-info'>
                <span class='glyphicon glyphicon-info-sign'></span> No program was found!
            </div></td>
        </tr>";
    }
?>