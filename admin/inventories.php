<?php
session_start();
if(isset($_SESSION['Employee']))
{
  
  include('../core/init.php');
  include('../core/logic.php');
  include('includes/head2.php');
  include('../core/controllers/rentals-controller.php');
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
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>		  
                <li class="active"><i class="fa fa-cubes"></i> Inventories</li>		  
              </ol>
            </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2>Inventories</h2><hr class="bhr">
                <div class="col-xs-12">
                 <table id="inventoriesTable" class="table table-bordered">
                  <thead>
                   <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                   </tr>
                  </thead>
                  <tfoot></tfoot>
                 </table>
                </div>
              </div>
            </div>
          </div>
          <?php include('includes/footer.php'); ?>
      </div>
  </div>
  
  
      <!-- Seles Modals-->
      <div class="modal fade" id="salesModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="/ipheya/core/sub/php_action/sellProduct.php" id="salesForm" method="post" class="form-horizontal">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-money"></i> Add to Sales</h4>
          </div>

          <div class="modal-body">
            <div class="removeProductMessages"></div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label class="col-xs-6" for="">Product Name :</label>
                    <div class="col-xs-8">
                      <input type="text" class="form-control" id="sproductName" disabled name="sproductName">
                      <input type="hidden" class="form-control" id="sinventoryId" name="sinventoryId">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="row"></div>
                  <div class="col-xs-6">
                    <label class="col-xs-6" for="">Quantity :</label>
                    <div class="col-xs-10">
                      <input type="text" class="form-control" id="squantity" name="quantity">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="col-xs-4">
                    <label class="col-xs-12" for="">Unit Price</label>
                    <div class="col-xs-12">
                      <input type="text" class="form-control" id="sunitPrice" name="sunitPrice">
                    </div>
                  </div>
                  <div class="col-xs-4">
                  <label class="col-xs-12" for="">Mark Up</label>
                  <div class="col-xs-12">
                    <input type="text" class="form-control" id="markUp" name="markUp">
                  </div>
                  </div>
                  <div class="col-xs-4">
                    <label class="col-xs-12" for="">Selling Price</label>
                    <div class="col-xs-12">
                      <input type="text" class="form-control" id="sellingPrice" name="sellingPrice">
                    </div>
                  </div>
                </div>
                
            </div>
            <!-- /modal body -->
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="createSaleBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
            </div>
            <!-- /modal-footer -->
            </form>

        </div>
        <!-- /modal-content -->
      </div>
      <!-- /modal-dailog -->
    </div>
    <!-- / add modal -->
    <!-- Rental Modals-->
    <div class="modal fade" id="rentalModal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <?= $feedback ?>
            <form action="/ipheya/core/sub/php_action/createRentals.php" id="rentalForm" method="POST"  class="form-horizontal">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-handshake-o"></i>" Lease settings</i></h4>
              </div>

              <div class="modal-body">
                <div id="addrentalMessage"></div>
                        <div class="form-group">
                            <div class="col-xs-12">
                              <label class="col-xs-6" for="productName">Product Name :</label>
                              <div class="col-xs-8">
                                <input disabled type="text" class="form-control" id="productName" name="productName">
                                <input type="hidden" class="form-control" id="inventoryId" name="inventoryId">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-xs-6">
                                <label class="col-xs-6" for="quantity">Quantity :</label>
                                <div class="col-xs-12">
                                  <input type="text" class="form-control" id="quantity" name="quantity">
                                </div>
                              </div>

                              <div class="col-xs-6">
                                <label class="col-xs-12" for="">Deposit per product :</label>
                                <div class="col-xs-12">
                                  <input type="text" class="form-control" id="depostiAmount" name="depostiAmount">
                                </div>
                              </div>
                          </div>
                          <div class="row" id="timelineRental">
                            <div class="col-xs-12">
                              <h4><i class="fa fa-cogs"></i> Rental Settings</h4><hr class="bhr">
                            </div>

                            <div class="form-group" id="duration1">
                              <div class="col-xs-4">
                                <label class="col-xs-12" for="">Duration :</label>
                                <div class="col-xs-12">
                                  <select type="text" class="form-control" id="timeline1" name="timeline[]">
                                    <option>--Select--</option>
                                    <?= $alltimelines ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xs-4">
                                <label class="col-xs-12" for="">Product Charge :</label>
                                <div class="col-xs-12">
                                  <input type="text" class="form-control" id="charge1" name="charge[]">
                                </div>
                              </div>
                              <div class="col-xs-4">
                                <label class="col-xs-12" for="">Penalty charge:</label>
                                <div class="col-xs-8">
                                  <input type="text" class="form-control" id="penalty1" name="penalty[]">
                                </div>
                                <div class="col-xs-1">
                                  <button type="button" id="remove1" onclick="removeI(1)" disabled class="btn btn-default"><i class="fa fa-trash-o"></i></button>
                                </div>
                              </div>
                             </div>
                        </div>
                        
                      </div>
                <!-- /modal body -->
                
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default" onclick="addRentalI()">Add Duration Rule</button>
                        <button type="submit" class="btn btn-primary" id="createRentBtn" name="Save" onclick='addTorental()' data-loading-text="Loading..." autocomplete="off">Save Changes</button>
                      </div>
                <!-- /modal-footer -->
                </form>

            </div>
            <!-- /modal-content -->
          </div>
          <!-- /modal-dailog -->
        </div>
        <!-- / add modal -->


  <script src="../assets/js/inventories.js"></script>
</body>
