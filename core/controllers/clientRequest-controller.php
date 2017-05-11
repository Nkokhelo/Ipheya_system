<?php
    // include'../logic.php';
    // include'';

    $logic = new Logic();
    $allRequest="";
    $allRServie = $logic->getallServiceRequest(); #this is mysqliresult
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' href='clientRequest.php?ri=".$allCR['RequestID']."&RType=".$allCR['RequestType']."&ci=".$allCR['ClientID']."'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".$allCR['RequestDate']."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
         
     }
    $allRServie = $logic->getallMaintananceRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' href='clientRequest.php?ri=".$allCR['RequestID']."&RType=".$allCR['RequestType']."&ci=".$allCR['ClientID']."'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".$allCR['RequestDate']."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
     }
#setting the requred information to view all the relevent details for client request
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
            $request =$logic->getServiceRequestById($rid);#mysli result
            $Rrequest = mysqli_fetch_assoc($request);
            // $serviceName = $logic->getServiceNameByID($Rrequest['ServiceID']);
        }
        else if($type =='Maintanance')
        {
            $request =$logic->getMaintananceRequestById($rid);#mysli result
            $Rrequest =mysqli_fetch_assoc($request);
            // $serviceName = $logic->getServiceNameByID($Rrequest['ServiceID']);

        }
        else if($type =='Repair')
        {
            $request =$logic->getRepairRequestById($rid);#mysli result
            $Rrequest =mysqli_fetch_assoc($request);
            // $serviceName = $logic->getServiceNameByID($Rrequest['ServiceID']);
        }
        else 
        {
            $request =$logic->getSurveyRequestById($rid);#mysli result
            $Rrequest =mysqli_fetch_assoc($request);
            // $serviceName = $logic->getServiceNameByID($Rrequest['ServiceID']);

        }


     }
?>