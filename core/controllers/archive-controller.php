<?php
    #21539288 POLELA AL
    #fetch all clients
    $client_query = "SELECT * FROM clients WHERE archived = 1 ORDER BY name";
    $client_exe = mysqli_query($db,$client_query);
    $allClients = '';
    while($clients = mysqli_fetch_assoc($client_exe)) :
      $allClients .= '<tr>
                          <td>'.$clients['name'].' '.$clients['surname'].'</td>
                          <td>'.$clients['email'].'</td>
                          <td>'.$clients['contact_number'].'</td>
                          <td>
                          <a href="archives.php?restore='.$clients['client_id'].'" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>
                          </td>
                        </tr>';
    endwhile;
    #restore archived account
    if(isset($_GET['restore'])){
      $restore_id = mysqli_real_escape_string($db,$_GET['restore']);
      $restore_id = sanitize($restore_id);

      $restore = "UPDATE clients SET archived = 0 WHERE client_id = '$restore_id'";
      mysqli_query($db,$restore);
      header('Location: archives.php');
    }
 ?>
