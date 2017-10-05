<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/supplier-controller.php');
        include('includes/employee-session.php');
        // include('includes/navigation.php');
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
        
        <div class='col-xs-12'>
            <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><i class="fa fa-users"></i> All suppliers</li>
            </ol>
          </div><!-- /col-xs-6-->

             <div class="col-xs-offset-1 col-xs-11 b">
              <h2 class="text-center">All Suppliers</h2><hr class="bhr">
              <table class="table" id="supplierTable">
                <thead style="border-top:#eee 2px solid">
                  <tr><th>#</th><th>Name</th><th>Telephone</th><th>Email</th><th>Actions</th></tr>
                </thead>
                <tbody>
                  <?= $all_suppliers;?>
                </tbody>
                <tfoot>
                  
                </tfoot>
              </table>
              <hr class="bhr"/>
              <div class="form-group col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                    <a href="addsupplier.php" class="btn btn-default form-control"><span class="glyphicon glyphicon-plus"></span> Add new Supplier</a>
                </div>
              </div>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
</body>
<script>
  $(document).ready(function(){
    $('#supplierTable').dataTable({
      "scrollY": "200px",
      "scrollCollapse": true,
    });
  });
</script>


