<?php
#this should be included in clientRequest.php 

    $logic = new Logic();
#find a client for a quotation request 
     $client_information="The client information for a quotation will be here";
     $clientQ = $logic->getallClients();
      
     $options ='';
     while($allclients=mysqli_fetch_assoc($clientQ))
     {
         $id = $allclients['client_id'];
         $name = $allclients['name'];
         $options.="<option name='clientid' value='$id'>$name</option>";
     }


   if(isset($_POST['submit']))
   {
        $Title=$_POST['title'];
        $Summary=$_POST['summary'];	
        $PaymentMethord	=$_POST['paymentmethod'];
        $AmountDue=$_POST['TotalPrice']; 
        $ExpiringDate	=$_POST['edate'];
        $QoutationDate=$_POST['qdate'];
        $RequestID= $_POST['Req_id'];
        $RequestType = $_POST['serviceType'];
        $date = date('Y-m-d');//we take a date
        $qoute_unique = uniqid();//generate unique id
        $qoute_no ="Q".substr($date,2,2).substr($date,0,2).strtoupper(substr($qoute_unique,4,4));
#you cannot view quotaion page without the request
        $addInsert = "INSERT INTO `qoutation` (`QoutationID`, `Title`, `Summary`, `PaymentMethord`, `AmountDue`, `ExpiringDate`, `QoutationDate`, `RequestID`,`RequestType`) VALUES 
                                        ({$qoute_no}, '{$Title}', '{$Summary}', '{$PaymentMethord}', '{$AmountDue}', '{$ExpiringDate}', '{$QoutationDate}', '{$RequestID}',,'{$RequestType}')";
        
        if(!mysqli_query($db,$addInsert))
        {
            echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>Error! '.mysqli_error($db).'</div><br/>'.$addInsert;
        }
        else
        {
            $names = $_POST['IName'];
            $descrs = $_POST['IDescription'];
            $quants = $_POST['IQuantiy'];
            $units = $_POST['IUnitPrice'];
            $pricequants = $_POST['IPQ'];
#test

#end-test
            if(!mysqli_query($db,"INSERT INTO client_r_q VALUES('$RequestID','$qoute_no','$RequestType')"))
            {
                die("Error in clientRQ".mysqli_error($db));
            }

            for($i=0; $i<count($names); $i++)
            {
                $quert ="INSERT INTO qoutationitems VALUES(NULL,'$names[$i]','$descrs[$i]','$units[$i]','$quants[$i]','$pricequants[$i]','$QouteId')";
                if(!mysqli_query($db,$quert))
                {
                    die('Error Item'.mysqli_error($db));
                }
            }
            header('Location : Qoutations.php');
            exit();
        }
   }

    if(isset($_POST['pdf_con']))
   {
  
        $Title=$_POST['title'];
        $Summary=$_POST['summary'];	
        $PaymentMethord	=$_POST['paymentmethod'];
        $AmountDue=$_POST['TotalPrice'];
        $ExpiringDate	=$_POST['edate'];
        $QoutationDate=$_POST['qdate'];
        $RequestID= $_POST['Req_id'];
        $RequestType = $_POST['serviceType'];
        $date = date('Y-m-d');//we take a date
        $qoute_unique = uniqid();//generate unique id
        $qoute_no ="Q".substr($date,2,2).substr($date,0,2).strtoupper(substr($qoute_unique,4,4));

        #you cannot view quotaion page without the request
       $addInsert = "INSERT INTO `qoutation` (`QoutationID`, `Title`, `Summary`, `PaymentMethord`, `AmountDue`, `ExpiringDate`, `QoutationDate`, `RequestID`,`RequestType`) VALUES ('{$qoute_no}', '{$Title}', '{$Summary}', '{$PaymentMethord}', '{$AmountDue}', '{$ExpiringDate}', '{$QoutationDate}', '{$RequestID}','{$RequestType}')";
        if(!mysqli_query($db,$addInsert))
        {
            die('Error! Inserting'.mysqli_error($db));
        }
        else
        {
                $names = $_POST['IName'];
                $descrs = $_POST['IDescription'];
                $quants = $_POST['IQuantiy'];
                $units = $_POST['IUnitPrice'];
                $pricequants = $_POST['IPQ'];
                $success =1;
                if(!mysqli_query($db,"INSERT INTO client_r_q VALUES('$RequestID','$qoute_no','$RequestType')"))
                {
                    die("Error in clientRQ".mysqli_error($db));
                }
                else
                {
                    for($i=0; $i<count($names); $i++)
                    {
                        $quert ="INSERT INTO `qoutationitems`(`QoutationItemID`,`Name`,`Description`,`UnitPrice`,`Quantity`,`TotalPrice`,`Status`,`QoutationID`) VALUES(NULL,'$names[$i]','$descrs[$i]','$units[$i]','$quants[$i]','$pricequants[$i]','N','$qoute_no')";
                        if(!mysqli_query($db,$quert))
                        {
                            die('Error in Item'.mysqli_error($db)."\n {$quert}");
                            $success=0;
                        }
                        else
                        {
                            $success=1;
                        }
                    }

                    if($success==1)
                    {
                        // session_start();
                        $_SESSION['title']=$_POST['title'];
                        $_SESSION['qoute_no']=$qoute_no;
                        $_SESSION['Summary']=$_POST['summary'];
                        $_SESSION['PaymentMethord']	=$_POST['paymentmethod'];
                        $_SESSION['AmountDue']=$_POST['TotalPrice'];
                        $_SESSION['ExpiringDate']	=$_POST['edate'];
                        $_SESSION['QoutationDate']=$_POST['qdate'];
                        $_SESSION['RequestID']= $_POST['Req_id'];
                        $_SESSION['RequestType'] = $_POST['serviceType'];
                        $_SESSION['names'] = $_POST['IName'];
                        $_SESSION['descrs'] = $_POST['IDescription'];
                        $_SESSION['quants'] = $_POST['IQuantiy'];
                        $_SESSION['units'] = $_POST['IUnitPrice'];
                        $_SESSION['pricequants'] = $_POST['IPQ'];
                        $_SESSION['clientID']=$_POST['clientid'];
                        $_SESSION['client_no']=$_POST['clientid'];
                        echo "<script> location.replace('QoutePDF.php'); </script>";
                        // header("Location : QoutePDF.php");
                        exit();
                    }
                }
            }
        }
        //  $options.="<option value='$id'>$name</option>";
    //  }
   if(isset($_GET['cid']))
   {
       if($_GET['cid']==0)
       {
           $client_information="No client has been selected";
            return TRUE;
       }
        $clientQ = $logic->getClientsById($_GET['cid']);
        $client = mysqli_fetch_assoc($clientQ);
        $name = $client['name'];
        $address = $client['postal_address'];
        $email = $client['email'];
        $phone = $client['contact_number'];
        $client_no = $client['client_no'];
         $client_information = "<table>
										<tr><th>Name </th><td>: $name</td></tr>
										<tr><th>Address </th><td>: $address</td></tr>
										<tr><th>Email </th><td>: $email</td></tr>
										<tr><th>Phone </th><td>: $phone</td></tr>
									</table>";

    // $idg=$_GET['cid'];
    // $selected = "seleted='selected'";
    // $clientQ = $logic->getallClients();
    // $options ='';
    //  while($allclients=mysqli_fetch_assoc($clientQ))
    //  {
    //      $id = $allclients['client_id'];
    //      $name = $allclients['name'];
    //      if($id == $idg)
    //      {
    //          $options.="<option  value='$id'selected='selected'>$name</option>";
    //      }
    //      else
    //      {
    //           $options.="<option  value='$id'>$name</option>";
    //      }
    //  }

   }

   $allQoute="";
   $sqlResult = $logic->getallQoutations();

   while($allQ =mysqli_fetch_assoc($sqlResult))
   {
        $allQoute .="<tr><td>".$allQ['Title']."</td><td>".$allQ['QoutationDate']."</td><td>".$allQ['ExpiringDate']."</td><td><a href='../client/qoutationView.php?viewQ=".$allQ['QoutationID']."'/>View</a></td></tr>";
   }

  if(isset($_GET['viewQ']))
  {
       $q_id = $_GET['viewQ'];
        $Title= $Summary=$PaymentMethord=$AmountDue=$ExpiringDate= $QoutationDate=$deposit='';
       $qouteSQL = $logic->getQoutationById($q_id);
       if($qouteSQL=='')
       {
            die("Error ".mysqli_error($logic->connect()));
       }
       while ($qoute = mysqli_fetch_assoc($qouteSQL))
       {
            $Title=$qoute['Title'];
            $Summary=$qoute['Summary'];
            $PaymentMethord=$qoute['PaymentMethord'];
            $AmountDue=$qoute['AmountDue'];
            $ExpiringDate=$qoute['ExpiringDate'];
            $QoutationDate=$qoute['QoutationDate'];
            $deposit =($PaymentMethord/100)*$AmountDue;

       }
       $allQItems='';
       $sqloQ = $logic->getallQoutationItemsByQid($q_id);
       while($items = mysqli_fetch_assoc($sqloQ))
       {
         $allQItems.="<tr><td>".$items['Name']."</td><td>".$items['Description']."</td><td>".$items['UnitPrice']."</td><td>".$items['Quantity']."</td><td>".$items['TotalPrice']."</td></tr>";
       }
         $allQItems.="<tr><td></td><td></td><td></td><td><b>Amount Due</b></td><td>".$AmountDue."</td></tr>";

         if(isset($_POST['deposit']))
         {
            $_SESSION['message']="10% Quotation Deposit";
		    $_SESSION['amount']=$deposit;
		    $_SESSION['payament-status']="Qoutation Deposit";
            header('Location : indexes.php');
            exit();
         }
  }

?>