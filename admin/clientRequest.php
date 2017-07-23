<?php
    session_start();
    if(isset($_SESSION['Employee']))
    {
        include('includes/head.php');
        include'../core/logic.php';
        include '../core/controllers/clientRequest-controller.php';
        include'includes/navigation.php';
    }
    else
    {
        header('Location:../login.php');
    }
 ?>
    
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
</div>
<?php include('includes/footer.php'); ?>
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