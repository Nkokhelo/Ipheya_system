<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
?>

<div class="col-sm-12">
    <div class="col-sm-8 col-sm-offset-2 b">
        <h2>Assigned Task</h2><button class="btn btn-outline-info" id="viewCalenda" /><span class="glyphicon glyphicon-calendar"></span> View Task in calenda</button><hr class="bhr"/>
        <table class="table">
            <thead>
                <th>Task Name</th> 
                <th>Employee Name</th>
            </thead>
            <tbody>
                <?=$taskInfo?>
            </tbody>
        </table>
    </div>
</div>