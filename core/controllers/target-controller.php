<?php
    #retrieve target log
    $allTargets = '';
    $target_sql = "SELECT * FROM targets ORDER BY last_visit DESC";
    $target_exe = mysqli_query($db,$target_sql);
    while($target = mysqli_fetch_assoc($target_exe)) :
      $allTargets .= '<tr>
                       <td>'.$target['ip_address'].'</td>
                       <td>'.$target['first_visit'].'</td>
                       <td>'.$target['last_visit'].'</td>
                       <td>'.$target['total_visits'].'</td>
                       <td>
                          <a href="targets.php?delete='.$target['target_id'].'" class="btn btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                       </td>
                     </tr>';
    endwhile;

    if(isset($_GET['delete'])){
      $del_id  = mysqli_real_escape_string($db,$_GET['delete']);
      $del_id = (int)$del_id;
      $sql = "DELETE FROM targets WHERE target_id = '$del_id'";

      if(mysqli_query($db,$sql)){
        header('Location: targets.php');
      }
    }
?>
