<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/project-controller.php');
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
              <h1>Programs</h1>
                <?php if($proj_list ==''){ ?>
                <?=$error?>
                <?php } else { ?>
                <table class="table">
                  <thead>
                    <th>Project Number </th><th>Name</th><th>Program Name</th><th>Status</th><th>Duration</th>
                  </thead>
                  <tbody>
                    <?=$proj_list?>
                  </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>