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
          <h2 class="text-center">Project Reports</h2><hr class="bhr"/>
          <div class="col-xs-12">
          <div class="col-xs-8">
            <h3>Income vs expenses</h3>
            <canvas id="lineView"></canvas>
          </div>
          <hr>
            <div class="col-xs-6">
                <h3>Project tha have made income in 2017</h3>
              <canvas id="incomespie"></canvas>
            </div>
            <div class="col-xs-6">
                <h3>Projects that have made expense in 2017</h3>
              <canvas id="expensespie"></canvas>
            </div>
            <div class="col-xs-8">
                <h3>Project budget</h3>
              <canvas id="budgetpie"></canvas>
            </div>
            <div class="col-xs-8">
              <h3>Most requested service</h3>
              <canvas id="servicespie"></canvas>
            </div>
          </div> 
          <!-- <div class="col-xs-6">
            <canvas id="barView"></canvas>
          </div> <br/> -->
          <hr class="bhr"/>
          <div class="col-xs-12">
            <a class="col-xs-4 text-center" href='allexpence.php'>All projects</a>
          </div>

      </div>  
    </div>
    <?php include('includes/footer.php'); ?>
  </div>
 </div>
 <script src="../assets/chartjs/Chart.js"></script>
 <script src="../assets/chartjs/customjs/expenseline.js"></script>
</body>