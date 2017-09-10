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
   $a ="";
   if($type =='Service')
   {
       #if its a service request it search information from service request table from database...
       $request =$logic->getServiceRequestById($rid);
       $Rrequest = mysqli_fetch_assoc($request);
       $result=$logic->updateStatusS('readed',$rid);
   }
   else if($type =='Maintanance')
   {
       #if its a maintanance request it search information from maintanance request table from database...
       $request =$logic->getMaintananceRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $result=$logic->updateStatusM('readed',$rid);
       
   }
   else if($type =='Repair')
   {
       #if they requestered for repair it search information from repair  table from database...
       $request =$logic->getRepairRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $result=$logic->updateStatusR('readed',$rid);       
   }
   else
   {
       #if its a search for survey it search information from survey request request table from database...
       $request =$logic->getSurveyRequestById($rid);#mysli result
       $Rrequest =mysqli_fetch_assoc($request);
       $result=$logic->updateStatusO('readed',$rid);       
   }
   
   $id = $Rrequest["RequestID"];
   if($Rrequest['RequestStatus'] == 'unread'|| $Rrequest['RequestStatus'] == 'readed' )
   {
        $a ='<a href="CreateTask.php?ci='.$_GET['ci'].'&ri='.$_GET['ri'].'&type='.$_GET['RType'].'" class="btn btn-default"><span class="fa fa-eye-open"></span> Send Surveyor</a>
        ';
   }
   else if($Rrequest['RequestStatus'] == 'observed')
   {
     $a='<a href="quotation.php?id='.$id.'&Type='.$_GET['RType'].'&cid='.$_GET['ci'].'" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Create a qoutation</a>
     ';
   }
   else
   {
        $a =' <a href="quotation.php?id='.$id.'&Type='.$_GET['RType'].'&cid='.$_GET['ci'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> View Job Proccess</a>
        ';
   }
$data='<div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h2 class="modal-title text-center" style="color:#888">Request Information</h2>
        </div>
        <div class="modal-body" style="min-height:250px;">
         <div class="col-xs-12">
           <div class="col-xs-6">
            <h4 style="color:#70747a"><span class="glyphicon glyphicon-user"></span><b>  Client Information</b></h4>
            <hr class="bhr"/>
            <div class="col-xs-12">
                <table class="table table-info" style="width:100%">
                    <tr><td> Client Name :</td><td align="right">'.$client['name'].'</td></tr>
                    <tr><td> Phone Number :</td><td  align="right">'.$client['contact_number'].'</td></tr>
                    <tr><td> Email :</td><td align="right">'.$client['email'].'</td></tr>
                    <tr><td>
                    <a href="viewclient.php?view='.$_GET['ci'].'" >View this client?</a>
                    </td></tr>
                </table>
            </div>
           </div>
           <div class ="col-xs-6">
               <h4 style="color:#70747a"><span class="fa fa-cog"></span><b> '.$_GET['RType'].' Information</b></h4>
               <hr class="bhr"/>
               <div class="col-xs-12">
                Requested '.$_GET['RType'].' for '.$logic->getServiceNameByID($Rrequest['ServiceID']).' on '.date_format(date_create($Rrequest['RequestDate']),"l d F Y").'<br/>
                Request description: <br/>
                <textarea rows="3" cols="60" class="form-control" readonly>'.$Rrequest['Description'].' </textarea><br/>
               </div>
           </div>
       </div>
      </div>
   <div class="modal-footer">
   <div class="col-xs-12">
    <div class="col-xs-10" style="text-align:left">
    '.$a.'
    </div>
    </div>
   </div>
';
   echo $data;
}
?>
