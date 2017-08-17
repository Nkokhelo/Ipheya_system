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
                <hr class="bhr"/>
                    <div class="form-group col-xs-6 col-xs-offset-3">
                      <button type="submit" name="<?=((isset($_GET['edit']))?'Edit':'Add');?>" class="btn btn-default form-control" ><?=((isset($_GET['edit']))?'<span class="glyphicon glyphicon-pencil"></span> Edit':' <span class="glyphicon glyphicon-plus"></span> Add new');?> Project</button>
                      <?=((isset($_GET['edit']))?'<a href="createproject.php" class="btn btn-default"><span class="ion ion-android-cancel"></span> Cancel</a>':'');?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
       
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>