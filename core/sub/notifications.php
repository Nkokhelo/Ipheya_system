<?php
    require_once('../init.php');
    require('../logic.php');
    $logic = new Logic();
    header('Content-Type: application/json');
    $data='';

    if(isset($_GET['count']))
    {
     $to = $_GET['count'];
     $q =mysqli_query($logic->connect(),"SELECT COUNT(not_id) as num FROM `notifications` WHERE n_to = '".$to."' AND unread = true");
     if(!$q)
     {
      $data ="error";
     }

     while($number = mysqli_fetch_assoc($q))
     {
      $data=$number['num'];
     }
     echo $data;
    }
    if(isset($_GET['load']))
    {
     $to = $_GET['load'];
     $q =mysqli_query($logic->connect(),"SELECT * FROM `notifications` WHERE n_to = '".$to."' AND unread = true");
     if(!$q)
     {
      $data ="error";
     }

     while($number = mysqli_fetch_assoc($q))
     {
      $data.="<li><p style='color:#aaa; margin-bottom:0; font-size:13px;'>".$number['n_from']."</p><b>
      <a href='javascript:updatenot(".$number['not_id'].","."&#39".$number['n_link']."&#39".");'>
      ".$number['n_message']."
      </a>
      </b><br/><p style='color:#aaa; font-size:13px; text-align:right;' class='text-right'>".date_format(date_create($number['n_date']),"h:m A ")."</p></li>";
     }
     echo $data;
    }

    if(isset($_GET['updatenot']))
    {
      $data='';
      $id = $_GET['updatenot'];
      $q =mysqli_query($logic->connect(),"UPDATE `notifications` SET `unread` = '0' WHERE `notifications`.`not_id` = $id");
      $data=1;
      if(!$q)
      {
        $data =0;
      }
      echo $data;
    }

?>
