<?php
#21408789 Zulu NP
    include('../core/init.php');
	  include('includes/head.php');
	  include('includes/navigation.php');
    include'../core/logic.php';
    include'../core/controllers/suveyour-controller.php';
?>
<div class="container-fluid" style="padding:1%;">
	<div class="col-md-8 col-md-offset-2 b" style="border:1px solid #eee;border-radius:1%;margin-bottom:10px;">
		<h2>Record Survey</h2>
		<hr class="bhr">
		<form class="form" action="CreateSurvey.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="reqID">Request id</label>
				<select class="form-control" name="reqID" id="reqID" required>
					<?=$surveyingOptions?>
				</select>
			</div>
			<div class="form-group">
				<label for="discr">Description</label>
				<textarea name="discr" id="discr" class="form-control" rows="5" cols="40" placeholder='Enter Discription' required></textarea>
			</div>
			<div class="form-group">
				<label for="image">Photos</label>
				<input type="file" name="image" id="image"  required/>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-default" name="submit" value="Add Record"/>
			</div>
		</form>
	</div>
</div>
