<?php
    $chat = $chatfooter = '';
    session_start();
    if(isset($_SESSION["Client"]))
    {
      $u = $_SESSION["Client"];
      $q = mysqli_query($db, "SELECT name, surname FROM clients WHERE email = '$u'");
      $qr = mysqli_fetch_assoc($q);
      $_SESSION['chat_client'] = $u;
      $tcquery = mysqli_query($db, "SELECT * FROM tc_account WHERE email = '$u'");
      $tcnum = mysqli_num_rows($tcquery);
      if($tcnum<1)
      {
        $newtc = mysqli_query($db, "INSERT INTO tc_account(email,name,surname) VALUES('{$u}','$qr[name]','$qr[surname]')");
        $chatentry = mysqli_query($db, "INSERT INTO chat(client_email,employee_id) VALUES('{$u}', (SELECT emp_no FROM employees WHERE token != '' LIMIT 1))");
        if($newtc&&$chatentry)
        {
          echo '<script>alert("'.$newtc.'")</script>';
        }
        else {
          echo '<script>alert("'.mysqli_error($db).'");</script><br>';
          echo '<script>alert("'."INSERT INTO tc_account(email,name,surname) VALUES('{$u}','$qr[name]','$qr[surname]')".'");</script>';
        }
      }
    }
    else{
      echo '<script>alert("No session is set!")</script>';
    }

    if(!isset($_SESSION['chat_client']))
    {
      $chat = '<form class="form">
                 <div class="form-group">
                    <input type="text" name="cname" class="form-control" placeholder="First name">
                 </div>
                 <div class="form-group">
                    <input type="text" name="csurname" class="form-control" placeholder="Last name">
                 </div>
                 <div class="form-group">
                    <input type="email" name="cemail" class="form-control" placeholder="Email">
                 </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="EnterChat" value="Enter Chat">
                 </div>
              </form>';
      $chatfooter = '<form class="form" id="chatBox" method="post" action="" onSubmit="">
                        <div class="input-group">
                            <input id="btn-input" type="text" name="message" class="form-control input-sm" readonly placeholder="Type your message here...">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" disabled onClick="return messageInsert();" name="Send" id="btn-chat">Send</button>
                                <!--<input class="btn btn-warning btn-sm" type="submit" name="Send"value="Send">-->
                            </span>
                        </div>
                    </form>';
      if(isset($_POST['EnterChat']))
      {
        $name = mysqli_real_escape_string($db, $_POST['cname']);
        $surname = mysqli_real_escape_string($db, $_POST['csurname']);
        $email = mysqli_real_escape_string($db, $_POST['cemail']);

        $newtc = mysqli_query($db, "INSERT INTO tc_account(email,name,surname) VALUES('{$email}','{$name}','{$surname}')");
        if(mysqli_query($db,$newtc))
        {
          $chatentry = mysqli_query($db, "INSERT INTO chat(client_email,employee_id) VALUES('{$email}', SELECT employee_id FROM employees WHERE token = 'default' LIMIT 1)");
        }
      }
    }
    else{
      $chatfooter = '<form class="form" id="chatBox" method="post" action="" onSubmit="">
                        <div class="input-group">
                            <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here...">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" onClick="return messageInsert();" name="Send" id="btn-chat">Send</button>
                                <!--<input class="btn btn-info btn-sm" type="submit" name="Send"value="Send">-->
                            </span>
                        </div>
                    </form>';
    }
?>
