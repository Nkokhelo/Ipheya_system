<?php
    require_once('init.php');

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
        $email = $_SESSION['chat_employee'];
        $empdata = mysqli_query($db, "SELECT emp_no FROM employees WHERE email = '$email'");
        $empdataresult = mysqli_fetch_assoc($empdata);

        $msgcountq = mysqli_query($db, "SELECT * FROM message WHERE message_from = '$email' AND message_body = '$msg'");
        $msgcount = mysqli_num_rows($msgcountq);
        if($msgcount==0)
        {
          if(mysqli_query($db, "INSERT INTO message(chat_id,message_time,message_from,message_to,message_body)
           VALUES((SELECT chat_id FROM chat WHERE employee_id = '$empdataresult[emp_no]'),NOW(),'$empdataresult[emp_no]',
           (SELECT client_email FROM chat WHERE employee_id = '$empdataresult[emp_no]'),'{$msg}')"))
           {

           }
           else{
             echo '<script>alert("'.mysqli_error($db).'")</script>';
           }
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
