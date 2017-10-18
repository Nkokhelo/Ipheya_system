<?php
session_start();
if(isset($_SESSION['Employee']))
{
  include('../core/init.php');
  include('../core/logic.php');
  include('includes/head2.php');
  include('../core/controllers/observation-controller.php');
}
else
{
  header("Location:../login.php");
}
?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>

        <div class='col-xs-6'>
             <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-bullseye"></i> Obsevations</li>
             </ol>
        </div><!-- /col-xs-6-->


        <div class="col-xs-11 b">
                <h2>All obsevations</h2><hr class="bhr"/>
                <table class="table">
                  <thead>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Obsevations time</th>
                    <th>Obsever</th>
                    <th>Progress</th>
                  </thead>
                  <tbody>
                    <?=$allobsevations?>
                  </tbody>
                </table>
                <hr class="bhr">
              </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script type="text/javascript">
    $(".table").DataTable({
      order:  [ 2, 'des' ]
    });
</script>