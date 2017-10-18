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
              <li class="active"><i class="fa fa-shopping-cart"></i>My Cart Info</li>
            </ol>
          </div><!-- /col-xs-6-->
          
          <div class="col-xs-11 b">
            <h2>Cart Infomation</h2><hr class="bhr">
            
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
            foreach($_SESSION['rent_items'] as $rent)
             {
              echo "<tr><td>null</td><td>Name</td><td>".$rent['quantity']."</td><td>".number_format($rent['totalcharge'])."</td><td>".$rent['totaldeposit']."</td><td>".$rent['totalamount']."</td></tr>";
             }?>
            </tbody>
            <tfoot>
              <tr><td colspan="6" align="right"><b >Total</b></td><td align="left">R <?= number_format($rent['totalamount']+$rent['totalamount'],2,",","")?></td></tr>
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