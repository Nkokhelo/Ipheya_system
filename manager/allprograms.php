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
              <fieldset>
              <h2>Programs</h2>
                <hr class="bhr">
                <?php if($prog_list ==''){ ?>
                <?=$error?>
                <?php } else { ?>
                  <table class="table">
                    <thead>
                      <th>Program Number </th><th>Program Name</th><th>No of Projets</th>
                    </thead>
                    <tbody>
                      <?=$prog_list?>
                    </tbody>
                  </table>
                  <hr class="bhr"/>
                  <div class="col-xs-12">
                    <div class="col-xs-6 col-xs-offset-2">                      
                    <a class="btn btn-block btn-success" href="programs.php"><i class="fa fa-plus"></i>Create Program</a>
                    <br/>
                    </div>
                  </div>
                <?php } ?>
              </fieldset>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>