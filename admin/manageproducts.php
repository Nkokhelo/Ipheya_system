<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('includes/head2.php');
  include('../core/controllers/managep-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<link rel="stylesheet" href="../assets/plugins/fileinput/css/fileinput.min.css">
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>

             <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="dropdown active">
                    <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                    Manage Product<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="manageproducts.php">Product</a></li>
                        <li><a href="qoutationproducts.php">Qoutation Products</a></li>
                    </ul>
                </li>
              </ol>
            </div><!-- /col-xs-6-->


              <div class="col-xs-11 b">
                <h2><i class="fa fa-edit"></i>Manage Product</h2><hr class="bhr">
                 <div class="row">
                  <div class="col-md-12">
                     <div class="remove-messages"></div>

                     <table class="table table-bordered table-hover" id="manageProductTable">
                      <thead>
                       <tr>
                        <th style="width:10%;">Photo</th>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Re-order Point</th>
                        <th>Status</th>
                        <th style="width:15%;"></th>
                       </tr>
                      </thead>
                      <tfoot>
                      </tfoot>
                     </table>
                     <!-- /table -->
                  </div> <!-- /col-md-12 -->
                 </div> <!-- /row -->
                 <hr class="bhr"/>
                <div class="col-xs-12">
                 <div class="col-xs-4 col-xs-offset-4">
                  <button class="btn btn-block btn-default" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                 </div> <!-- /div-action -->

                </div>

                 <!-- add product -->
                 <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
                   <div class="modal-dialog">
                     <div class="modal-content">

                      <form class="form-horizontal" id="submitProductForm" action="/ipheya/core/sub/php_action/createProduct.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                        </div>

                        <div class="modal-body" style="max-height:450px; overflow:auto;">

                         <div id="add-product-messages"></div>

                         <div class="form-group">
                           <label for="productImage" class="col-sm-3 control-label">Product Image: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                          <!-- the avatar markup -->
                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                          <div class="kv-avatar center-block">
                              <input type="file" class="form-control" id="productImage" placeholder="Product Name" name="productImage" class="file-loading" capture style="width:auto;"/>
                          </div>

                         </div>
                          </div> <!-- /form-group-->

                          <div class="form-group">
                           <label for="productName" class="col-sm-3 control-label">Product Name: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off">
                         </div>
                          </div> <!-- /form-group-->

                          <!-- <div class="form-group">
                           <label for="quantity" class="col-sm-3 control-label">Quantity: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" autocomplete="off">
                         </div>
                          </div>

                          <div class="form-group">
                           <label for="rate" class="col-sm-3 control-label">Rate: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <input type="text" class="form-control" id="rate" placeholder="Rate" name="rate" autocomplete="off">
                         </div>
                          </div>      	         -->
                          <div class="form-group">
                             <label for="reorder" class="col-sm-3 control-label">Re-order point </label>
                             <label class="col-sm-1 control-label">: </label>
                             <div class="col-sm-8">
                               <input type="number" class="form-control" id="reorder" placeholder="Re-order Point" name="reorder" autocomplete="off">
                             </div>
                          </div>

                          <div class="form-group">
                           <label for="brandName" class="col-sm-3 control-label">Brand Name: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <select class="form-control" id="brandName" name="brandName">
                            <option value="">~~SELECT~~</option>
                            <?php
                            $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                         $result = $db->query($sql);

                         while($row = $result->fetch_array()) {
                          echo "<option value='".$row[0]."'>".$row[1]."</option>";
                         } // while

                            ?>
                           </select>
                         </div>
                          </div> <!-- /form-group-->

                          <div class="form-group">
                           <label for="categoryName" class="col-sm-3 control-label">Category Name: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <select type="text" class="form-control" id="categoryName" placeholder="Product Name" name="categoryName" >
                            <option value="">~~SELECT~~</option>
                            <?php
                                  $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                               $result = $db->query($sql);

                               while($row = $result->fetch_array()) {
                                echo "<option value='".$row[0]."'>".$row[1]."</option>";
                               } // while
                            ?>
                           </select>
                         </div>
                          </div> <!-- /form-group-->

                          <div class="form-group">
                           <label for="productStatus" class="col-sm-3 control-label">Status: </label>
                           <label class="col-sm-1 control-label">: </label>
                         <div class="col-sm-8">
                           <select class="form-control" id="productStatus" name="productStatus">
                            <option value="">~~SELECT~~</option>
                            <option value="1">Available</option>
                            <option value="2">Not Available</option>
                           </select>
                         </div>
                          </div> <!-- /form-group-->
                        </div> <!-- /modal-body -->

                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                          <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                        </div> <!-- /modal-footer -->
                       </form> <!-- /.form -->
                     </div> <!-- /modal-content -->
                   </div> <!-- /modal-dailog -->
                 </div>
                 <!-- /add categories -->


                 <!-- edit categories brand -->
                 <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
                   <div class="modal-dialog">
                     <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
                        </div>
                        <div class="modal-body" style="max-height:450px; overflow:auto; padding-top:0">

                         <div class="div-loading">
                          <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                          <span class="sr-only">Loading...</span>
                         </div>

                         <div class="div-result">

                       <!-- Nav tabs -->
                       <ul class="nav nav-tabs" role="tablist" style="">
                         <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                         <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>
                       </ul>

                       <!-- Tab panes -->
                       <div class="tab-content">


                         <div role="tabpanel" class="tab-pane active" id="photo">
                          <form action="/ipheya/core/sub/php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

                          <br />
                          <div id="edit-productPhoto-messages"></div>

                          <div class="form-group">
                             <label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                             <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                           </div>
                            </div> <!-- /form-group-->

                           <div class="form-group">
                             <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                            <!-- the avatar markup -->
                          <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                            <div class="kv-avatar center-block">
                                <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
                            </div>

                           </div>
                            </div> <!-- /form-group-->

                            <div class="modal-footer editProductPhotoFooter">
                             <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                             <!-- <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
                           </div>
                           <!-- /modal-footer -->
                           </form>
                           <!-- /form -->
                         </div>
                         <!-- product image -->
                         <div role="tabpanel" class="tab-pane" id="productInfo">
                          <form class="form-horizontal" id="editProductForm" action="/ipheya/core/sub/php_action/editProduct.php" method="POST">
                          <br />

                          <div id="edit-product-messages"></div>

                          <div class="form-group">
                             <label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                             <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                           </div>
                            </div> <!-- /form-group-->

                            <div class="form-group">
                               <label for="editreorder" class="col-sm-3 control-label">Re-order point </label>
                               <label class="col-sm-1 control-label">: </label>
                               <div class="col-sm-8">
                                 <input type="number" class="form-control" id="editreorder" placeholder="Quantity" name="editreorder" autocomplete="off">
                               </div>
                            </div>

                            <div class="form-group">
                             <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                             <select class="form-control" id="editBrandName" name="editBrandName">
                              <option value="">~~SELECT~~</option>
                              <?php
                              $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                              $result = $db->query($sql);

                           while($row = $result->fetch_array()) {
                            echo "<option value='".$row[0]."'>".$row[1]."</option>";
                           } // while

                              ?>
                             </select>
                           </div>
                            </div> <!-- /form-group-->

                            <div class="form-group">
                             <label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                             <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
                              <option value="">~~SELECT~~</option>
                              <?php
                              $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                           $result = $db->query($sql);

                           while($row = $result->fetch_array()) {
                            echo "<option value='".$row[0]."'>".$row[1]."</option>";
                           } // while

                              ?>
                             </select>
                           </div>
                            </div> <!-- /form-group-->

                            <div class="form-group">
                             <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                             <label class="col-sm-1 control-label">: </label>
                           <div class="col-sm-8">
                             <select class="form-control" id="editProductStatus" name="editProductStatus">
                              <option value="">~~SELECT~~</option>
                              <option value="1">Available</option>
                              <option value="2">Not Available</option>
                             </select>
                           </div>
                            </div> <!-- /form-group-->

                            <div class="modal-footer editProductFooter">
                             <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                             <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                           </div> <!-- /modal-footer -->
                            </form> <!-- /.form -->
                         </div>
                         <!-- /product info -->
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
                 <div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
                       </div>
                       <div class="modal-body">

                        <div class="removeProductMessages"></div>

                         <p>Do you really want to remove ?</p>
                       </div>
                       <div class="modal-footer removeProductFooter">
                         <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                         <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
                       </div>
                     </div><!-- /.modal-content -->
                   </div><!-- /.modal-dialog -->
                 </div><!-- /.modal -->
                 <!-- /categories brand -->


              </div>
            </div>
        </div>
      </div>
  </div>
  <script src="../assets/plugins/fileinput/js/fileinput.min.js"></script>
  <script src="../assets/js/product.js"></script>

  <?php include('includes/footer.php'); ?>
</body>
<style>
  td>.btn-group>.dropdown-menu {
    left: -110%;
}
</style>