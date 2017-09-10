<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require('../core/controllers/task-controller.php');
    }
    else
    {
        header('Location: ../login.php');
    }
    //  include('includes/navigation.php');
?>

 <body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class="col-md-10 col-sm-offset-2 b " id='task' style="margin-bottom:10px padding-bottom:10px; height:510px; overflow-x:hidden;">
							<h2>All Task</h2> <hr class="bhr"/>
							<div class="col-md-12" style='overflow-y:scroll;width:105%; height:290px'>
								<div class="col-md-12">
									<?=$feedback?>
									<?=$tasksAll?>
								</div>
							</div>
					</div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<!--Task List-->


<script>

</script>
