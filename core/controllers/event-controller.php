<?php

    $logic = new Logic();
    $feedback="";
    $allevents="";
    $events =$logic->getallevents();
    while ($all = mysqli_fetch_assoc($events))
    {
        $allevents .='	<div class="col-xs-3" id="event" style="border:1px #999 solid; max-height:340px; margin:1%; box-shadow:6px 6px 6px #eee;">
                    <div style="width:95%;  margin-left:-15px; height:150px;">
                        <img src="data:image/*;base64,'.$all['image'].'" style="display:block; padding-left:-6px;" width="120%" height="100%"/>
                    </div>
                    <div style="padding-bottom:3px; min-heigh:150px;">
                        <h3 style="display: -webkit-box;
                        overflow : hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 1;
                        -webkit-box-orient: vertical; ">'.$all['title'].'</h3>
                        <p style="display: -webkit-box;
                        overflow : hidden;
                        text-overflow: ellipsis;
                        -webkit-line-clamp: 3;
                        -webkit-box-orient: vertical; ">'.$all['description'].'</p>
                        
                        <p class="text-right"><a data-toggle="modal" data-target="#myModal" onclick="loadevent('.$all['id'].')" id="view">View</a> |'.date_format(date_create($all['start']),"d-F-Y").'</p>
                    </div>
                </div>';
    }

   if(isset($_POST['Create_Event']))
    {
        $name= htmlspecialchars($_POST['name'], ENT_QUOTES);
        $description= htmlspecialchars($_POST['description'], ENT_QUOTES);
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
            VALUES (null,'$name','#fff','$description','$category','$sdate','$edate','$image')";
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
    if(isset($_POST['subscribe_submit']))
    {
        $id=$_POST['event_id'];
        $email=$_POST['subscribe_email'];
        
    }
    ?>    