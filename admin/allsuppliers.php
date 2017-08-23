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
             <div class="col-xs-offset-2 col-xs-10 b">
              <h2 class="text-center">All Suppliers</h2><hr class="bhr">
<<<<<<< HEAD
<<<<<<< HEAD
              <table class="table" style="padding:2%;" id="suppliers">
                <thead>
                  <th>Supplier No</th><th>Name</th><th>Telephone</th><th>Email</th>
                </thead>
                <tbody>
                  <?=$all_suppliers;?>
                </tbody>
                <tfoot>
=======
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
              <table class="table" id="supplierTable">
                <thead style="border-top:#eee 2px solid">
                  <tr><th>#</th><th>Name</th><th>Telephone</th><th>Email</th><th>Actions</th></tr>
                </thead>
                <tbody>
                  <?= $all_suppliers;?>
                </tbody>
                <tfoot>
                  
<<<<<<< HEAD
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
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
<<<<<<< HEAD
<<<<<<< HEAD
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
=======
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
</body>
<script>
  $(document).ready(function(){
    $('#supplierTable').dataTable({
      "scrollY": "200px",
      "scrollCollapse": true,
    });
  });
</script>
<<<<<<< HEAD
<<<<<<< HEAD
<div class="container-fluid" style="padding:1%;">
     
</div>
=======
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99

