<?php
$logic =new logic();
$feedback="";
if(isset($_POST['save']))
{
$timeline=$_POST['timeline'];
$query="INSERT INTO `timelines` (`timeline_id`, `timeline`) VALUES (NULL, 'weekly');";
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