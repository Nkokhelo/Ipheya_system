<?php
     include('includes/head.php');
     include'includes/navigation.php';
     include'../core/logic.php';
     include '../core/controllers/clientRequest-controller.php';
?>
<div class="row"  style="margin:25px 1px 25px 25px;">
    <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 fade in" id='change'>
<?php      if(!isset($_GET['RType']))
            {
                include'includes/summary.php';
            }
            else
            {
                include'includes/RequestInfo.php';
            }
?>
        
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
        <h3>Client Requests</h3>
        <table class="table" id="cRequest">
            <thead>
                <th>Client Name</th>
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
</div>
<?php include('includes/footer.php'); ?>
<script>
    $(document).ready(function(){
    $('table tbody tr').click(function()
    {
        window.location = $(this).attr('href');
        return false;
    });
});
</script>