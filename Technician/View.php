<?php
    include('../core/init.php');
	include('includes/head.php');
	include('includes/navigation.php');
    include'../core/logic.php';
    include'../core/controllers/suveyour-controller.php';
?> 
<div class="container-fluid" style="padding:1%;">
	<div class="col-md-8 col-md-offset-2 b" style="border:1px solid #eee;border-radius:1%;padding-bottom:20px;">
		<h2>All Surveying records </h2>
		<hr class="bhr">
		 <table class="table">
		  <thead>
		  	<th>Request ID</th>
		  	<th>Desciption</th>
		  	<th>Images</th>
		  </thead>
		  <tbody>
		  	<?=$surveyingList?>
		  </tbody>
		 </table>
		<hr class="bhr">
		 <? include'includes/Surveying-Modal.php'; ?>
		 <a class="btn btn-default" href="CreateSurvey.php">Create Survey</a>
	</div>
</div>
<script>
	$(document).ready(function()
	{
		$('#actions a').click(function()
		{
			var did = this.id;
			$("#delete").val(did);
			$('#edit').val(did);
			if($('#edit').val()!=null)
			{
					var id = $('#edit').val();
					$.ajax({
					        type:"get",
					        url:"includes/geteditInfo.php",
					        data:"edit="+id,
					        success:function(data)
							{
					            $("#result").html(data);
					        }
					    });
					return false;
			}
		});
		
	});
	

</script>