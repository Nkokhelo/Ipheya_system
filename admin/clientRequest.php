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
 <script type="text/javascript" src="../assets/percicle/percircle.js"></script>
 <link rel="stylesheet" href="../assets/percicle/css/percircle.css">
<!-- /*<style>
  .percircle>span
  {
    top:35px;
    left:-7px;
  }
</style>*/ -->
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-11 b'>
              <h2>Client Requests</h2><hr class="bhr"/>
                <table class="table" id="cRequest">
                    <thead>
                        <th>Client</th>
                        <th>Request Type</th>
                        <th>Request Date</th>
                        <th>Request for</th>

                        <th>Status</th>
                    </thead>
                    <tbody style="cursor:pointer;">
                        <?= $allRequest; ?>
                    </tbody>
                </table>
            </div>
            <?php include('includes/RequestInfo.php');?>
        </div>
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
</body>
<script type="text/javascript">
    $('#cRequest').DataTable({
      order:  [ 2, 'asc' ]
    });

    function getInfor(rId,rT,cId)
    {
        $('#dataData').load('/ipheya/core/sub/getRequestInfo.php?ri='+rId+'&RType='+rT+'&ci='+cId);
        progress();
    }
    function progress(){

    }

</script>
