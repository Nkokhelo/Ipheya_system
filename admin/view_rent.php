<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head2.php');
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

            <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>		  
              </ol>
            </div><!-- /col-xs-6-->
             
              <div class="col-xs-11 b">
                <h2>Rental Information</h2><hr class="bhr">
            
          <table class="table"> 
            <tbody>
            <h3>Client Details</h3>
              <tr><th>Cell Number</th><td>:<?php?></td><tr/>
              <tr><th>Name       </th><td>:<?php?></td><tr/>
              <tr><th>Email      </th><td>:<?php?></td><tr/>
          
              </tbody>
              <table/>
              <table class="table"> 
              <h3>Client Details</h3>
              <tbody>
              <tr><th>Product     </th><td>:<?php?></td><tr/>
              <tr><th>Pick Up Date</th><td>:<?php?></td><tr/>
              <tr><th>Return Date </th><td>:<?php?></td><tr/>
              <tr><th>Quantity    </th><td>:<?php?></td><tr/>                      
              <tr><th>Piriod      </th><td>:<?php?></td><tr/>
              <tr><th>Total Amount</th><td>:<?php?></td><tr/>
            </tbody>
            </tr>
            <table/><hr class="bhr">
              </div>
        </div>
      </div>
 
  </div>
  
  <?php include('includes/footer.php'); ?>
  </body>
