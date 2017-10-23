<?php
include'../core/logic.php';
$log=new logic();
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
              <li class="active"><i class="fa fa-shopping-cart"></i>My Cart Info</li>
            </ol>
          </div><!-- /col-xs-6-->
          
          <div class="col-xs-11 b">
            <h2>Rental Infomation</h2><hr class="bhr">
            
          <table class="table">
            <thead>
              <tr>
                <th>Picture</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Charge</th>
                <th>Deposit</th>
                <th>Total Price</th>
             
              </tr>
            </thead>
            <tbody>
            <?php 
            $totals = '';
            foreach($_SESSION['rent_items'] as $rent)
             {
              $q ="SELECT p.product_image, p.product_name FROM rentals as r JOIN inventories i ON i.inventry_id = r.inventory_id JOIN product as p ON p.product_id = i.product_id WHERE r.rental_id =".$rent['rental_id'];
              $p = $log->connect()->query($q)->fetch_assoc();
              echo "<tr><td><img src='data:image/*;base64,".$p['product_image']."' style='height:60px; width:60px;'/></td><td>".$p['product_name']."</td><td>".$rent['quantity']."</td><td>".number_format($rent['totalcharge'])."</td><td>".$rent['totaldeposit']."</td><td>".$rent['totalamount']."</td></tr>";
               $totals += $rent['totalamount'];
              }?>
            </tbody>
            <tfoot>
              <tr><td colspan="6" align="right"><b >Total</b></td><td align="left">R <?= number_format($totals,2,",","")?></td></tr>
            </tfoot>
          </table>
          
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>

console.log(<?=json_encode($_SESSION['rent_items'])?>);
</script>