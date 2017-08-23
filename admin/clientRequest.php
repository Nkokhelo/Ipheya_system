<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
        include('includes/head2.php');
        include'../core/logic.php';
        include '../core/controllers/clientRequest-controller.php';
        // include'includes/navigation.php';
    }
    else
    {
        header('Location:../login.php');
    }
 ?>
<body>
  <div class="wrapper">
      <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-10 b'>
              <h2>Client Requests</h2><hr class="bhr"/>
                <table class="table" id="cRequest">
                    <thead>
                        <th>Client No</th>
                        <th>Request Type</th>
                        <th>Request Date</th>
                        <th>Request for</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        <?= $allRequest; ?>
                    </tbody>
                </table>
            </div>
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
            <div class="row" id="modal" style="margin:25px 1px 25px 25px;">
                <div class="col-xs-10 b" style="padding-bottom:15px;" id='change'>
                        <?php if(!isset($_GET['RType']))
                        {
                            include'includes/summary.php';
                        }
                        else
                        {
                            include'includes/RequestInfo.php';
                        }
                        ?>
                </div>
            </div>
<<<<<<< HEAD
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<<<<<<< HEAD
<<<<<<< HEAD
<div class="row"  style="margin:25px 1px 25px 25px;">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 b" style="padding-bottom:15px;" id='change'>

            <?php if(!isset($_GET['RType']))
            {
                include'includes/summary.php';
            }
            else
            {
                include'includes/RequestInfo.php';
            }
            ?> 
        
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 shift b">
        
    </div>
</div>
<?php include('includes/footer.php'); ?>
=======
>>>>>>> 99a079921e80d6f614019d96f8546c8a862ae4b0
=======
>>>>>>> bf70662ea22827d46098b33ba13833a6c3395e99
<script>
    $(document).ready(function(){
    $('table tbody tr').click(function()
    {
        window.location = $(this).attr('href');
        return false;
    });
    $('#cRequest').DataTable();
});
</script>