<?php
   if(isset($_POST['Login']))
   {
     $email = mysqli_real_escape_string($db, $_POST['email']);
     $password = mysqli_real_escape_string($db, $_POST['password']);

     $sql = mysqli_query($db,"SELECT email FROM employees WHERE email = '$email' AND password = '$password'");
     $count  = mysqli_num_rows($sql);
     if($count>0)
     {
       $newtoken = sha1(microtime());
       $token = mysqli_query($db, "UPDATE employees SET token = '$newtoken' WHERE email = '$email'");
       if(!$token)
       {
         echo '<script>alert("'.mysqli_error($db).'")</script>';
       }
       else{
         session_start();
         $_SESSION['chat_employee'] = $email;
         header('Location: chatbox.php');
       }
     }
     else{
       echo '<script>alert("Account not found!");</script>';
     }
   }
?>
