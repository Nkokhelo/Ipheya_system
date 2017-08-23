<?php

    $logic = new Logic();
   if(isset($_POST['Create_Event']))
    {
        $name= $_POST['name'];
        $description= $_POST['description'];
        $category= $_POST['category'];
        $date= $_POST['date'];  
        $duration= $_POST['duration'];  
        
        $save = "INSERT INTO `events`(`name`,`description`,`category`,`date`,`duration`)      
                 VALUES (null,'$name','$description','$category','$date','$duration')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)  
        { 
                die($save);
                $feedback =$logic->display_error(mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Event Created Successfuly");
        }
    } 
    ?>    