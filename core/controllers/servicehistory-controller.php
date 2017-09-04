<?php
<<<<<<< HEAD
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
=======
$log = new Logic();
$history="";
$result=mysqli_query($db,'select * from ServiceRequest');

        $history.= "<table class='table table-hover'>";
        $history.= "<tr> <th>Service Name</th> <th>Description</th> <th>Request Date</th> <th>Duration</th><th>Due Date</th> </tr>";
        while ($row=mysqli_fetch_array($result))
        {
                $history.= "<tr>";
                $history.= "<td>" .$log->getServiceNameByID($row['ServiceID'])."</td>";
                $history.= "<td>" .$row['Description']."</td>";
                $history.= "<td>" .$row['RequestDate']."</td>";
                $history.= "<td>" .$row['Duration']."</td>";
                $history.= "<td>" .$row['DueDate']."</td>";
                $history.="</tr>";
            }
            $history.="</table>";
?>
>>>>>>> 8aa3f5d384fea75cb562ed7f406ee66ad686f589
