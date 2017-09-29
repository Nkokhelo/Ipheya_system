<div class="modal fade" id="salesModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="/ipheya/core/sub/php_action/sellProduct.php" method="post" class="form-horizontal">

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
                      <input type="text" class="form-control" id="sproductName" name="productName">
                      <input type="hidden" class="form-control" id="spoductId" name="productId">
                    </div>
                  </div>

                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <label class="col-xs-6" for="">Inventory  :</label>
                    <div class="col-xs-10">
                      <input type="text" class="form-control" id="squantity" name="quantity">
                    </div>
                  </div>
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
                      <input type="text" class="form-control" id="unitPrice" name="unitPrice">
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

              <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
            </div>
            <!-- /modal-footer -->
            </form>

        </div>
        <!-- /modal-content -->
      </div>
      <!-- /modal-dailog -->
    </div>