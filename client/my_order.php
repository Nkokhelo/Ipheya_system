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
          <div class='col-xs-6'>
            <ol class="breadcrumb">
              <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
              <li class="active"><i class="fa fa-shopping-cart"></i> My Order</li>
            </ol>
          </div><!-- /col-xs-6-->
          
          <div class="col-xs-11 b">
            <h2>My Order</h2><hr class="bhr">
            
         
          
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
totalAmount('rent_items');
console.log(<?=json_encode($_SESSION['rent_items'])?>);
</script>