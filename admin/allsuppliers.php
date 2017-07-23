<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/supplier-controller.php');
        include('includes/employee-session.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<div class="container-fluid" style="padding:1%;">
      <div class="col-sm-offset-2 col-sm-8 b">
        <h2 class="text-center">All Suppliers</h2><hr class="bhr">
      <!--<form class="form-inline" action="departments.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" novalidate>-->
      <table class="table" style="padding:2%;" id="suppliers">
        <thead>
          <th>Supplier No</th><th>Name</th><th>Telephone</th><th>Email</th>
        </thead>
        <tbody>
          <?=$all_suppliers;?>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
        <!--</form>-->
            <hr class="bhr"/>
              <div class="col-xs-4 col-xs-offset-4">
                 <a href="addsupplier.php" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus"></span> Add new Supplier</a>
            <br/>
              </div>
      </div>
</div>
<script>
  $('#suppliers').dataTable();
</script>
<?php include('includes/footer.php'); ?>
