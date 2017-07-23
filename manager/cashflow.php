<?php
   session_start();
   if(isset($_SESSION['Manager']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/cashflow-controller.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>

<div class="col-xs-12">
  <div class="col-xs-8 col-xs-offset-2 b">
    <h2>Finacial Report</h2>
    <hr class="bhr"/>
    <div class="col-xs-12">

    </div>
    <div class="col-xs-12">
        <table class="table">
          <thead align="center">
            <div class="col-xs-12">
              <div class="col-xs-3">
                <h3>
                  <div class="col-xs-12 btn-group">
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-refresh"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-object-align-bottom"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-minus"></span></button>
                  </div>
                </h3>
              </div>
              <div class="col-xs-6">
                <h3 align="center" style="width:70%">Cash Flow</h3>
              </div>
              <div class="col-xs-3">
                <h3>
                  <div class="col-xs-12 btn-group">
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-refresh"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-object-align-bottom"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-plus"></span></button>
                    <button class="btn btn-xs btn-info"><span class="glyphicon glyphicon-minus"></span></button>
                  </div>
                </h3>
              </div>
           </div>
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
  </div>
</div>
