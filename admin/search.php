<?php
include('../config.php');
if(!isset($_GET['key']))
{
	exit();
}
$key=$_GET['key'];
$array = array();
$query="select id, firstName, lastName, title, avatar from teachers where firstName LIKE '%{$key}%'";
$result= $link->query($query);
while($row = $result->fetch_assoc())
{
	$array[] = [
				'lecturer' => $row['title']. " ".$row['firstName']." ".$row['lastName']." <img src=\"../".$row['avatar']."\" style=\"width:50px; height:50px;\">",
				'id' => $row['id']
				];
}
echo json_encode($array);

?>
