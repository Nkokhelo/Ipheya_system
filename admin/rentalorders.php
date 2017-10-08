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
          
            <div class='col-xs-12'>
            <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="orders.php"><i class="fa fa-edit"></i> Manager Orders</a></li>
            <li class="dropdown active">
                  <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                    Rental Orders<b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="purchaseorder.php">Purchase Orders</a></li>
                    <li><a href="salesorder.php">Sales Orders</a></li>
                  </ul>
              </li>
            </ol>
          </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2>Rental Orders</h2><hr class="bhr">
                <div class="row">
                 <div class="col-xs-12">
                  <table id="rentaOrderTable" class="table table-bordered">
                   <thead>
                    <tr>
                    <th>Order No</th>
                     <th>Product</th>
                     <th>Quantity</th>
                     <th>Pick Date</th>
                     <th>Return Date</th>
                     <th>Charge</th>
                     <th>...</th>
                     </tr>
                   </thead>
                   <tbody></tbody>
                   <tfoot></tfoot>
                  </table>
                 </div>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script src="../assets/js/rentalorder.js"></script>

</body>
<script>
  $('.table').dataTable();
</script>