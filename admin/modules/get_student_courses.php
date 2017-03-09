<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");
if(isset($_POST['fn']) && $_POST['fn'] != ''){
	$fnumber = htmlentities($link->real_escape_string($_POST['fn']));
} else {
	$error = "Не сте въвели факултетен номер";
	return;
}

$query = "SELECT courses.id, courses.name, courses.credits, courses.limit, courses.type, teachers.title, teachers.firstName, teachers.lastName FROM courses 
			JOIN participate ON courses.id = course_id
			JOIN teachers on teacher_id = teachers.id
			WHERE student_id = $fnumber" ;
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

?>