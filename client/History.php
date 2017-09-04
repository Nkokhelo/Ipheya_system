<?php
    session_start();
    if($_SESSION['Client'])
    {
        include('includes/head.php');
        include('../core/init.php');
        include('../core/logic.php');
        require_once('../core/controllers/servicehistory-controller.php');
    }
    else
    {
        header('Location:../login.php');
    }
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
                <div class="col-xs-11 b">
                  <h3 class="text-center" style="color:#888"><b>Client history</b></h3>
                  <?= $history ?>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
