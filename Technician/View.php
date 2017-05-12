<html>
<head></head>
<?php
	$con=mysqli_connect("localhost","root","");
	if(!$con)
		die("Could not connect".mysqli_error());
	mysqli_select_db($con,"Observe");
	$result=mysqli_query($con,'select * from Surveying');
	echo "<p><b>View All</b></p>";
	// function getRequest($b)
	// {
	// 	return mysqli_query($con,"select * from ServiceRequest where RequestID==$b");
	// }


	// function getClient($x)
	// {
	// 	$request = mysqli_fetch_assoc(getRequest($x));
	// 	return  $request['ClientID'];
	// }
echo "<table border='1' cellpadding='10'>";

echo "<tr> <th>Request ID</th> <th>Description</th> <th>Image</th></tr>";

while ($row=mysqli_fetch_array($result))
{
	echo "<tr>";
	// echo "<td>" .getClient($row['RequestID'])."</td>";
	echo "<td>" .$row['RequestID']."</td>";
	echo "<td>". $row['Description'] . "</td>";
	echo"<td>" .$row['Image'] . "</td>";
	echo '<td><a href="delete.php?id=' . $row['SurveyingID'] . '">Delete</a></td>';
	echo"</tr>";
}
echo"</table>"

?>
<p><a href="Surveying.php">Add a new record</a></p>
</html>