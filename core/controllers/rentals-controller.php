<?php
$logic =new Logic();
$feedback="";
#add Timelines
if(isset($_POST['save']))
{
$timeline=$_POST['timeline'];
$query="INSERT INTO `timelines` (`timeline_id`, `timeline`) VALUES (NULL, '$timeline');";
$result = mysqli_query($db,$query);
if(!$result)
{
        $feedback =$logic->display_error("Error!".mysqli_error($db).$query);
}
else
{
      $feedback =$logic->display_success("Sucess! Setting saved");
}

}
#get all timelines
$alltimelines='';
$time="SELECT * FROM timelines ORDER BY timeline";
$timeL= mysqli_query($db,$time);
while($tm = mysqli_fetch_assoc($timeL))
{
 $alltimelines .= '<option value="' .$tm['timeline_id'].'">' .$tm['timeline'].'</option>';
}
#Add Rentals
 if(isset($_POST['Save']))
 {
    $inventoryId=$_POST['inventoryId'];
    $quantity=$_POST['quantity'];
    $depostiAmount=$_POST['depostiAmount'];
    $duration=$_POST['duration'];
    $charge=$_POST['charge'];
    $penalty=$_POST['penalty'];

    $query="INSERT INTO rentals('rental_id','inventory_id','product_deposit','quantity') VALUES(NULL,'$inventoryId','$depostiAmount','$quantity')";
    $query="INSERT INTO timeline_rental('tr_id','timeline_id','rental_id','rental_charge','penalty') VALUES(NULL,NULL,'$inventoryId','charge','penalty')";
    $result = mysqli_query($db,$query);
    if(!$result)
    {
      $feedback =$logic->display_error("Error!".mysqli_error($db).$query);
    }
    else
    {
      $feedback =$logic->display_success("Sucess! Setting saved");    
    }
 }

?>