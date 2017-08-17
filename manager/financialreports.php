<?php

	session_start();
    if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
		include('includes/head.php');
		// include('includes/navigation.php');
		// include('includes/employee-session.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>

<body>
 <div class="wrapper">
  <?php include 'includes/sidebar.php'?>
  <div id='content'>
    <div class='row'>
      <div class="col-xs-10 b">
          <h2 class="text-center">Financial Reports</h2><hr class="bhr"/>
      </div>  
    </div>
  </div>
 </div>
 <?php include('includes/footer.php'); ?>
 <script>
   $(document).ready(function(){
     
   });
 </script>
</body>