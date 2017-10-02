<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/project-controller.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<style>
  .label
  {
    border-radius: 50%;

  }
</style>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-11 b'>
              <h1 style="color:#999">All Projects</h1>
              <hr class="bhr"/>
                <?php if($proj_list ==''){ ?>
                <?=$error?>
                <?php } else { ?>
                  <table class="table table-bordered table-hover" id="projectTable">
                  <thead>
                    <th>#</th><th>Project Name</th><th>Duration</th><th>Project Due</th><th>...</th>
                  </thead>
                  <tbody>
                    <?=$proj_list?>
                  </tbody>
                  
                </table>
                <div>
                <hr class='bhr' style="width:100%"/>
                <div class='col-xs-6 col-xs-offset-3' style='margin-bottom:30px;'>
                  <a type="submit" href="createproject.php" class='btn btn-default btn-block'>add project</a>
                </div>
  
                </div>
                <?php } ?>
            </div>
        </div>
       
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script>
  $(document).ready(function(){
    $('#projectTable').dataTable();
  });
    </script>
</body>