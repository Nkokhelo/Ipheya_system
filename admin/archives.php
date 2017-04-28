<?php
     require_once('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
     require_once('../core/controllers/archive-controller.php');
     include('includes/employee-session.php');
?>
<div class="container-fluid" style="padding:1%;">
      <h2 class="text-center">Archived accounts</h2><hr>
      <table class="table table-bordered table-striped " style="padding:2%;">
        <thead>
          <th>Name</th><th>Email</th><th>Contact</th><th>Restore</th>
        </thead>
        <tbody>
          <?=$allClients;?>
        </tbody>
        <tfoot>

        </tfoot>
      </table>
</div>
<?php include('includes/footer.php'); ?>
