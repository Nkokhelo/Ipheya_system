<?php
    $logic = new Logic();
    if(isset($_POST['Submit']))
    {
       $Subject = $_POST['Subject'];
       $RequestType =$_POST['RequestType'];
       $ProblemDescription = $_POST['ProblemDescription'];
       $date = date('Y-m-d');

       if(empty($Subject))
       {
            $error ="The Subject is requred";
       }
       if(empty($RequestType))
       {
            $error ="type of is requred";
       }
       if(empty($ProblemDescription))
       {
            $error ="The Subject is requred";
       }


          $Subject = mysqli_real_escape_string($db,$Subject);
          $Subject = sanitize($Subject);
          $RequestType = mysqli_real_escape_string($db,$RequestType);
          $RequestType = sanitize($RequestType);
          $ProblemDescription = mysqli_real_escape_string($db,$ProblemDescription);
          $ProblemDescription = sanitize($ProblemDescription);

          #fetch client
          $sqlpar = $_SESSION['Client'];
          $sql = mysqli_query($db,"SELECT * FROM clients WHERE email = '$sqlpar'");
          if(!$sql){
            echo mysqli_error($db);
          }
          $client = mysqli_fetch_assoc($sql);
          $ClientId = $client['client_id'];

           $insert ="INSERT INTO ticket(ClientID,Subject,RequestType,ProblemDescription,Status,DatePlaced) VALUES('{$ClientId}','{$Subject}','{$RequestType}','{$ProblemDescription}','Pending',NOW())";
          if(!mysqli_query($db,$insert))
          {
            die('Error'.mysqli_error($db));
          }
          else{
            $sql = mysqli_query($db,"SELECT * FROM ticket ORDER BY DatePlaced DESC Limit 1");
            $t = mysqli_fetch_assoc($sql);
            #header('Location: CreateTicket.php?id='.$t['Id']);
            die(
            "<h3>Thank you for reporting we will call you soon!</h3><br/>
            <div class='col-md-8 col-offset-2'>Ticket No :".$t['Id']."<br/> Subject:$Subject<br/>Request Date:$date<br/>
             <a href='home.php' class='btn btn-sm btn-default' > Home</a></div>"
             );
          }
    }
   #select all new tickets to be view by admin
   $tickets = mysqli_query($db,"SELECT * FROM Ticket WHERE DatePlaced >= DATE_ADD(CURDATE(), INTERVAL - 7 DAY)");
   $newtickets = $acknowledged = $resolved = $pending = '';
   while($ticket = mysqli_fetch_assoc($tickets)):
      #select client associated with ticket
      $c_id = $ticket['ClientID'];
      $fetch_client  = mysqli_query($db,"SELECT * FROM clients WHERE client_id = '$c_id'");
      $c = mysqli_fetch_assoc($fetch_client);
      if($ticket['Status'] == 'Pending'){
        $class = 'text-danger';
      }
      else if($ticket['Status'] == 'Acknowledged'){
        $class = 'text-warning';
      }
      else if($ticket['Status'] == 'Resolved'){
        $class = 'text-success';
      }
      $newtickets .= '<div class="row">
                         <p style="border-bottom:1px solid #E1E5E8;">
                           <a style="font-weight:400;font-size:1.2em;" href="Tickets.php?id='.$ticket['Id'].'">'.$ticket['Subject'].'</a><br>
                           <a style="color:#1997E6;text-decoration:none;" href="#">'.substr($c['name'],0,1).' '.$c['surname'].'</a>
                           <a style="text-decoration:none;" class="'.$class.' pull-right" href="#">'.$ticket['Status'].'</a>
                         </p>
                      </div>';
      if($ticket['Status']=='Acknowledged'){
        $acknowledged .= '<div class="row">
                            <p style="border-bottom:1px solid #E1E5E8;">
                              <a style="font-weight:400;font-size:1.2em;" href="Tickets.php?id='.$ticket['Id'].'">'.$ticket['Subject'].'</a><br>
                              <a style="color:#1997E6;text-decoration:none;" href="#">'.substr($c['name'],0,1).' '.$c['surname'].'</a>
                              <a style="text-decoration:none;" class="'.$class.' pull-right" href="#">'.$ticket['Status'].'</a>
                            </p>
                          </div>';
      }
      if($ticket['Status']=='Pending'){
        $pending .= '<div class="row">
                            <p style="border-bottom:1px solid #E1E5E8;">
                              <a style="font-weight:400;font-size:1.2em;" href="Tickets.php?id='.$ticket['Id'].'">'.$ticket['Subject'].'</a><br>
                              <a style="color:#1997E6;text-decoration:none;" href="#">'.substr($c['name'],0,1).' '.$c['surname'].'</a>
                              <a style="text-decoration:none;" class="'.$class.' pull-right" href="#">'.$ticket['Status'].'</a>
                            </p>
                          </div>';
      }
      if($ticket['Status']=='Resolved'){
        $resolved .= '<div class="row">
                            <p style="border-bottom:1px solid #E1E5E8;">
                              <a style="font-weight:400;font-size:1.2em;" href="Tickets.php?id='.$ticket['Id'].'">'.$ticket['Subject'].'</a><br>
                              <a style="color:#1997E6;text-decoration:none;" href="#">'.substr($c['name'],0,1).' '.$c['surname'].'</a>
                              <a style="text-decoration:none;" class="'.$class.' pull-right" href="#">'.$ticket['Status'].'</a>
                            </p>
                          </div>';
      }
   endwhile;
   #selecting common issues
   $commArr = array('image','server','screen','apps','wifi','newtwork','pages');
   $common = '';
   foreach($commArr as $compar):
     $common_tickets = mysqli_query($db,"SELECT * FROM Ticket WHERE Subject LIKE '$compar%'");
     #preparing results for display
     while($commont = mysqli_fetch_assoc($common_tickets)):
      if($commont['Status'] == 'Pending'){
        $class = 'text-danger';
      }
      else if($commont['Status'] == 'Acknowledged'){
        $class = 'text-warning';
      }
      else if($commont['Status'] == 'Resolved'){
        $class = 'text-success';
      }
        $common .= '<div class="row">
                        <p style="border-bottom:1px solid #E1E5E8;">
                          <a style="font-weight:400;font-size:1.2em;" href="Tickets.php?id='.$commont['Id'].'">'.$commont['Subject'].'</a><br>
                          <a style="color:#1997E6;text-decoration:none;" href="#">'.substr($c['name'],0,1).' '.$c['surname'].'</a>
                          <a style="text-decoration:none;" class="'.$class.' pull-right" href="#">'.$commont['Status'].'</a>
                        </p>
                    </div>';
      endwhile;
   endforeach;

   #display details
   $id = 0;
   if(isset($_GET['id'])){
     $id = mysqli_real_escape_string($db, $_GET['id']);
     $tquery = mysqli_query($db,"SELECT * FROM Ticket WHERE Id='$id'");
     $tresult = mysqli_fetch_assoc($tquery);
     $cid = $tresult['ClientID'];
     $customer = mysqli_query($db,"SELECT * FROM clients WHERE client_id = '$cid'");
     $custresult = mysqli_fetch_assoc($customer);
     if($tresult['Status'] != 'Resolved'){
       mysqli_query($db,"UPDATE ticket SET Status = 'Acknowledged' WHERE Id = '$id'");
     }
   }
   if(isset($_GET['Value']))
   {
     $email=mysqli_real_escape_string($db,$_GET['Value']);
     $id=$logic->getClientIdByEmail($email);
     $history=mysqli_query($db,"SELECT * FROM ticket WHERE ClientID = '$id'");
     $existingtickets = ''; $pos = 0;
     while($thistory = mysqli_fetch_assoc($history)):
        $pos+=1;
        $existingtickets .= '<tr>
                                <td>'.$pos.'</td>
                                <td>'.$thistory['Subject'].'</td>
                                <td>'.$thistory['Status'].'</td>
                             </tr>';
     endwhile;
     #select history of requests
     $requesthistory = mysqli_query($db,"SELECT * FROM servicerequest WHERE ClientID = '$id'");
     $existingrequests = ''; $num = 0;
     while($rhistory = mysqli_fetch_assoc($requesthistory)):
        $num+=1;
        $existingrequests .= '<tr>
                                <td>'.$num.'</td>
                                <td>'.$rhistory['RequestType'].'</td>
                             </tr>';
     endwhile;
   }
   /* if(isset($_GET['id']))
   {
     id=mysqli_real_escape_string($db,$_GET['id']);
     $history=mysqli_query($db,"SELECT * FROM Ticket WHERE Id='$id'");

   }*/
?>
