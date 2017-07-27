<?php
  session_start();
   if(isset($_SESSION['Employee']))
    {
     require_once('../core/init.php');
     include('includes/head2.php');
     require_once('../core/controllers/archive-controller.php');
    //  include('includes/navigation.php');
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
            <div class="col-sm-10 col-sm-offset-2 b">
              <h2 class="text-center">Archived accounts</h2><hr class="bhr">
              <?php if($allClients==null)
              {
                echo "<div class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No achived accounts at the moment !</div>";
              }
              else
              {?>
            <table class="table table-striped " style="padding:2%;">
              <thead>
                <th>Name</th><th>Email</th><th>Contact</th><th>Restore</th>
              </thead>
              <tbody>
                <?=$allClients;?>
              </tbody>
              <tfoot>

              </tfoot>
            </table>
            <?php } ?>
          </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
