<?php
     require('../core/init.php');
     include('includes/head.php');
     include('includes/navigation.php');
     include('../core/controllers/target-controller.php');
     include('includes/employee-session.php');
?>
<div class="container-fluid" style="padding:1%;">
      <h2 class="text-center">Target log</h2><hr>
      <table class="table table-bordered table-striped " style="padding:2%;">
        <thead>
          <th>Ip address</th><th>First visit</th><th>Last visit</th><th>Total visits</th><th>Delete</th>
        </thead>
        <tbody>
          <?=$allTargets;?>
        </tbody>
        <tfoot>

        </tfoot>
      </table>
</div>
<?php include('includes/footer.php'); ?>
