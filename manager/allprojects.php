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
              <h1 style="color:#999">All Projects</h1>
              <hr class="bhr"/>
                <?php if($proj_list ==''){ ?>
                <?=$error?>
                <?php } else { ?>
                <table class="table">
                  <thead>
                    <th>Project_Number </th><th>Name</th><th>Program Name</th><th>Duration</th><th>Due_Date</th><th>Project_Status</th>
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