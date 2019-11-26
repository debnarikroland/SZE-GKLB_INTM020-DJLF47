<?php
include("connect.php");
$sql = "SELECT * FROM `move` order by `timestamp` desc limit 1";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$value = $row["timestamp"];
	}

echo  $value;
?>