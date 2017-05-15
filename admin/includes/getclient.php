<?php
  if(isset($_GET['cid']))
   {
       include '../../core/logic.php';
       $logic = new Logic();
       if($_GET['cid']==0)
       {
           $client_information="<div class='alert alert-warning'>No client has been selected</div>";
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
        if($name ='')
        {
             $client_information ="<div class='alert alert-warning'>No client has been selected</div>";
        }
            echo $client_information;

   }

?>