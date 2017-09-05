<?php
session_start();
    if(isset($_SESSION['Employee']))
    {
		 require_once('../core/init.php');
		 include('includes/head2.php');
		 include('../core/logic.php');
		 require_once('../core/controllers/inventory-controller.php');
		//  include('includes/navigation.php');
    }
    else
    {
      header("Location:../login.php");
    }
     
?>

<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class="col-sm-10 b">
            <h2 class="text-center">Inventory</h2><hr class="bhr">
            <div class="col-xs-12">
              <div class="col-xs-12">
                <?=$qitems?>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <!-- add item -->
<div class="modal fade" id="additemModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="submititemForm" action="additem.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title "><i class="fa fa-plus"></i> <label>Order for </label> <label id='name'></label> <label> </label> </h3>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">
	      	<div id="add-item-messages"></div>
          <input type='hidden' name='item_no' id='hidden' >
	      	<div class="form-group">
	        	<label for="item_img_name" class="col-sm-4 control-label">Item Image         : </label>
				    <div class="col-sm-6">
					    <input type="file" class="form-control" id="item_img_name"  name="item_image" />
				    </div>
	        </div> <!-- /form-group-->
          
	        <div class="form-group">
	        	<label for="item_code" class="col-sm-4 control-label">Item Name         : </label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" disabled id="item_name" placeholder="Item Name" name="item_name" >
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="item_code" class="col-sm-4 control-label">Item Code         : </label>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="item_code" placeholder="Item Code" name="item_code" >
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="status" class="col-sm-4 control-label">Supplier         : </label>
				    <div class="col-sm-6">
				      <select class="form-control" id="status" name="supplier">
				      	<option value="">**Select a Item supplier**</option>
                <?=($supplierOptions)?$supplierOptions:""?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-4 control-label">Quantity: </label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="quantity" onkeyup="totalprice()" placeholder="Quantity" name="quantity" >
              <input type="hidden" id="old_quantity" name="old_quantity" >
            </div>
            <label for="quantity" class="col-sm-5" style="font-style:italic; color:#999; padding-top:7px;" id="q_info"></label>
	        </div> <!-- /form-group-->

              <!--<label style="font-weight:100; text-decoration:italics" id="q_info"></label>-->

          <div class="form-group">
            <label for="arrival_date" class="col-sm-4 control-label">Expected Date         : </label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="arrival_date" name="arrival_date" >
				    </div>
          </div>
          <!-- /form-group-->

          <div class="form-group">
            <label for="unit_price" class="col-sm-4 control-label">Unit Price         : </label>
            <div class="col-sm-6">
              <input type="text" disabled class="form-control" id="unit_price" placeholder="Unit Price" name="unit_price" >
	            <input type="hidden" id="unit_price"name="unit_price" >
            </div>
          </div>
          <!-- /form-group-->

          <div class="form-group">
            <label for="total_price" class="col-sm-4 control-label">Amount         : </label>
            <div class="col-sm-6">
              <input type="text" disabled class="form-control" id="total_price" placeholder="Total Price" >
              <input type="hidden" id="total_price"name="total_price" >
				    </div>
          </div>
          <!-- /form-group-->

	      </div> <!-- /modal-body -->

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" name="save" class="btn btn-primary" id="createitemBtn" data-loading-text="Loading..." > <i class="glyphicon glyphicon-ok-sign"></i> Save Item</button>
	      </div> <!-- /modal-footer -->
     	</form> <!-- /.form -->
    </div> <!-- /modal-content -->
  </div> <!-- /modal-dailog -->
</div>

</body>


<script>
  var old_q=0;
  $('#items').dataTable();
  $('#arrival_date').datepicker({
						minDate:0,
						dateFormat: 'yy-mm-dd'
  });

  function getItem(id) {
    $.ajax({
                  type:"get",
                  url:"http://www.invest4living.com/Ipheya/stock-counter/includes/getitems.php",
                  data:"item_no="+id,
                  success:function(data){
                  data =JSON.parse(data);
                  $('#name').text(data.Name);
                  $('#item_name').val(data.Name);
                  $('#unit_price').val(data.UnitPrice+".00");
                  $('#total_price').val(0+".00");
                  $('#hidden').val(id);
                  $('#old_quantity').val(data.Quantity);
                  old_q = data.Quantity;
                    console.log(data);
                },error:function (err) {
                  console.log("Result"+err)
                }
						});
  }
  function totalprice()
  {
    var quan = $('#quantity').val();
    var unit = Number($('#unit_price').val());
    if(!isNaN(quan))
    {
      $('#total_price').val(quan*unit);
    }
    message(quan);
  }

  function message(new_q)
  {
    var left = old_q - new_q;
    if(!(left<0)){
      $('#q_info').text(left+" Item(s) left");
    }
    else{
      $('#q_info').text(left*-1+" extra item(s)");
    }
  }
</script>
<?php include('includes/footer.php'); ?>
