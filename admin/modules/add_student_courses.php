<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

if(isset($_POST['fn']) && $_POST['fn'] != ''){
	$insert_query = "INSERT INTO participate (student_id, course_id, completed) VALUES (".$_POST['fn'].", ".$_POST['id']. ", 0)";
	if($res = $link->query($insert_query)){
		$success = "Студентът усппешно е записан за курса!";
	} else {
		$error = $link-> error;
	}
} else {
	$error = "Не сте въвели факултетен номер";
	return;
}
?>