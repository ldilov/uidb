<?php
require_once(__DIR__."/../functions.php");
logged_in("..", $_SESSION['type'] > 0);

if(isset($_POST['course_id'], $_POST['student_id'])){
	$completed = $_POST['mark'] < 3.00 ? '0' : '1';
	$params = [
				"mark" => $_POST['mark'],
				"completed" => $completed
			];
	try {
		update_table("participate", $params, "student_id = ".$_POST['student_id']." AND course_id=".$_POST['course_id']);
		$success = "Данните са променени успешно!";
	} catch(Exception $e){
		$error = "Съобщение за грешка: ".$e->getMessage();
	}
}
?>