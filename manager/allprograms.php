<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/programs-controller.php');
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
              <?php if($prog_list ==''){ ?>
              <?=$error?>
              <?php } else { ?>
              <h1>Programs</h1>
                <table class="table">
                  <thead>
                    <th>Program Number </th><th>Program Name</th><th>No of Projets</th>
                  </thead>
                  <tbody>
                    <?=$prog_list?>
                  </tbody>
                </table>
              <?php } ?>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>