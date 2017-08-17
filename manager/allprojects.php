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
            <div class='col-xs-12 b'>
              <h1 style="color:#999">All Projects</h1>
              <hr class="bhr"/>
                <?php if($proj_list ==''){ ?>
                <?=$error?>
                <?php } else { ?>
                  <table class="table table-bordered table-hover">
                  <thead>
                    <th>Project_Number</th><th>Name</th><th>Descreption</th><th>Duration</th><th>Due_Date</th><th>Project_Status</th><th>Processes</th>
                  </thead>
                  <tbody>
                    <?=$proj_list?>
                  </tbody>
                  
                </table>
                <div>
                <hr class='bhr' style="width:100%"/>
                <div class='col-xs-6 col-xs-offset-3' style='margin-bottom:30px;'>
                  <button type="submit" data-target="href=createproject.php" class='btn btn-default btn-block'>add project</button>
                </div>
  
                </div>
                <?php } ?>
            </div>
        </div>
       
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>