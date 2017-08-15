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
                    <li><a href="#graph" data-toggle="tab">Bar graph</a></li>
                </ul>
                <div class="col-md-12" style="padding:2%;">
                    <div class="tab-content" >

                        <div role="tabpanel" class="tab-pane fade in active" id="client" style="font-size:12px">
                            <div class="col-xs-12">
                                    <h5><p style="color:#0094ff; position:absolute; top:5px;">Client number : #<?= $client['client_no'];?></p></h5>
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
                                <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                
                                 </div>
                             <div class="alert alert-info">
                         </div>

                                                <?php

                                                    $log = new Logic(); 
                                                    $result=mysqli_query($db,'select * from ServiceRequest');
                                                        
                                                            echo "<table class='table table-hover'>";
                                                            echo "<tr> <th>Client Name</th> <th>Service Name</th> <th>Description</th> <th>Request Date</th> <th>Duration</th><th>Due Date</th> </tr>";
                                                            while ($row=mysqli_fetch_array($result))
                                                            {
                                                                    echo "<tr>";
                                                                    echo "<td>" .$log->getClientByIdNo($row['ClientID'])['name']."</td>";
                                                                    echo "<td>" .$log->getServiceById($row['ServiceID'])['service']."</td>";
                                                                    echo "<td>" .$row['Description']."</td>";
                                                                    echo "<td>" .$row['RequestDate']."</td>";
                                                                    echo "<td>" .$row['Duration']."</td>";
                                                                    echo "<td>" .$row['DueDate']."</td>";
                                                                    echo"</tr>";
                                                                }
                                                                echo"</table>";
                                    /*$sel="select *  from ServiceRequest";
                                    if($result=mysqli_query($db,$sel))
                                    {
                                        echo "<table border=2><tr><th>Client Name</th> <th>Service Id</th> <th>Description</th> <th>Request Date</th> <th>Duration</th><th>Due Date</th> </tr>";
                                        while($arrhistory=mysqli_fetch_row($result))
                                        {
                                            echo "<tr>
                                            <td>$arrhistory[0]</td>
                                            <td>$arrhistory[1]</td>
                                            <td>$arrhistory[2]</td>
                                            <td>$arrhistory[3]</td>
                                            <td>$arrhistory[4]</td>
                                            <td>$arrhistory[5]</td>
                                            </tr>";
                                        }
                                        echo "</table>";*/
                              ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="graph">
                            <div class="col-xs-12">
                                <?php
                                    $history=mysqli_query($db,"Select ClientID and ServiceID from ServiceRequest");

                            
                                ?>
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
