<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

$query = "DELETE FROM teachers WHERE id = ".$_POST['lecturer_id'];
try {
	query($query);
	$success = "Преподавателят е изтрит.";
} catch (Exception $e){
	$error = "Съобщение: " .$e->getMessage();
}
?>