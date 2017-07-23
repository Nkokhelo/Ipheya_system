<?php 
    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        include('includes/navigation.php');
        require('../core/controllers/taskController.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>

<div class="col-sm-12">
    <div class="col-sm-8 col-sm-offset-2 b" style="padding-bottom:20px;">
        <h2>Assigned Task</h2><hr class="bhr"/>
        <table class="table">
            <thead>
                <th>Title</th> 
                <th>Employees</th>
                <th>Duration</th>
                <th>Start Date-End Date</th>
            </thead>
            <tbody>
                <?=$taskInfo?>
               
            </tbody>
        </table>
        <hr class='bhr'/>
        <div class="col-sm-12" style="text-align:center;">
            <button class="btn btn-default" id="viewCalenda" ><span class="glyphicon glyphicon-calendar"></span> Calenda View</button>
        </div>
    </div>
</div>