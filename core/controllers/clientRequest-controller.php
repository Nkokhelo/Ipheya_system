<?php
# 21401824 ME Zenzile
    // include'../logic.php';
    // include'';
    header('Access-Control-Allow-Origin: *');
    

    $logic = new Logic();
    $allRequest="";
    $allRServie = $logic->getallServiceRequest(); #this is mysqliresult
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' data-toggle='modal' data-target='#myModal' onclick='getInfor(".$allCR['RequestID'].",&#34;".$allCR["RequestType"]."&#34;,".$allCR['ClientID'].");'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".date_format(date_create($allCR['RequestDate']),"d F Y-l")."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
     }
    $allRServie = $logic->getallMaintananceRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' data-toggle='modal' data-target='#myModal' onclick='getInfor(".$allCR['RequestID'].",&#34;".$allCR['RequestType']."&#34;,".$allCR['ClientID'].");'>
           <td>".$logic->getClientNameById($allCR['ClientID'])."</td>
           <td>".$allCR['RequestType']."</td>
           <td>".date_format(date_create($allCR['RequestDate']),"d F Y-l")."</td>
           <td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td>
           <td>".$allCR['RequestStatus']."</td>
          </tr>";
     }
     $allRServie = $logic->getallSurveyRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' data-toggle='modal' data-target='#myModal' onclick='getInfor(".$allCR['RequestID'].",&#34;".$allCR['RequestType']."&#34;,".$allCR['ClientID'].");'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".date_format(date_create($allCR['RequestDate']),"d F Y-l")."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
     }
    $allRServie = $logic->getallRepairRequest();
     while($allCR = mysqli_fetch_assoc($allRServie))
     {
         $allRequest .="<tr id='itemVeiw' data-toggle='modal' data-target='#myModal' onclick='getInfor(".$allCR['RequestID'].",&#34;".$allCR['RequestType']."&#34;,".$allCR['ClientID'].");'><td>".$logic->getClientNameById($allCR['ClientID'])."</td><td>".$allCR['RequestType']."</td><td>".date_format(date_create($allCR['RequestDate']),"d F Y-l")."</td><td>".$logic->getServiceNameByID($allCR['ServiceID'])."</td><td>".$allCR['RequestStatus']."</td></tr>";
     }
#setting the requred information to view all the relevent details for client request

    ?>
