<?php
  include 'includes/head.php';
  include('../core/init.php');
  include('../core/logic.php');
  require('../core/controllers/event-controller.php');
  ?>
<body>
  <div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
      <div id='content'>
        <div class='row'>
            <div class='col-xs-12'>
              <div class="col-xs-11 b">
                <h1 style="color:#888;" class="text-center">Up comming events</h1><hr class="bhr"/>
                <div class="col-xs-12">
                <?=$allevents?>
                </div>
              </div>
            </div>
        </div>
      </div>
  </div>
  <?php include('includes/footer.php'); ?>
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" id="event-data">

    </div>
  </div>
</div>
<!--Modal End -->
</body>
<script>
		function loadevent(id)
		{
				$('#event-data').load('http://localhost:81/ipheya/core/sub/finatialR.php?event_data='+id);
		}

	
	</script>

