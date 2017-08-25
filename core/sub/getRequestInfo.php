<?php
include('../logic.php');
$logic=new Logic();

if(isset ($_GET['ri']))
{
   $type = $_GET['RType'];
   $cid = $_GET['ci'];
   $rid = $_GET['ri'];
   $clientQR = $logic->getClientsById($cid);
   $client=mysqli_fetch_assoc($clientQR);
   $request = null;
   if($type =='Service')
   {
       #if its a service request it search information from service request table from database...
       $request =$logic->getServiceRequestById($rid);
       $Rrequest = mysqli_fetch_assoc($request);
   }
   else if($type =='Maintanance')
   {
       #if its a maintanance request it search information from maintanance request table from database...
       $request =$logic->getMaintananceRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);

   }
   else if($type =='Repair')
   {
       #if they requestered for repair it search information from repair  table from database...
       $request =$logic->getRepairRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
   }
   else
   {
       #if its a search for survey it search information from survey request request table from database...
       $request =$logic->getSurveyRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);

   }
   $id = $Rrequest["RequestID"];
$data='<div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h2 class="modal-title text-center" style="color:#888">Request Information</h2>
        </div>
        <div class="modal-body" style="min-height:250px;" >
         <div class="col-xs-12">
           <div class="col-lg-6">
            <h4 style="color:#70747a"><span class="glyphicon glyphicon-user"></span><b>  Client Information</b></h5>
            <hr class="bhr"/>
            <div class="col-sm-12">
                <table class="table" style="width:100%">
                    <tr><td> Client Name :</td><td align="right">'.$client['name'].'</td></tr>
                    <tr><td> Phone Number :</td><td  align="right">'.$client['contact_number'].'</td></tr>
                    <tr><td> Email :</td><td align="right">'.$client['email'].'</td></tr>
                    <tr><td></td></tr>
                </table>
            </div>
           </div>
           <div class ="col-lg-6">
               <h4 style="color:#70747a"><span class="glyphicon glyphicon-cog"></span><b> '.$_GET['RType'].' Information</b></h4>
               <hr class="bhr"/>
               Requested '.$_GET['RType'].' is for '.($logic->getServiceNameByID($Rrequest['RequestDate'])).' on'.$Rrequest['RequestDate'].'<br/>
               Client description: <br/>
               <textarea rows="3" cols="60" class="form-control" readonly>'.$Rrequest['Description'].' </textarea><br/>
               Status : '.$Rrequest['RequestStatus'].'
           </div>
       </div>  
      </div>         
   <div class="modal-footer">
   <div class="col-xs-12">
    <div class="col-xs-10">
      <a href="CreateTask.php?ci='.$_GET['ci'].'&ri='.$_GET['ri'].'&type='.$_GET['RType'].'" class="btn btn-default"><span class="glyphicon glyphicon-tasks"></span> Create Task</a>
      <a href="quotation.php?id='.$id.'&Type='.$_GET['RType'].'&cid='.$_GET['ci'].'" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Create a qoutation</a>
      <a href="client_view.php?id='.$_GET['ci'].'" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> View '.$client['name'].'s history</a>
    </div>
    </div>
   </div>
';
   echo $data;
}
?>