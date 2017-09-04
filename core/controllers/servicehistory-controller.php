<?php
$log = new Logic(); 
$result=mysqli_query($db,'select * from ServiceRequest');
    
        echo "<table class='table table-hover'>";
        echo "<tr> <th>Service Name</th> <th>Description</th> <th>Request Date</th> <th>Duration</th><th>Due Date</th> </tr>";
        while ($row=mysqli_fetch_array($result))
        {
                echo "<tr>";
                echo "<td>" .$log->getServiceNameByID($row['ServiceID'])."</td>";
                echo "<td>" .$row['Description']."</td>";
                echo "<td>" .$row['RequestDate']."</td>";
                echo "<td>" .$row['Duration']."</td>";
                echo "<td>" .$row['DueDate']."</td>";
                echo"</tr>";
            }
            echo"</table>";
?>