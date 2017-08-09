<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/cashflow-controller.php');
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
            <div class="col-xs-10 b">
              <h2>Income</h2>
              <hr class="bhr"/>
              <div class="col-xs-12">
              </div>
              <div class="col-xs-12">
                  <table class="table">
                    <thead align="center">

                    </thead>
                    <tbody>
                      <tr>
                        <td> Date </td><td> Reason </td><td> Amount</td><td align='center'>Money In/Out</td>
                      </tr>
                      <?=$transactions?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                  </table>
              </div>
              <hr class="bhr"/>
              <div class="col-xs-12">
                <div class="col-xs-4 col-xs-offset-4">
                   <a class="btn btn-block btn-primary">View Finacial Report</a><br/>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>


