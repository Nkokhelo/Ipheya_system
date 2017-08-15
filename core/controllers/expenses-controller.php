<?php

    $logic = new Logic();
<<<<<<< HEAD
    if(isset($_POST['save']))
    {
        
    }
    $trans_query = "SELECT * FROM expenses";
    $transactions='';
    $payments =array();
    $project_dd ='';
    $categories_dd='';
=======

    $trans_query = "SELECT * FROM expenses";
    $transactions='';
    $payments =array();

>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
    $query = mysqli_query($logic->connect(),$trans_query);
    if(!$query)
    {
        die("Error".mysqli_error($logic->connect()));
    }
    while ($p = mysqli_fetch_assoc($query))
    {
        $transactions.="<tr><td>".$p['Date']."</td><td>".$p['payment_status']."</td><td>".$p['Amount_Paid']."</td><td style='color:green' align='center'><span class='glyphicon glyphicon-arrow-up'></span></td></tr>";
    }
<<<<<<< HEAD
    $allproject =$logic->getallProjets();
    while($projects = mysqli_fetch_assoc($allproject))
    {
      $project_dd .= "<option value='".$projects['project_no']."'>".$projects["project_name"]."</option>";
    }

    $allproject =$logic->getallcategories();
    while($categories = mysqli_fetch_assoc($allproject))
    {
      $categories_dd .= "<option value='".$categories['id']."'>".$categories["expense_name"]."</option>";
=======
    $project_dd='';
    $allproject =$logic->getallProjets();
    while($projects = mysqli_fetch_assoc($allproject))
    {
      $project_dd = "<option>".$project["name"]."</option>";
>>>>>>> b7201f99d71a057ccf7d40f9bbc90ed5be45eafe
    }
?>