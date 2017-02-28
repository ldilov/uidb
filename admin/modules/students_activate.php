<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

$query = "UPDATE students SET status = 0 WHERE fnumber = ".$_POST['student_id'];
try{
	$result = query($query);
	$success = "Правата на студента са подновени успешно!";
} catch (Exception $e){
	$error = $e->getMessage();
}
?>