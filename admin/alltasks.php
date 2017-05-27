<?php 
 	require_once('../core/init.php');
     include('../core/logic.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require('../core/controllers/taskController.php');
?>

 
<!--Task List-->

	<div class="col-md-8 col-sm-offset-2 b " id='task' style="margin-bottom:10px padding-bottom:10px; height:510px; overflow-x:hidden;">
			<h2>All Task</h2> <hr class="bhr"/>
			<div class="col-md-12" style='overflow-y:scroll;width:105%; height:290px'>
				<div class="col-md-12">
				 <?=$feedback?>
				 <?=$tasksAll?>
				</div>
			</div>
	</div>
<script>
    
</script>
