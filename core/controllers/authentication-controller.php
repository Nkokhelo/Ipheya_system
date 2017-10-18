<?php
    $user = $_SESSION['Client'];

    $sql = mysqli_query($db, "SELECT * FROM authentication WHERE client_email = '$user'");
    $count = mysqli_num_rows($sql);
    if($count<1)
    {
      $msg = '<span style="color:rgb(224, 20, 20);font-size:1.1em">You currently have 2FA disabled</span>';
      $disabled=1;
    }
    else{
      $msg = '<span style="color:rgb(125, 236, 31);font-size:1.1em">Your 2FA is enabled.</span>';
    }
    if(isset($_GET['enable']))
    {
      $query = mysqli_query($db, "UPDATE authentication SET authenticate=1 WHERE client_email = '$user'");
      if(!$query)
      {
        echo '<script>alert("'.mysqli_error($db).'")</script>';
      }
      else{
        header('Location: ../login.php?auth=1');
      }
    }
    if(isset($_GET['disable']))
    {
      $query = mysqli_query($db, "UPDATE authentication SET authenticate=0 WHERE client_email = '$user'");
      if(!$query)
      {
        echo '<script>alert("'.mysqli_error($db).'")</script>';
      }
      else{
        header('Location: security.php?auth=1');
      }
    }

    if(isset($_GET['auth']))
    {
      $feedback = '';
    }
 ?>
