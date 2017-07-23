<?php
   session_start();
   if(isset($_SESSION['Employee']))
   {
        require_once('../core/init.php');
        include('../core/logic.php');
        include('includes/head.php');
        require_once('../core/controllers/client-controller.php');
        include('includes/employee-session.php');
        include('includes/navigation.php');
   }
   else
   {
     header("Location:../login.php");
   }
?>
<div class="col-xs-12 container-fluid">
     <div class="col-sm-8 col-sm-offset-2 b">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active" data-toggle="tab"><a href="#client" data-toggle="tab">Cient Personal Details</a></li>
            <li><a href="#history" data-toggle="tab">Client History</a></li>
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
                                    <strong><i class="glyphicon glyphicon-info-sign"></i></strong> No service request has been made by 
                                </div>
                        <div class="alert alert-info">
                               
                                <p><span class="glyphicon glyphicon-info-sign"></span> No service request has been made by <?=$client['name']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
   </div>