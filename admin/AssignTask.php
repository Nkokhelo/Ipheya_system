<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
     include('includes/employee-session.php');
?>

<div class="col-sm-12">
    <div class="col-sm-6 b">
        <h2>Assign Task to employee</h2>
        <form method="POST" action="AssignTask.php">
            <div class="col-sm-12" style="padding-bottom:15px;">
                <hr class="bhr"/>
                Employee Id <input type="text" name="empID" id="empID" required/><br/>
                Task Id <input type="text" name="taskID" id="taskID" required/><br/>
                <hr class="bhr"/>
                <input type="submit" class="btn btn-default" name="submit" value="assign"/>
            </div>
        </form>
    </div>
    <div class="col-sm-6 shift b">
        <h2>Free Employee</h2>
        <hr class="bhr"/>
        <?$allEmployees?>
    </div>
</div>