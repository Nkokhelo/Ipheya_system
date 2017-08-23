<?php
		// include('../core/logic.php');
		// $log = new Logic();
		if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']))
		{
					$title = $_POST['title'];
					$start = $_POST['start'];
					$end = $_POST['end'];
					$color = $_POST['color'];

					$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
					$query = mysqli_query($log->connect(), $sql);
					if(!$query)
					{
						die($sql);
					}
		}	
?>
