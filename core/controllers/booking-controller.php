<?php

    $logic = new Logic();
   if(isset($_POST['bookings']))
    {
        $name=$_POST['name'];
        $location =$_POST['location'];
        $date =$_POST['date'];
        $duration =$_POST['duration'];  
        $description =$_POST['description']; 
        $category =$_POST['category']; 
        
        $save = "INSERT INTO `events`(`name`,`location`,`date`,`duration`,`description`,`category`)      
        VALUES (null,'$name','$location','$date','$duration','$description','$category')";
         $result = mysqli_query($logic->connect(),$save);
        if(!$result)  
        { 
                die($save);
                $feedback =$logic->display_error(mysqli_error($logic->connect()));
        }
        else
        {
              $feedback =$logic->display_success("Saved successfuly");
        }
    } 
    ?>    