<?php

    $logic = new Logic();
    $feedback='';
   if(isset($_POST['save_bookings']))
    {
        $name=$_POST['name'];
        $email_address =$_POST['email_address'];
        $reminder =$_POST['reminder'];
        $cell_num =$_POST['cell_num'];  

        $save = "INSERT INTO `bookings`(`name`,`email_address`,`reminder`,`cell_num`)      
                    VALUES (null,'$name','$email_address','$reminder','$cell_num')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)  
        { 
           $feedback = $logic->display_error("error".mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Saved successfuly");
        }
    } 
    ?>    