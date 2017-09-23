<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');
  include('includes/head2.php');
  include('../core/controllers/order-controller.php');
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
                <ol class="breadcrumb">
                  <li><a href="dashboard.php">Home</a></li>
                  <li class="dropdown active">
                      <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                      Manage Orders<b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a href="purchaseorder.php">Purchase Orders</a></li>
                          <li><a href="salesorder.php">Sales Orders</a></li>
                      </ul>
                  </li>
                </ol>
              </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2>Manage Orders</h2><hr class="bhr">
                <div class="col-xs-12">

                </div>
            </div>
        </div>
      </div>
  </div>

  <?php include('includes/footer.php'); ?>
</body>
<script>
  $('#supplier').select2();
</script>