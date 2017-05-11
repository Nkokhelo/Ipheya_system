
<?php

 echo "Today's date: ".date('Y-m-d'). "<br>";
 $sql = "Insert into table(date_inserted) VALUES(NOW())";
 $sql = "Insert into table(date_inserted) VALUES(DATE_ADD(CURDATE() ,INTERVAL -3 DAY)";

 echo "The time is" . date("h:i:sa");
?>