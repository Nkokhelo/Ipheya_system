<?php
    //  include('../core/logic.php');
    //  require_once('../core/controllers/client-controller.php');
    //  include('includes/employee-session.php');
?>
<div class="col-lg-12">
    <h2 style="color:#808080">Request Information</h2><hr class="bhr"/>
    <div class="">
            <div class="col-lg-8">
            <h4 style="color:#70747a"><b>Client Information <span class="glyphicon glyphicon-user"> </b></h5>
            <hr class="bhr"/>
            <table class="table" style="width:100%">
                <tr><td> Client Name :</td><td align='right'><?= $client['name'] ?></td></tr>
                <tr><td> Phone Number :</td><td  align='right'><?= $client['contact_number'] ?></td></tr>
                <tr><td> Email :</td><td align='right'><?= $client['email'] ?></td></tr>
                <tr><td></td></tr>
            </table>
        
        </div>
    </div>
     <hr class="bhr"/>
    <div class ="col-lg-12">
        <h4 style="color:#70747a"><b><?=$_GET['RType']?> Information</b> <span class="glyphicon glyphicon-cog"></span></h4>
        <hr class="bhr"/>
         Requested <?=$_GET['RType']?> is for <?=$logic->getServiceNameByID($Rrequest['RequestDate'])?> on <?= $Rrequest['RequestDate']?><br/>
         Client description: <br/>
        <textarea rows="3" cols="60" class="form-control" readonly><?= $Rrequest['Description']?> </textarea><br/>
        Status : <?=$Rrequest['RequestStatus']?>
        <?php $id = $Rrequest['RequestID'];?>
       </div>
       <hr class="bhr"/>
       <div class="col-sm-12">
            <a href="" class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span> Surveying Date</a>
            <a href="quotation.php?id=<?=$id?>&Type=<?=$_GET['RType']?>" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Make Qoutation</a>
            <a href="quotation.php" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> View <?=$client['name']?></a>
        </div>
</div>