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
                    Rentals<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="timeline.php">Rental Settings</a></li>
                    </ul>
                </li>
            </ol>
            </div><!-- /col-xs-6-->

           
            <div class='col-xs-11 b'>
                <h2>Rental Items</h2>
            </div>
              
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <script>

  </script>
</body>