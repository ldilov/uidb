<?php
require_once(__DIR__."/../functions.php");
verify("..");

if(!campaignAvailable()){
	$error = "Кампанията за записване и отписване на избираеми дисциплини е приключила!";
	return;
}

$query = "DELETE FROM participate WHERE student_id = ".$_SESSION['id']. " AND course_id=".$_POST['id'];
try{
	$data = query($query);
	$success = "Дисциплината е отписана успешно!";
} catch (Exception $e){
	$error = $e->getMessage();
}

?>