
<!-- Modal -->
<div id="myModal" class="modal modal-lg fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Information</h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-12">
                <div class="col-lg-8">
                <h4 style="color:#70747a"><span class="glyphicon glyphicon-user"></span><b>  Client Information</b></h5>
                <hr class="bhr"/>
                <div class="col-sm-12">
                    <table class="table" style="width:100%">
                        <tr><td> Client Name :</td><td align='right'><?= $client['name'] ?></td></tr>
                        <tr><td> Phone Number :</td><td  align='right'><?= $client['contact_number'] ?></td></tr>
                        <tr><td> Email :</td><td align='right'><?= $client['email'] ?></td></tr>
                        <tr><td></td></tr>
                    </table>
                </div>
            </div>
        </div>
        <hr class="bhr" style="width:100%"/>
        <div class ="col-lg-12">
            <h4 style="color:#70747a"><span class="glyphicon glyphicon-cog"></span><b> <?=$_GET['RType']?> Information</b></h4>
            <hr class="bhr"/>
            Requested <?=$_GET['RType']?> is for <?=($logic->getServiceNameByID($Rrequest['RequestDate']))?> on <?= $Rrequest['RequestDate']?><br/>
            Client description: <br/>
            <textarea rows="3" cols="60" class="form-control" readonly><?= $Rrequest['Description']?> </textarea><br/>
            Status : <?=$Rrequest['RequestStatus']?>
            <?php $id = $Rrequest['RequestID'];?>
        </div>
        <hr class="bhr"/>
        <div class="col-sm-12">
                <a href="CreateTask.php?ci=<?=$_GET['ci']?>&ri=<?=$_GET['ri']?>&type=<?=$_GET['RType']?>" class="btn btn-default"><span class="glyphicon glyphicon-tasks"></span> Create Task</a>
                <a href="quotation.php?id=<?=$id?>&Type=<?=$_GET['RType']?>&cid=<?=$_GET['ci']?>" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Create a qoutation</a>
                <a href="client_view.php?id=<?=$_GET['ci']?>" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> View <?=$client['name']?>'s history</a>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>