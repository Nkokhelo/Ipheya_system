<?php
# 21401824 ME Zenzile
    // include'../logic.php';
    // include'';
    header('Access-Control-Allow-Origin: *');


    $logic = new Logic();
    $allRequest="";
    $allRServie = $logic->getallServiceRequest(); #this is mysqliresult
    $requests= array();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
        $requests[] = $allCR;
     }
    $allRServie = $logic->getallMaintananceRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
       $requests[] = $allCR;

     }
     $allRServie = $logic->getallSurveyRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
       $requests[] = $allCR;
     }
    $allRServie = $logic->getallRepairRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
       $requests[] = $allCR;
     }
     $sortedrequests = $logic->m_sortbydate($requests,'RequestDate');

     foreach($sortedrequests as $client_request)
     {
         $allRequest .="<tr id='itemVeiw' data-toggle='modal' data-target='#myModal' onclick='getInfor(".$client_request['RequestID'].",&#34;".$client_request['RequestType']."&#34;,".$client_request['ClientID'].");'><td>".$logic->getClientNameById($client_request['ClientID']).
         "</td><td>".$client_request['RequestType']."</td><td data-order='".$client_request['RequestDate']."'>".date_format(date_create($client_request['RequestDate']),"d F Y-l")."</td><td>".$logic->getServiceNameByID($client_request['ServiceID'])."</td><td>".$client_request['RequestStatus']."</td></tr>";
     }

#setting the requred information to view all the relevent details for client request

    ?>
