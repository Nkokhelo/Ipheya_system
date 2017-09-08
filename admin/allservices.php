<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
        require_once('../core/init.php');
        include('includes/head2.php');
        include('../core/logic.php');
        require_once('../core/controllers/service-controller.php');
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
          <div class="col-xs-10 col-xs-offset-1 b">
            <h2>All Services</h2>
            <hr class="bhr"/>
            <table class="table">
              <thead>
                <th>Service name</th>
                <th>Department name</th>
                <th>Options</th>
              </thead>
              <tbody>
                <?=$allServices;?>
              </tbody>
              <tfoot>
                
              </tfoot>
            </table>
            <hr class="bhr"/>
            <div class="col-xs-12">
              <div class="col-xs-4 col-xs-offset-4">
                <a class="btn btn-block btn-default" 
                href="services.php"><i class="fa fa-plus-square-o"></i> Add Service</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

