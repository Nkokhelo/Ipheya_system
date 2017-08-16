<?php require_once 'cart_info.php' ?>
<?php require_once 'includes/header.php'; ?>
<div class="container-fluid b" style="margin:5%;padding:1%;background-color:#fff;border:1px solid #ddd;border-top:none;">
		<div class="row">
				<div class="col-md-12">
					<!--<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li class="active">item</li>
					</ol>

					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Item</div>
						</div> <!-- /panel-heading -->
						<div class="panel-body">

							<div class="remove-messages"></div>

							<div class="div-action pull pull-right" style="padding-bottom:20px;">
								<button class="btn btn-default button1" data-toggle="modal" id="additemModalBtn" data-target="#additemModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add item </button>
							</div> <!-- /div-action -->
							<h3 class="text-center">Inventory</h2><hr>
							<table class="table" id="manageitemTable">
								<thead>
									<tr>
										<th style="width:10%;">Photo</th>
										<th>Item Name</th>
										<th>Item Code</th>
										<th>Quantity</th>
										<th>unit_price</th>
										<th>Description</th>
			              <th>Arrival Date</th>
										<th>status</th>
										<th style="width:15%;">Options</th>
									</tr>
								</thead>
							</table>
							<!-- /table -->

						</div> <!-- /panel-body -->
					</div> <!-- /panel -->
				</div> <!-- /col-md-12 -->
			</div> <!-- /row -->
</div>

<!-- add item -->
<div class="modal fade" id="additemModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submititemForm" action="php_action/createitem.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Item</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-item-messages"></div>

	      	<div class="form-group">
	        	<label for="item_img_name" class="col-sm-3 control-label">Item Image: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					    <!-- the avatar markup -->
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
					    <div class="kv-avatar center-block">
					        <input type="file" class="form-control" id="item_img_name" placeholder="item Name" name="item_img_name" class="file-loading" style="width:auto;"/>
					    </div>

				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="item_name" class="col-sm-3 control-label">Item Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="item_name" placeholder="Item Name" name="item_name" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="item_code" class="col-sm-3 control-label">Item Code: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="item_code" placeholder="item_code" name="item_code" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="description" class="col-sm-3 control-label">Description: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="description" placeholder="description" name="description" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="quantity" class="col-sm-3 control-label">Quantity: </label>
	        	<label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="quantity" placeholder="quantity" name="quantity" autocomplete="off">
            </div>
	        </div> <!-- /form-group-->

	        <div class="form-group">
	        	<label for="status" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="status" name="status">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Available</option>
				      	<option value="2">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->

          <div class="form-group">
            <label for="arrival_date" class="col-sm-3 control-label">Arrival Date: </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="arrival_date" name="arrival_date" autocomplete="off">
				    </div>
          </div>
          <!-- /form-group-->

          <div class="form-group">
            <label for="unit_price" class="col-sm-3 control-label">Unit Price: </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="unit_price" placeholder="Unit Price" name="unit_price" autocomplete="off">
				    </div>
          </div>
          <!-- /form-group-->

	      </div> <!-- /modal-body -->

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

	        <button type="submit" class="btn btn-primary" id="createitemBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Item</button>
	      </div> <!-- /modal-footer -->
     	</form> <!-- /.form -->
    </div> <!-- /modal-content -->
  </div> <!-- /modal-dailog -->
</div>


<div class="modal fade" id="edititemModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit item</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
				    <li role="presentation"><a href="#itemInfo" aria-controls="profile" role="tab" data-toggle="tab">Item Info</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">


				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/edititem_img_name.php" method="POST" id="updateitemImageForm" class="form-horizontal" enctype="multipart/form-data">

				    	<br />
				    	<div id="edit-itemPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="edititem_img_name" class="col-sm-3 control-label">Item Image: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <img src="" id="getitem_img_name" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->

			      	<div class="form-group">
			        	<label for="edititem_img_name" class="col-sm-3 control-label">Select Photo: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup -->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
							    <div class="kv-avatar center-block">
							        <input type="file" class="form-control" id="edititem_img_name" placeholder="item Name" name="edititem_img_name" class="file-loading" style="width:auto;"/>
							    </div>

						    </div>
			        </div> <!-- /form-group-->

			        <div class="modal-footer edititemPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

				        <!-- <button type="submit" class="btn btn-success" id="edititem_img_nameBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- item image -->
				    <div role="tabpanel" class="tab-pane" id="itemInfo">
				    	<form class="form-horizontal" id="edititemForm" action="php_action/edititem.php" method="POST">
				    	<br />

				    	<div id="edit-item-messages"></div>

				    	<div class="form-group">
			        	<label for="edititem_name" class="col-sm-3 control-label">Item Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="edititem_name" placeholder="item Name" name="edititem_name" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

							<div class="form-group">
			        	<label for="edititem_code" class="col-sm-3 control-label">Item Code: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="edititem_code" placeholder="Item Code" name="edititem_code" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

			        <div class="form-group">
			        	<label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

			        <div class="form-group">
			        	<label for="editunit_price" class="col-sm-3 control-label">Unit Price: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editunit_price" placeholder="Unit Price" name="editunit_price" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->

							<div class="form-group">
			        	<label for="editdescription" class="col-sm-3 control-label">Description: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editdescription" placeholder="Description" name="editdescription" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->


			       			        <div class="form-group">
			        	<label for="editstatus" class="col-sm-3 control-label">Status: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editstatus" name="editstatus">
						      	<option value="">~~SELECT~~</option>
						      	<option value="1">Available</option>
						      	<option value="2">Not Available</option>
						      </select>
						    </div>
			        </div> <!-- /form-group-->

			        <div class="modal-footer edititemFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

				        <button type="submit" class="btn btn-success" id="edititemBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->
			        </form> <!-- /.form -->
				    </div>
				    <!-- /item info -->
				  </div>

				</div>

	      </div> <!-- /modal-body -->


    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeitemModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove item</h4>
      </div>
      <div class="modal-body">

      	<div class="removeitemMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeitemFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeitemBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/item.js"></script>

<?php require_once 'includes/footer.php'; ?>
