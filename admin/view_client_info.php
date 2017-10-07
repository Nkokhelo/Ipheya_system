<?php

   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head2.php');
        require_once('../core/controllers/client-controller.php');
        include('includes/employee-session.php');
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
        <div class="col-xs-6">
              <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="dropdown active">
                    <a href="#manageproduct" class="dropdown-toggle" style="color:#888; text-decoration:none" data-toggle="dropdown">
                    Client<b class="glyphicon fa fa"></b>
                    </a>

                </li>
            </ol>
            </div><!-- /col-xs-6-->
             <div class="col-xs-offset-1 col-xs-11 b" id="viewClientInfo">
            
              <h2 class="text-center">Client Information</h2><hr class="bhr">
                <div class="col-md-12" style="padding:2%;min-height:20px;">
                    <div class="tab-content" > 
                        <div role="tabpanel" class="tab-pane fade in active" id="client" style="font-size:12px">
                            <div class="col-xs-12">
                                    <h4><p style="color:#888; position:absolute; top:5px;"><?= $client['name']?></p></h4><br/>
                                    <input type='hidden' id="client_id" value='<?= $client['client_id'] ?>'>
                                    <hr class="bhr"/>
                                    <div class="col-xs-12">
                                    <div class="col-xs-12" style="text-align:right">
                                        <table class="table-responsive">
                                            <tr>
                                                <td align="left"><h5>Full name </h5></td><td align="left"> <h5> : <?=$client['name']?> <?=$client['surname']?></h5></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><h5>Email  </h5></td><td align="left"> <h5> : <?=$client['email']?></h5></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><h5>Phone number </h5></td><td align="left"> <h5> : <?=$client['contact_number']?></h5></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><h5>Postal Address </h5></td><td align="left"> <h5> : <?=$client['postal_address']?></h5></td>
                                            </tr>
                                        </table>
                                    </div>
                            </div>
                            </div>
                        </div>

        <?php include('includes/footer.php'); ?>
      </div>
  </div>
</body>
 <script src="../assets/chartjs/Chart.js" type="text/javascript"></script>
 <!--<script src="../assets/chartjs/lib/jquery-2.1.3.min.js" type="text/javascript"></script>-->
 <!-- <script src="../assets/chartjs/customjs/servicebar.js" type="text/javascript"></script> -->
 <script src="../assets/chartjs/customjs/servicebar.js"></script>
 <script src="../assets/chartjs/customjs/piechart.js"></script>
