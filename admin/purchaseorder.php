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
<script src="../assets/plugins/moment/moment.min.js"></script>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
               <div class="col-xs-6">
                <ol class="breadcrumb">
                  <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="orders.php"><i class="fa fa-edit"></i> Manager Orders</a></li>
                  <li class="dropdown active">
                      <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                      Purchase Orders<b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a href="rentalorders.php">Rental Orders</a></li>
                          <li><a href="salesorder.php">Sales Orders</a></li>
                      </ul>
                  </li>

                </ol>
              </div><!-- /col-xs-6-->
     

              <div class="col-xs-11 b"> 
                <h2>Manage Orders</h2><hr class="bhr">
                <div class="col-xs-12">
                  <div class="col col-xs-12 success-messages"></div>
                  <form class="form-horizontal" method="POST" action="/ipheya/core/sub/php_action/createOrder.php" id="createOrderForm"> 
   
                  <div class="col-xs-1">
                    <h1><span class="fa fa-user-circle-o"></span></h1>
                  </div>
                  <div class="form-group col-xs-4">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" onchange="getSupplier()" class="form-control" id="supplier" required>
                      <option>--Select Supplier--</option>
                      <?= $option ?>
                    </select>
                  </div>

                  <div class="form-group col-xs-4 col-xs-push-1">
                    <label for="expected_date">Expected Date</label>
                    <input type="text" class="form-control" id="expected_date" name="expected_date"/>
                 </div>

                </div>

                <div class="col-xs-12" id="review">

                  <div class="form-group col-xs-6 col-xs-push-1">
                    <label for="email">Email : </label><i id="sup_email"></i><br/>
                    <label for="contat">Contact : </label> <i id="sup_number"></i><br>
                    <label for="address">Address : </label><i id="sup_address">  </i><br>
                    <label for="address">website : </label><a id="weblink" href=""><i id="sup_web">  </i></a><br>
                  </div>
                  
                  <hr style="width:100%"/>
                    
                        <table class="table" id="productTable">
                          <thead>
                            <tr>			  			
                              <th style="width:40%;">Product</th>
                              <th style="width:20%;">Unit Price</th>
                              <th style="width:15%;">Quantity</th>			  			
                              <th style="width:15%;">TotalPrice</th>			  			
                              <th style="width:10%;"></th>
                            </tr>
                          </thead>
                          <tbody>

                             
                            <?php
                            $arrayNumber = 0;
                            for($x = 1; $x < 4; $x++) { ?>
                              <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">	
                              
                              
                                <td style="margin-left:20px;">
                                  <div class="form-group">
                                  <select class="form-control " name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                                    <option value="">~~SELECT~~</option>
                                    <?php
                                      $productSql = "SELECT * FROM product WHERE active = 1 AND status = 1";
                                      $productData = $connect->query($productSql);

                                      while($row = $productData->fetch_array()) {									 		
                                        echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
                                      } // /while 

                                    ?>
                                  </select>
                                  <script>
                                    $('#productName<?php echo $x; ?>').select2();
                                  </script>
                                  </div>
                                </td>

                                <td style="padding-left:20px;">			  					
                                  <input type="number" step="0.01" title="Invalid unit price was insertered" onkeyup="getTotal(<?=$x?>)" name="unitprice[]" id="unitprice<?php echo $x; ?>" autocomplete="off"  class="form-control " />
                                  <!-- <input type="hidden" name="unitpriceValue[]" id="unitpriceValue<?php echo $x; ?>" autocomplete="off" class="form-control" /> -->
                                </td>


                                <td style="padding-left:20px;">
                                  <div class="form-group">
                                  <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control " min="1" />
                                  </div>
                                </td>


                                <td style="padding-left:20px;">			  					
                                  <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control " disabled="true" />			  					
                                  <input  type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control " />			  				
                                </td>
                                <td>

                                  <button class="btn btn-sm btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                              </tr>
                            <?php
                            $arrayNumber++;
                            } // /for
                            ?>


                          </tbody>			  	
                        </table>
                            <hr style="width:100%"/>
                        <div class="col-xs-4">

                          <div class="form-group col-xs-12">
                            <label for="subTotal">Sub Amount</label>
                              <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                              <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                          </div> <!--/form-group-->

                          <div class="form-group col-xs-12">
                            <label for="vat">VAT 14%</label>
                              <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                              <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                          </div> <!--/form-group-->	
                              

                         </div> <!--/col-xs-4-->
                         
                         <div class="col-xs-4">
                          
                          <div class="form-group col-xs-12">
                            <label for="totalAmount">Total Amount</label>
                              <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
                              <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
                          </div> <!--/form-group-->	
                          
                        <div class="form-group col-xs-12">
                              <label for="discount">Discount</label>
                              <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
                          </div> <!--/form-group-->	
                          

                         </div> <!--/col-xs-4-->
                         
                         <div class="col-xs-4">
                          
                          <div class="form-group col-xs-12">
                            <label for="grandTotal">Grand Total</label>
                              <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
                              <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
                          </div> <!--/form-group-->	
                          
                          <div class="form-group col-xs-12">
                            <label for="due" >Amount Due</label>
                              <input type="text" class="form-control" id="due" name="due" disabled="true" />
                              <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                          </div> <!--/form-group-->		
                          
                        </div> <!--/col-xs-4-->
                        
                        
                        <hr class="bhr"/>

                        <div class="form-group submitButtonFooter col-xs-12">
                          <div class="col-xs-3 col-xs-offset-1">
                            <button type="button" class="btn btn-block btn-default" onclick="addRow()" id="addRowBtn" > <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
                          </div>
                          <div class="col-xs-3">
                            <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-block btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Procced</button>
                          </div>
                          <div class="col-xs-3">
                            <button type="reset" class="btn btn-block btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
                          </div>
                        </div>

                          <!-- html hidden -->
                          <input type="hidden" name="orderdate" id="orderdate">
                          <input type="hidden" name="order_quantity" id="totalQuantity">
                          <!-- hiddent end -->

                      </form>
                  </div>
                
              </div>
            </div>
        </div>
      </div>
  </div>

  <?php include('includes/footer.php'); ?>
</body>
<script src="../assets/js/order.js"></script>
<script>
  $('#supplier').select2();

</script>