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
         $options.="<option value='$id'>$name</option>";
     }
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
         $client_information = "<table>
										<tr><td>Name :</td><td>$name</td></tr>
										<tr><td>Address :</td><td>$address</td></tr>
										<tr><td>Email :</td><td>$email</td></tr>
										<tr><td>Phone :</td><td>$phone</td></tr>
									</table>";

    $idg=$_GET['cid'];
    $selected = "seleted='selected'";
    $clientQ = $logic->getallClients();
    $options ='';
     while($allclients=mysqli_fetch_assoc($clientQ))
     {
         $id = $allclients['client_id'];
         $name = $allclients['name'];
         if($id == $idg)
         {
             $options.="<option  value='$id'selected='selected'>$name</option>";
         }
         else
         {
              $options.="<option  value='$id'>$name</option>";
         }
     }

   }
   

    

?>