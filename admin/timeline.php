<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/rentals-controller.php');
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
            <div class="col-xs-12">
                
            <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>		  
                <li class="dropdown active">
                    <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                  Rental<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="timelines.php">Rental Settings</a></li>
                    </ul>
                </li>
            </ol>
            </div><!-- /col-xs-6-->

           
            <div class='col-xs-11 b'>
                <h2>Create TimeLine</h2><hr class="bhr">
                <?= $feedback ?>
                <form action="" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label for="timeline control-label" >Timeline:</label>
                            <input class="form-control" type="text" name="timeline" id="timeline">
                        </div>
                    </div>
                    <div>
                   <input type="submit" name="save" class="btn btn-primary"></input>
                 </div>
                </form>
            </div>
           
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
 
  <script>

  </script>
</body>
