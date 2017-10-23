<?php
include'../core/logic.php';
$log=new logic();
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head.php');
  include('../core/controllers/rent-controller.php');
 
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
            	<?= $feedback ?>
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
              <tr><td colspan="5" align="right"><b >Total</b></td><td align="left">R <?= number_format($totals,2,",","")?></td></tr>
            </tfoot>
           
          </table>
            <div class="row"><div class="col-xs-4 col-xs-offset-4">
              <button type="button" data-target="#rentalModal" data-toggle="modal" class="btn btn-block btn-primary" name="order">Procced</button>
          </div></div>
          </div>
        </div>
      </div>
  </div>

  <?php include('includes/footer.php'); ?>
</body>
<script>

console.log(<?=json_encode($_SESSION['rent_items'])?>);
</script>

<div class="modal fade" id="rentalModal" tabindex="-1" role="modal">
<div class="modal-dialog">
		<div class="modal-content">
		<?= $feedback ?>
		<form action="" method="post" id="renting" class="form-horizontal">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" ><i class="fa fa-check"></i>Terms Of Leasing</h4>
					</div>

					<div class="modal-body">
            <div class="form-group">
            <div class="col-xs-10 col-xs-offset-2">
           <b>PUT Option:</b> <hr/>
A right that a lessor may have to sell specified leased equipment to the lessee at a fixed price at the
end of the initial lease term.
Renewal Option:
An option to a lessee to renew the lease term for a specified rental time and period.
Residual Value:
The value of the leased equipment at the end of the lease term.
Sale Lease-Back:
An arrangement in which an equipment buyer buys equipment for the purpose of leasing it back to the
seller.
Skip Payment Lease:
A lease that contains a payment stream requiring the lessee to make payments only during certain
periods of the year. Great for seasonal construction companies.
Step Up/Down Payments:
Lease payments that change during the lease term, usually from lower payments in the beginning of
the lease to higher payments during the later part of the lease.
Tax Exempt Entity:
Generally, any local, state or federal government that is exempt from paying sales tax.
Tax Lease (Operating or True Lease):
An arrangement that qualifies for lease treatment for federal income tax purposes. Under a true lease,
the lessee may deduct rental payments and the lessor may claim the tax benefits accruing to an
equipment owner.
TRAC Lease:
A lease of motor vehicles or trailers that contains what is referred to as a Terminal Rental Adjustment
Clause (TRAC). The clause permits or requires the rent amount be adjusted based on the proceeds
the lessor receives from the sale of the leased equipment. TRAC Leases qualify as true leases.
Uniform Commercial Code (UCC):
A standardized program and method of administering, legalizing and recording lien instruments for
equipment leases.
Upgrade:
To trade in leased equipment for a newer, more advanced piece during the lease term. 
            </div>
            </div>
           
         
					</div>
    
          <div class="modal-footer">
         
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" name="Submit" id="rentButton" onclick="saveChanges()" data-loading-text="Loading..." autocomplete="off">Accept</button>
  
          </div>
        <!-- /modal-footer -->
											
				</div>
        <!-- /modal body -->
        

		</div>
		<!-- /modal-content -->
</div>
<!-- /modal-dailog -->
</div>