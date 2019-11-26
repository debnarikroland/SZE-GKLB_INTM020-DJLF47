<?php
include("connect.php");
$sql = "SELECT * FROM `humidity` order by `timestamp` desc limit 1";
$result = mysqli_query($db,$sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$value = $row["value"];
	}

echo  $value . " %";
?>