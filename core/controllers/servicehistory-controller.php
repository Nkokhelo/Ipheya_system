<?php
#21408789 Zulu NP
$log = new Logic(); 
$email = $_SESSION['Client'];
$client = $log->getByEmail($email);
$id =$client['client_id'];
$display ="";
$result=mysqli_query($db,"select * from ServiceRequest where ClientID =$id");
    
        $display.= "<table class='table table-hover'>";
        $display.= "<tr> <th>Service Name</th> <th>Description</th> <th>Request Date</th> <th>Duration</th><th>Due Date</th> </tr>";
        while ($row=mysqli_fetch_array($result))
        {
                $display.= "<tr>";
                $display.= "<td>" .$log->getServiceNameByID($row['ServiceID'])."</td>";
                $display.= "<td>" .$row['Description']."</td>";
                $display.= "<td>" .$row['RequestDate']."</td>";
                $display.= "<td>" .$row['Duration']."</td>";
                $display.= "<td>" .$row['DueDate']."</td>";
                $display.="</tr>";
            }
            $display.="</table>";
?>
