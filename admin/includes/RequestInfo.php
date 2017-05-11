<?php
    //  include('../core/logic.php');
    //  require_once('../core/controllers/client-controller.php');
    //  include('includes/employee-session.php');
?>
<div class="col-lg-12">
    <h3>Request Information</h3><hr/>
   <div class="">
        <div class="col-lg-8">
        <h4><b>Client Information <span class="glyphicon glyphicon-user"> </b></h5>
        <table style="width:100%">
            <tr><td></span> Client Name :</td><td align='right'><?= $client['name'] ?></td></tr>
            <tr><td>Phone Number :</td><td  align='right'><?= $client['contact_number'] ?></td></tr>
            <tr><td> Email :</td><td align='right'><?= $client['email'] ?></td></tr>
            <tr><td></td></tr>
        </table>
       
    </div>
    <!--<div class="col-lg-6">
               
    </div>-->
   </div>
    <div class ="col-lg-12">
        <hr/>
        <h4><b><?=$_GET['RType']?> Information</b> <span class="glyphicon glyphicon-cog"></span></h4>
        Requested <?=$_GET['RType']?> is for <?=$logic->getServiceNameByID($Rrequest['RequestDate'])?> on <?= $Rrequest['RequestDate']?><br/>
         Client description: <br/>
        <textarea rows="3" cols="60" readonly><?= $Rrequest['Description']?> </textarea><br/>
        Status : <?=$Rrequest['RequestStatus']?>
        <hr/>
          <table style="width:100%" align="center">
            <tr>
            <?php
                $id = $Rrequest['RequestID'];
                echo "<td> <a href='clients.php' style='text-align:center;'><span style='font-size:20px' class='glyphicon glyphicon-info-sign'><br/></span><br/> <span style='font-size:11px'>View Nkokhelo</span></a></td>
                <td><a href='clients.php' style='text-align:center;'><span style='font-size:20px' class='glyphicon glyphicon-list-alt'></span> <br/> <span style='font-size:11px'>all clientss </span></a></td>
                <td><a  href='clients.php' style='text-align:center;'><span style='font-size:20px' class='glyphicon glyphicon-trash'></span> <br/> <span style='font-size:11px'>Delete this client</span></a></td>
                <td><a  href='quotation.php?sid=$id' style='text-align:center;'><span style='font-size:20px' class='glyphicon glyphicon-plus'></span> <br/> <span style='font-size:11px'>New Quotationtion</span></a></td>"
            ?>
                            <td><a  href="../quotation.php" style='text-align:center;'><span style='font-size:20px' class='glyphicon glyphicon-plus'></span> <br/> <span style='font-size:11px'>New Quotationtion</span></a></td>"

             </tr>
        </table>
    </div>
</div>