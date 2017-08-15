<?php

    $logic = new Logic();
    if(isset($_POST['save']))
    {
        $save = "INSERT INTO `expense_income` (`id`, `ei_name`, `ei_date`, `ei_type`, `ei_payment_type`, `ei_amount`, `ref_id`, `supplier_no`, `client_no`, `project_no`, `category_id`) VALUES (null, 'event food', ".$_POST['t_date'].",".$_POST['expense_type'].",".$_POST['payment_type'].", ".$_POST['amount'].", '1', 'S1720ED5A', 'C172060F8', 'PRG0076F6', '14')";
    }  

    $trans_query = "SELECT * FROM expense_income";
    $transactions='';
    $payments =array();
    $project_dd ='';
    $categories_dd='';
    $query = mysqli_query($logic->connect(),$trans_query);

    if(!$query)
    {
        die("Error".mysqli_error($logic->connect()));
    }

    while ($p = mysqli_fetch_assoc($query))
    {
        // $transactions.="<tr><td>".$p['Date']."</td><td>".$p['payment_status']."</td><td>".$p['Amount_Paid']."</td><td style='color:green' align='center'><span class='glyphicon glyphicon-arrow-up'></span></td></tr>";
    }
    $allproject =$logic->getallProjets();
    while($projects = mysqli_fetch_assoc($allproject))
    {
      $project_dd .= "<option value='".$projects['project_no']."'>".$projects["project_name"]."</option>";
    }

    $allproject =$logic->getallcategories();
    while($categories = mysqli_fetch_assoc($allproject))
    {
      $categories_dd .= "<option value='".$categories['id']."'>".$categories["expense_name"]."</option>";
    }
?>    