<?php
   $db = mysqli_connect('localhost','root','','ipheya');
   #get ip
   $ip = $_SERVER['REMOTE_ADDR'];
   #validate if ip exists
   $ip_check = "SELECT * FROM targets WHERE ip_address = '$ip'";
   $ip_check_exe = mysqli_query($db,$ip_check);
   $ip_count = mysqli_num_rows($ip_check_exe);
   $ip_result = mysqli_fetch_assoc($ip_check_exe);
   if($ip_count>0){
     $tot_visits = $ip_result['total_visits'];
     $tot_visits +=1;
     $sql = "UPDATE targets SET last_visit = NOW(), total_visits = '$tot_visits' WHERE ip_address = '$ip'";
     mysqli_query($db,$sql);
   }
   else{
     $sql = "INSERT INTO targets(ip_address,first_visit,last_visit,total_visits) VALUES('{$ip}',NOW(),NULL,'1')";
     mysqli_query($db,$sql);
   }
?>
