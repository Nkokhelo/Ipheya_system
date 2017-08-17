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
            <div class="col-sm-10 b">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active" data-toggle="tab"><a href="#client" data-toggle="tab">Cient Personal Details</a></li>
                    <li><a href="#history" data-toggle="tab">Client History</a></li>
                    <li><a href="#bar" data-toggle="tab">Bar graph</a></li>
                </ul>
                <div class="col-md-12" style="padding:2%;">
                    <div class="tab-content" >

                        <div role="tabpanel" class="tab-pane fade in active" id="client" style="font-size:12px">
                            <div class="col-xs-12">
                                    <h5><p style="color:#0094ff; position:absolute; top:5px;">Client number : #<?= $client['client_no'];?></p></h5>
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
                                <hr class="bhr" style="width:100%"/>
                                <div class="col-xs-5 col-xs-offset-5">
                                    <a href="viewsupplier?edit=<?=$_GET['view']?>" class="btn btn-xs btn-primary"><p class="glyphicon glyphicon-edit"></p> edit...</a>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="history">
                            <div class="col-xs-12">
                                <?php if($history_view !=''){ ?>
                                    <table class="table">
                                    <thead>
                                    <th>Service Name</th><th>Description</th><th>Date</th>
                                    </thead>
                                    <tbody>
                                        <?=$history_view?>
                                    </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <?=$history_view_feed?>
                                <?php } ?>
                            </div>
                        </div>
                    <div role="tabpanel" class="tab-pane fade in" id="bar">
                        <div class="col-md-6">
                          <fieldset>
                            <legend class="thelegend">Bar graph</legend>
                              <div class="col-xs-12">
                                <canvas id="barcanvas"></canvas>
                              </div>
                          </fieldset>
                        </div>
                     </div>
                    </div>    
                </div>
            </div>      
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
 <script src="../assets/chartjs/Chart.js" type="text/javascript"></script>
 <!--<script src="../assets/chartjs/lib/jquery-2.1.3.min.js" type="text/javascript"></script>-->
 <!-- <script src="../assets/chartjs/customjs/servicebar.js" type="text/javascript"></script> -->
 <script src="../assets/chartjs/customjs/servicebar.js"></script>
