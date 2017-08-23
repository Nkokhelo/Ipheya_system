<?php
 $logic = new Logic();
	$sql = "SELECT id, title, start, end, color FROM events ";
 $req = mysqli_query($db,$sql);
 // $events=array('id'=>'','title'=>'','start'=>'','end'=>'','color'=>'');
  // while($thiseve =mysqli_fetch_assoc($req)):
  //  $events =$thiseve;
  // endwhile;

 $feedback="";
 if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']))
 {
  
  $title = $_POST['title'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $color = $_POST['color'];
 
  $sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
  $query = mysqli_query($db,$sql);
  if ($query == false) {
     $feedback = $logic->display_error("Error".mysqli_error($db));
  }
 }
 
  

?>