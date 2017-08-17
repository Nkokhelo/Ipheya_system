<?php
    $logic = new Logic();
#items to be purchased
    if(isset($_GET['purchase']))
    {

        
        $qitems="";
        $feedback1 = array('success'=>'','error'=>'','info'=>'');
        $query = "SELECT * FROM qoutation WHERE status ='A'";
        $result = mysqli_query($db,$query);
            while($qoute = mysqli_fetch_assoc($result)):
                $id = $qoute["QoutationID"];
                $qitems .= "
                        <div id='according' class='panel-group'>
                            <div class='panel panel-default'>
                                <div class='panel-heading'>
                                    <h5 class='panel-title'>
                                    <small>
                                        <a href='#panelBodyOne".$qoute["QoutationID"]."' data-toggle='collapse' data-parent='#according'>".
                                            "".$qoute["QoutationID"]
                                        ."</a>
                                    </small> | 
                                        <small>
                                            ". $qoute['Title']."
                                        </small> - 
                                        <small style='alignt:right'>  ".date("d F Y",time($qoute['QoutationDate']))."
                                        </small> 

                                    </h5>
                                    
                                </div>
                                <div id='panelBodyOne".$qoute["QoutationID"]."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                    <table class='table table-sm table-bordered'>
                                    <thead>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Amount</th>
                                        <th>Order </th>
                                    </thead>
                                    <tbody>";
                                         $result1 = $logic->getallQoutationItemsByQid($qoute['QoutationID']);
                                         if(!$result1)
                                         {
                                             die(mysqli_error($db));
                                         }
                                        while($item = mysqli_fetch_assoc($result1)):
                                           $qitems.=" <tr>
                                                <td>".$item['Name']."</td>
                                                <td align='right'>".number_format($item['Quantity'],null,""," ")."</td>
                                                <td align='right'>".number_format($item['UnitPrice'],2,","," ")."</td>
                                                <td align='right'>".number_format($item['TotalPrice'],2,","," ")."</td>
                                                <td><button data-toggle='modal' onclick='getItem(".$item['QoutationItemID'].")' data-target='#additemModal' class='btn btn-block btn-xs btn-default'><span class='glyphicon glyphicon-plus'></span> Place an order</button></td>
                                            </tr>";
                                        endwhile;
                                $qitems.=" </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div><hr>";
            endwhile;
            $supplierOptions="";
            $result = $logic->getallSuppliers();
            while($supplier = mysqli_fetch_assoc($result)):
                $supplierOptions.= "<option value=".$supplier['supplier_no'].">".$supplier['company_name']."</option>";
            endwhile;
    }

    if(isset($_POST['save']))
    {
        $item_no = $_POST['item_no'];
        $item_code = $_POST['item_code'];
        $supplier = $_POST['supplier'];
        $purchased_quantity = $_POST['quantity'];
        $expected_date =$_POST['expected_date'];
        $unit_price = $_POST['unit_price'];
        $total_price = $_POST['total_price'];
        $item_image = $_POST['item_image'];
        $order_date = date("Y-m-d");
        //compare no of items in qoutations vs purchase if incomplete status = I else = P
        $query_save = "UPDATE `qoutationitems` SET `Status` = 'P' WHERE `qoutationitems`.`QoutationItemID` =".$item_no;
        $result_save = mysqli_query($query_save);
        if($result_save)
        header("Location:additem.php?purchase=any");
    }

    $logic = new Logic();
    $feedback = array('success'=>'','error'=>'','info'=>'');
    $query = "SELECT * FROM `qoutationitems` WHERE status = 'P'";
    $allItems='';
    $sumQ=$sumUP=$sumTP =0;
    $result = mysqli_query($db,$query);
    if(!$result)
    {
        $feedback['error']="<div class='alert alert-danger'><i class='glyphicon glyphicon-warning-sign'></i> Error... something went wrong durring the excecution</div>";
    }
    else
    {
        while($info = mysqli_fetch_assoc($result))
        {
            $allItems .= "<tr>
                <td>".$info['QoutationItemID']."</td>
                <td>".$info['Name']."</td>
                <td>".$logic->getSupplierNameById($info['Supplier'])."</td>
                <td>".date("d F Y",time($info['PurchaseDate']))."</td>
                <td align='right'>".number_format($info['Quantity'],0,"0"," ")."</td>
                <td align='right'>".number_format($info['UnitPrice'],2,","," ")."</td>
                <td align='right'>".number_format($info['TotalPrice'],2,","," ")."</td>
            </tr>";
            $sumQ += $info['Quantity'];
            $sumUP += $info['UnitPrice'];
            $sumTP += $info['TotalPrice'];
        }
    }
    
?>