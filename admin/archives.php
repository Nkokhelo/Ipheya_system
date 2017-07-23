<?php
  session_start();
   if(isset($_SESSION['Employee']))
    {
     require_once('../core/init.php');
     include('includes/head.php');
     require_once('../core/controllers/archive-controller.php');
     include('includes/navigation.php');
    }
    else
    {
      header("Location:../login.php");
    }

?>
<div class="container-fluid" style="padding:1%;">
     <div class="col-sm-8 col-sm-offset-2 b">
         <h2 class="text-center">Archived accounts</h2><hr class="bhr">
         <?php if($allClients==null)
         {
           echo "<div class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> No achived accounts at the moment !</div>";
         }
         else
         {?>
      <table class="table table-striped " style="padding:2%;">
        <thead>
          <th>Name</th><th>Email</th><th>Contact</th><th>Restore</th>
        </thead>
        <tbody>
          <?=$allClients;?>
        </tbody>
        <tfoot>

        </tfoot>
      </table>
      <?php } ?>
     </div>
</div>
<?php include('includes/footer.php'); ?>
