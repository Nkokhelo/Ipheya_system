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
            <?php include('includes/RequestInfo.php');?>            
        </div>
        <?php include('includes/footer.php'); ?>
      </div>
  </div>
</body>
<script type="text/javascript">

    $('#cRequest').DataTable();

    function getInfor(rId,rT,cId)
    {
        $('#dataData').load('http://www.invest4living.com/ipheya/core/sub/getRequestInfo.php?ri='+rId+'&RType='+rT+'&ci='+cId);
    }
</script>