<?php

    $logic = new Logic();
    $feedback ="";
    if(isset($_POST['save']))
    {
        $project_no=$_POST['project_no'];
        $ei_name =$_POST['ei_name'];
        $ei_date =$_POST['ei_date'];
        $ei_type =$_POST['ei_type'];
        $ei_payment_type =$_POST['ei_payment_type'];
        $ei_amount =$_POST['ei_amount'];
        $ref_id=$_POST['ref_id'];
        $supplier_no= $_POST ['supplier_no'];
        $client_no=$_POST['client_no'];
        $category_id= $_POST['category_id'];
        
        $save = "INSERT INTO `expense_income` (`id`, `ei_name`, `ei_date`, `ei_type`, `ei_payment_type`, `ei_amount`, `ref_id`, `supplier_no`, `client_no`, `project_no`, `category_id`) 
        VALUES (null,'$ei_name','$ei_date','$ei_type','$ei_payment_type','$ei_amount','$ref_id','$supplier_no','$client_no','$project_no','$category_id')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)
        {
            // die(mysqli_error($logic->connect()));
                $feedback =$logic->display_error(mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Saved successfuly");
        }
    }  
        
    
    $trans_query = "SELECT * FROM expense_income";
    $transactions='';
    $payments =array();
    $project_dd ='';
    $categories_dd='';
    $clients_dd='';
    $suppliers_dd='';
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

    $allproject =$logic->getallSuppliers();
    while($suppliers = mysqli_fetch_assoc($allproject))
    {
      $suppliers_dd .= "<option value='".$suppliers['supplier_no']."'>".$suppliers["company_name"]."</option>";
    }

    $allproject =$logic->getallClients();
    while($clients = mysqli_fetch_assoc($allproject))
    {
      $clients_dd .= "<option value='".$clients['client_no']."'>".$clients["name"]."</option>";
    }
?>    