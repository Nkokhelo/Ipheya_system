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
     $allRServie = $logic->getallSurveyRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' href='clientRequest.php?ri=".$allCR['RequestID']."&RType=".$allCR['RequestType']."&ci=".$allCR['ClientID']."'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".$allCR['RequestDate']."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
     }
    $allRServie = $logic->getallRepairRequest();
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
     }
?>