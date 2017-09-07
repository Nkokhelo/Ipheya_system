<?php

    $logic = new Logic();
    $feedback="";
   if(isset($_POST['save_rentals']))
    {
        
        $asset_code= $_POST['asset_code'];
        $catergory= $_POST['catergory'];  
        $name= htmlspecialchars($_POST['name'], ENT_QUOTES);
        $description= htmlspecialchars($_POST['description'], ENT_QUOTES);
        $purchase_date= $_POST['purchase_date'];  
        $charge= $_POST['charge'];  
        $visibility= $_POST['visibility'];  
        $rentalimage= $_POST['rentalimage'];  

        $image=addslashes($_FILES['rentalimage']['tmp_name']);
        if(!isset($image))
        {
            if($_FILES['rentalimage']['error'])
            {
                $efeedback = $logic->display_error("Attechment Error".$_FILES['attachment']['error']);
            }  
        }
        else
        {
            if($_FILES['rentalimage']['size'] != "")
            {
                $image=file_get_contents($image);
                $image=base64_encode($image);
            }
            $save = "INSERT INTO `rentals`(`id`,`asset_code`,`color`,`catergory`,`name`,`description`,`purchase_date`,`charge,`visibility,`rentalimage`)      
                             VALUES (null,'$asset_code','#fff','$catergory','$name','$description','$purchase_date','$charge','$visibility','$rentalimage')";
            $result = mysqli_query($logic->connect(),$save);
            if(!$result)  
            { 
                    die($save);
                    $feedback =$logic->display_error(mysqli_error($logic->connect()));
            }
            else
            {
                $feedback =$logic->display_success("Rental Item Added Succesfully");
            }
        }

    } 
    ?>