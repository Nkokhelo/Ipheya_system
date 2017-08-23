<?php
  include 'includes/head.php';
  include('../core/init.php');
  include('../core/controllers/service-ratings-controller.php');
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-md-12' style="padding:2%;">
              <h1 class="text-center">Service ratings</h1>
              <div class="col-md-8 bg-white" align="center" style="padding:1%;background-color:#fff;border:1px solid #99A8AD;border-radius:2px;">
                <?=$servicedata;?>
              </div>
            </div>
        </div>
      </div>
  </div>
</body>
