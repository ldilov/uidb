<?php
require_once(__DIR__."/../functions.php");
logged_in("..");

$result = $link->query("SELECT DISTINCT student_id FROM participate WHERE course_id =".$_SESSION['c_id']);
$participants = $result->num_rows;
$data = fetch_table_rows("courses", "id=".$_SESSION['c_id']);
$course = $data->fetch_assoc();
if($course['limit'] <= $participants){
	$error = "Лимитът е изчерпан. Не можете да запишете избираемата дисциплина!";
} else {
	$result = $link->query("INSERT INTO participate VALUES(".$_SESSION['id'].", ".$_SESSION['c_id'] .", 0, 0)");
	if($link->affected_rows >= 0){
		$success = "Избираемата дисциплина ".$course['name']." е записана успешно!";
	} else {
		$error = "Възникна грешка! Избираемата дисциплина не е записана.";
	}
}

unset($_SESSION['op']);
unset($_SESSION['c_id']);
?>