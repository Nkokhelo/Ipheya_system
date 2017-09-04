<?php
    $chat = $chatfooter = '';
    // session_start();
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
      }
    }
    else
    {
      echo '<script>No session is set!</script>';
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
                <!--<div class="form-group">
                    <input type="submit" class="btn btn-primary" name="EnterChat" value="Enter Chat">
                 </div>-->
              </form>';
      $chatfooter = '<div class="col-md-6">
                        <button type="button" name="cancel" class="btn btn-default">Cancel</button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="EnterChat" class="btn btn-success">Start</button>
                    </div>';
      if(isset($_POST['EnterChat']))
      {
        $name = mysqli_real_escape_string($db, $_POST['cname']);
        $surname = mysqli_real_escape_string($db, $_POST['csurname']);
        $email = mysqli_real_escape_string($db, $_POST['cemail']);

        $newtc = mysqli_query($db, "INSERT INTO tc_account(email,name,surname) VALUES('{$email}','{$name}','{$surname}')");
        if(mysqli_query($db,$newtc))
        $chatentry = mysqli_query($db, "INSERT INTO chat(client_email,employee_id) VALUES('{$email}', SELECT employee_id FROM employees WHERE token = 'default' LIMIT 1)");
      }
    }
    else{
      #$chatquery = mysqli_query($db, "SELECT chat_id FROM chat")
    /*  $chat = '<li class="left clearfix"><span class="chat-img pull-left">
          <img src="http://placehold.it/50/55C1E7/fff&amp;text=U" alt="User Avatar" class="img-circle">
      </span>
          <div class="chat-body clearfix">
              <div class="header">
                  <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                      <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
              </div>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                  dolor, quis ullamcorper ligula sodales.
              </p>
          </div>
      </li>
      <li class="right clearfix"><span class="chat-img pull-right">
          <img src="http://placehold.it/50/FA6F57/fff&amp;text=AME" alt="User Avatar" class="img-circle">
      </span>
          <div class="chat-body clearfix">
              <div class="header">
                  <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                  <strong class="pull-right primary-font">'.$qr['name'].' '.$qr['surname'].'</strong>
              </div>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                  dolor, quis ullamcorper ligula sodales.
              </p>
          </div>
      </li>
      <li class="left clearfix"><span class="chat-img pull-left">
          <img src="http://placehold.it/50/55C1E7/fff&amp;text=U" alt="User Avatar" class="img-circle">
      </span>
          <div class="chat-body clearfix">
              <div class="header">
                  <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                      <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
              </div>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                  dolor, quis ullamcorper ligula sodales.
              </p>
          </div>
      </li>
      <li class="right clearfix"><span class="chat-img pull-right">
          <img src="http://placehold.it/50/FA6F57/fff&amp;text='.substr($qr['name'], 0, 1).substr($qr['surname'], 0, 1).'" alt="User Avatar" class="img-circle">
      </span>
          <div class="chat-body clearfix">
              <div class="header">
                  <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                  <strong class="pull-right primary-font">Bhaumik Patel</strong>
              </div>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                  dolor, quis ullamcorper ligula sodales.
              </p>
          </div>
      </li>';*/

      $chatfooter = '<form class="form" id="chatBox" method="post" action="" onSubmit="">
                        <div class="input-group">
                            <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here...">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" onClick="return messageInsert();" name="Send" id="btn-chat">Send</button>
                                <!--<input class="btn btn-warning btn-sm" type="submit" name="Send"value="Send">-->
                            </span>
                        </div>
                    </form>';
    }
?>
