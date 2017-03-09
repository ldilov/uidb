<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");
if(isset($_POST['fn']) && $_POST['fn'] != ''){
	$query = "SELECT courses.id, courses.name, courses.credits, courses.limit, courses.type, teachers.title, teachers.firstName, teachers.lastName FROM courses 
				JOIN teachers on teacher_id = teachers.id
				WHERE courses.id NOT IN (SELECT course_id FROM participate WHERE student_id =  ".$_POST['fn']. ") AND program_id = (SELECT program_id FROM students WHERE fnumber = ".$_POST['fn'].") ";
	try  {
		$result = query($query);
		$cond = "true";
		$op = "AND";
		$data = isset($_GET['page']) ? query($query, $cond, $op, (($_GET['page']-1)*$itemsPerPage).", "."$itemsPerPage") : query($query, $cond, $op, $itemsPerPage);
		$pages = getPages($result);
		$result = query($query);
	} catch (Exception $e){
		$error = $e->getMessage();
	}
} else {
	$error = "Не сте въвели факултетен номер";
	return;
}
?>