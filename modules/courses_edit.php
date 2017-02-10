<?php
require_once(__DIR__."/../functions.php");
verify("..");
if(isset($_POST['time'], $_POST['day'], $_POST['auditorium'], $_POST['credits'])){
	$params = [
				'hour' => $_POST['time'],
				'day'  => $_POST['day'], 
				'auditorium' => $_POST['auditorium'], 
				'credits' => $_POST['credits'] 
			];

	try {
		update_table("courses", $params, "id =".$_POST['id']);
		$success = "Промените са записани успешно!";
	} catch (Exception $e){
		$error = "Съобщение: " .$e->getMessage();
	}
}
?>