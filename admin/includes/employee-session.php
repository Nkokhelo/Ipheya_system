<?php
   session_start();
   if(isset($_SESSION['Employee'])){

   }
   else{
     header('Location: ../login.php');
   }
?>
