<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/supplier-controller.php');
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
            <div class='col-xs-10 b'>
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
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
  $('#suppliers').dataTable();
</script>
