<?php

    $logic = new Logic();
    $feedback ="";
    $e_trans ="";
    $i_trans="";
    $transactions="";
    $payments =array();
    $project_dd ="";
    $categories_dd="";
    $clients_dd="";
    $suppliers_dd="";

    if(isset($_POST['save_expence']))
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
        $other = $_POST['other'];
        $ei_description = $_POST['ei_description'];
        
        $save = "INSERT INTO `expense_income` (`id`, `ei_name`, `ei_date`, `ei_type`,`ei_description`, `ei_payment_type`, `ei_amount`, `supplier_no`, `client_no`, `project_no`, `category_id`,`other`,`expense_income`) 
        VALUES (null,'$ei_name','$ei_date','$ei_type','$ei_description','$ei_payment_type','$ei_amount','$supplier_no','$client_no','$project_no','$category_id','$other','e')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)
        {
                die($save);
                $feedback =$logic->display_error(mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Saved successfuly");
        }
    }  
    if(isset($_POST['save_income']))
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
        $other = $_POST['other'];
        $ei_description = $_POST['ei_description'];
        
        $save = "INSERT INTO `expense_income` (`id`, `ei_name`, `ei_date`, `ei_type`,`ei_description`, `ei_payment_type`, `ei_amount`, `supplier_no`, `client_no`, `project_no`, `category_id`,`other`,`expense_income`) 
        VALUES (null,'$ei_name','$ei_date','$ei_type','$ei_description','$ei_payment_type','$ei_amount','$supplier_no','$client_no','$project_no','$category_id','$other','e')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)
        {
                die($save);
                $feedback =$logic->display_error(mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Saved successfuly");
        }
    }  
 

    $allexpense = $logic->getallExpenses();
    while ($expenses = mysqli_fetch_assoc($allexpense))
    {
        $e_trans.="<tr><td>".$expenses['ref_no']."</td><td>".$expenses['ei_name']."</td><td>".$expenses['ei_description']."</td><td align='right'>R".number_format($expenses['ei_amount'],2,","," ")."</td></tr>";
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

    if($e_trans=="")
    {
        $feedback = $logic->display_info("No Expenses at the moment!");
        exit;
    }
?>    