<?php
    include'../../core/logic.php';


    $log = new Logic();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query ="SELECT * FROM `programs` WHERE `id` =".$id;
        $data ='no data';
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result)):
            $data = $program;
        endwhile;

        if($data =='no data')
        {
            $data='Error';
        }

        echo json_encode($data);
    }

    if(isset($_GET['clientInfor']))
    {
        $id = $_GET['clientInfor'];
        $query ="SELECT * FROM `clients` WHERE `client_no` ='$id'";
        // die($query);
        $data ='no data';
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result)):
            $data = "<h3 class='text-left' style='color:#888'>Client Information</h3><i class='fa fa-user-o'></i> Fullname : ".$program['name']." ".$program['surname']."<br/>
                     <i class='fa fa-send-o'></i> Email : ".$program['email']."<br/>
                     <i class='fa fa-phone'></i> Phone Number: ".$program['contact_number']."<br/>
                     <i class='fa fa-address-card-o'></i> Postal ".$program['postal_address']."<br/>
                     <a href='viewclient.php?view=".$program['client_id']."'>View this client history and peformance?</a>";
        endwhile;
        if($data =='no data')
        {
            $data='Error';
        }

        echo ($data);
    }

    if(isset($_GET['service']))
    {
        $query ="SELECT * FROM `services`";
        $data = array();
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result)):
            $data[] = $program;
        endwhile;

        if($data =='no data')
        {
            $data='Error';
        }

        echo json_encode($data);
    }

    if(isset($_GET['service_id']))
    {
        $rating='';
        $client_id='';
        $service_id='';
        $service_id =$_GET['service_id'];
        $client_id=$_GET['client_id'];
        $rating=$_GET['rating'];
        $query ="SELECT * FROM `s_ratings` where client_id=$client_id and service_id=$service_id";
        $data = array();
        $result = mysqli_query($log->connect(),$query);
        while($program  = mysqli_fetch_assoc($result)):
            $data[] = $program;
        endwhile;

        if($data==null)
        {
            $data="INSERT INTO `s_ratings` (`rating_id`, `client_id`, `service_id`, `rating`) VALUES (NULL, '$client_id', '$service_id','$rating')";
            $result = mysqli_query($log->connect(),$data);
            if(!$result)
            {
                $date="Error";
            }
            else
            {
                $data="success";
            }
        }
        else
        {
            $data='have rated this service';
        }
        echo json_encode($data);
        
    }
?>