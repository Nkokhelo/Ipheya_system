<?php
    require_once('../init.php');

    if(!$db)
    {
      echo mysqli_error($db);
    }
    else{
      $msg = mysqli_real_escape_string($db, $_POST['message']);

      if(empty($msg) || $msg == '')
      {

      }
      else{
        session_start();
        $email = $_SESSION['chat_client'];

        $msgcountq = mysqli_query($db, "SELECT * FROM message WHERE message_from = '$email' AND message_body = '$msg'");
        $msgcount = mysqli_num_rows($msgcountq);
        if($msgcount==0)
        {
          mysqli_query($db, "INSERT INTO message(chat_id,message_time,message_from,message_to,message_body) VALUES((SELECT chat_id FROM chat WHERE client_email = '$email'),NOW(),'{$email}',(SELECT employee_id FROM chat WHERE client_email = '$email'),'{$msg}')");
        }
      }
    }

    function insert_message($data)
    {
      $data=trim($data);
      $data=stripslashes($data);
      $data=htmlspecialchars($data);
      return $data;
    }
 ?>
