<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head.php');
  // include('../core/controllers/chat-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>

            <div class="col-xs-6">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>		  
            <li class="dropdown active">
                <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
              Rental<b class=""></b>
                </a>
            </li>
            </div>
        
              <div class="col-xs-11 b">
                <h2>My Booking Notification</h2><hr class="bhr">
                <table id="rentaOrderTable" class="table table-bordered">
                <div class="container text-center">
               <div class="row">
            <div class="col-lg-12">
           
                                        <button type="button" class="btn btn-success">Proceed To Pay</button>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
