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
    </div>
    <div class ="col-lg-12">
        <hr/>
        <h4><b><?=$_GET['RType']?> Information</b> <span class="glyphicon glyphicon-cog"></span></h4>
        Requested <?=$_GET['RType']?> is for <?=$logic->getServiceNameByID($Rrequest['RequestDate'])?> on <?= $Rrequest['RequestDate']?><br/>
         Client description: <br/>
        <textarea rows="3" cols="60" readonly><?= $Rrequest['Description']?> </textarea><br/>
        Status : <?=$Rrequest['RequestStatus']?>
        <hr/>
        <?php $id = $Rrequest['RequestID'];?>
        <a href="" class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span> Surveying Date</a>
        <a href="quotation.php?id=<?=$id?>&Type=<?=$_GET['RType']?>" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Make Qoutation</a>
        <a href="quotation.php" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> View <?=$client['name']?></a>
    </div>
</div>