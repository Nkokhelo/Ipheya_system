<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
     require('../core/init.php');
     include('includes/head.php');
     include('../core/controllers/target-controller.php');
    //  include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }

    //  include('includes/employee-session.php');
?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-11 b'>
              <div class="col-lg-8" style="">
                <ul class="nav nav-tabs" id="iptab">
                    <li class="active"><a href="#table">Table</a></li>
                    <li><a href="#bar">Bar charts</a></li>
                    <li><a href="#line">Line charts</a></li>
                    <!--<li><a  href="#inProgress">In progress</a></li>
                    <li><a  href="#Resolved">Resolved</a></li>-->
                </ul>
              </div>
              <div class="container-fluid">
                <div class="col-lg-12">
                  <div class="tab-content">
                      <div role="tabpanel" class="tab-pane fade in active" id="table">
                        <h3 class="text-center">Target log</h3>
                        <table class="table table-bordered table-striped " style="padding:2%;">
                          <thead>
                            <th>Ip address</th><th>First visit</th><th>Last visit</th><th>Total visits</th><th>Delete</th>
                          </thead>
                          <tbody>
                            <?=$allTargets;?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                      <div role="tabpanel" class="tab-pane fade in" id="bar">
                        <div class="col-md-6">
                          <div class="chart-container">
                            <label for="barcanvas">Bar graph showing site visits per ip address</label>
                            <canvas id="barcanvas">
                            </canvas>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="chart-container">
                            <label for="linecanvas">Horizontal representaion of site visits per ip address</label>
                            <canvas id="hbarcanvas">
                            </canvas>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="line">
                        <div class="col-md-8">
                          <div class="chart-container">
                            <label for="linecanvas">line graph showing site visits per ip address</label>
                            <canvas id="linecanvas">
                            </canvas>
                          </div>
                        </div>
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

<div class="container-fluid b" style="margin:2%;padding:1%;background-color:#eee;">

  </div>
      <script>
      //changes the tab navigation
       $('#iptab li').click(function(){
           $('.nav li').removeClass('active');
           $(this).addClass('active');
       });
       //changes tab content
       /*$(document).ready(function(){
           $('#1').click(function(){
               $('#iptab a[href="#new"]').tab('show');
           });
            $('#2').click(function(){
               $('#iptab a[href="#common"]').tab('show');
           });
           $('#3').click(function(){
               $('#iptab a[href="#acknowledged"]').tab('show');
           });
            $('#5').click(function(){
               $('#iptab a[href="#solved"]').tab('show');
           });
         });*/
         $(document).ready(function(){
             $('#iptab a').click(function(e){
                 e.preventDefault();
                 $(this).tab('show')
             });

             $('a[data-toggle="tab"]').on('shown.bs.tab', function(t){
                 t.relatedTarget
             });
         });
      </script>
      <script src="../assets/chartjs/Chart.min.js" type="text/javascript"></script>
      <script src="../assets/chartjs/Chart.js" type="text/javascript"></script>
      <!--<script src="../assets/chartjs/lib/jquery-2.1.3.min.js" type="text/javascript"></script>-->
      <script src="../assets/chartjs/customjs/linegraph.js" type="text/javascript"></script>
<?php include('includes/footer.php'); ?>
