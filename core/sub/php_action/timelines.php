<?php
require_once 'core.php';


if($_GET['timelines'])
{
 $data= '';
 $query="SELECT timeline_id, timeline FROM timelines";
 $res= $connect->query($query);
 
 while($d =$res->fetch_assoc())
 {
  $data.= "<option value='".$d['timeline_id']."'>".$d['timeline']."</option>";
 }
 echo json_encode($data);
}

?>