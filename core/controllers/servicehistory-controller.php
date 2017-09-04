<?php
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
