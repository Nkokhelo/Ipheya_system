<?php

    $logic = new Logic();

    $trans_query = "SELECT * FROM expenses";
    $transactions='';
    $payments =array();

    $query = mysqli_query($logic->connect(),$trans_query);
    if(!$query)
    {
        die("Error".mysqli_error($logic->connect()));
    }
    while ($p = mysqli_fetch_assoc($query))
    {
        $transactions.="<tr><td>".$p['Date']."</td><td>".$p['payment_status']."</td><td>".$p['Amount_Paid']."</td><td style='color:green' align='center'><span class='glyphicon glyphicon-arrow-up'></span></td></tr>";
    }
    $project_dd='';
    $allproject =$logic->getallProjets();
    while($projects = mysqli_fetch_assoc($allproject))
    {
      $project_dd = "<option>".$project["name"]."</option>";
    }
?>