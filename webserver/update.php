<?php
include("connect.php");
$name = $_POST['name'];
$status = $_POST['status'];
echo $status;
$sql = "UPDATE light set status = '".$status."' where name = '".$name."'";
mysqli_query($db,$sql);
mysqli_close($db);

?>