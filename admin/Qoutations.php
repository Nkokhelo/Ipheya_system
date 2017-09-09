<?php

    session_start();
    if(isset($_SESSION['Employee']))
    {
     require_once('../core/init.php');
	 include('../core/logic.php');
     include('includes/head2.php');
    //  include('includes/navigation.php');
     require_once("../core/controllers/qoutation-controller.php");
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
            <div class='col-xs-11 b'>
              <h2>All qoutations</h2><hr class="bhr"/>
                <table class="table" id="qtable">
                    <thead>
                        <th>Qoute Name</th>
                        <th>Qoute Date</th>
                        <th>Valid Until</th>
                        <th>Qoute Status</th>
                    </thead>
                    <tbody>
                        <?=$allQoute?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
<script>
    $(document).ready(function(){
        $('#qtable').DataTable();
    });
</script>