<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/supplier-controller.php');
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
      <form class="form-inline" action="departments.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" novalidate>
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
        </form>
            <hr class="bhr"/>
            <br/>
      </div>
</div>
<script>
  $('#suppliers').dataTable();
</script>
<?php include('includes/footer.php'); ?>
