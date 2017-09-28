<?php
	session_start();
  if(isset($_SESSION['Employee']))
	{
		require_once('../core/init.php');
		include('../core/logic.php');
		include('includes/head.php');
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
      <div class="col-xs-11 b">
          <h2 class="text-center">Financial Reports</h2><hr class="bhr"/>
          <div class="col-xs-12">
            <canvas id="lineView"></canvas>
          </div> <br/>
          <hr class="bhr"/>
          <div class="col-xs-12">
            <a class="col-xs-4 text-center" href='allexpence.php'>Expense List</a>
            <a class="col-xs-4 text-center" href='allincome.php'>Income List</a>
          </div>

      </div>  
    </div>
    <?php include('includes/footer.php'); ?>
  </div>
 </div>
 <script src="../assets/chartjs/Chart.js"></script>
 <script src="../assets/chartjs/customjs/expenseline.js"></script>
</body>