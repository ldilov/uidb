<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

if(isset($_POST['fn']) && $_POST['fn'] != ''){
	$delete_query = "DELETE FROM participate WHERE student_id = ".$_POST['fn']." AND course_id = ".$_POST['id'];
	if($res = $link->query($delete_query)){
		$success = "Студентът усппешно е отписан от курса!";
	} else {
		$error = $link->error;
	}	
} else {
	$error = "Не сте въвели факултетен номер";
	return;
}
?>