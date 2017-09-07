<?php

    $logic = new Logic();

 if(isset($_POST['save_rentals']))
    {
        $name= htmlspecialchars($_POST['name'], ENT_QUOTES);
        $description= htmlspecialchars($_POST['description'], ENT_QUOTES);
        $asset_code= $_POST['asset_code'];
        $catergory= $_POST['catergory'];  
        $name= $_POST['name']; 
        $description= $_POST['description'];  
        $purchase_date= $_POST['purchase_date'];  
        $charge= $_POST['charge'];  
        $rentalimage= $_POST['rentalimage'];  
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
            $save = "INSERT INTO `rentals`(`id`,`title`,`color`,`description`,`category`,`start`,`end`,`image`)      
                             VALUES (null,'$name','#fff','$description','$category','$sdate','$edate','$image')";
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