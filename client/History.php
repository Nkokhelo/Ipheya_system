<?php
#21408789 Zulu NP 
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
                    <h2 style="color:#888" class="text-center">My History</h2><hr class="bhr"/>
                 <?=$display ?>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
