<?php

    $logic = new Logic();
    $feedback="";
   if(isset($_POST['Create_Event']))
    {
        $name= $_POST['name'];
        $description= $_POST['description'];
        $category= $_POST['category'];
        $sdate= $_POST['sdate'];  
        $edate= $_POST['edate'];  

        $image=addslashes($_FILES['eventimage']['tmp_name']);
        if(!isset($image))
        {
            if($_FILES['eventimage']['error'])
            {
                $efeedback = $logic->display_error("Attechment Error".$_FILES['attachment']['error']);
            }  
        }
        else
        {
            if($_FILES['eventimage']['size'] != "")
            {
                $image=file_get_contents($image);
                $image=base64_encode($image);
            }
            $save = "INSERT INTO `events`(`id`,`title`,`color`,`description`,`category`,`start`,`end`,`image`)      
            VALUES (null,'$name','#fff',$description','$category','$sdate','$edate','$image')";
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

    } 
    ?>    