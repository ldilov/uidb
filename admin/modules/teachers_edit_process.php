<?php
require_once(__DIR__."/../../functions.php");
verify_admin("..");

$teacher = fetch_user_info($_POST['id'], 1);
$attributes = array_keys($_POST);
foreach($attributes as $attribute){
	if($_POST[$attribute] == "" || $attribute == 'op' || $attribute == 'edit')
		continue;
	if($attribute == 'password'){
		$value = password_hash(htmlentities($link->real_escape_string($_POST[$attribute])), PASSWORD_BCRYPT);
	} else {
		$value = htmlentities($link->real_escape_string($_POST[$attribute]));
	}
	
	$params[$attribute] = $value;
}

try {
	update_table("teachers", $params, "id = ".$_POST['id']);
	$success = "Промените са записани успешно! Данните на преподавателят са обновени.";
} catch (Exception $e){
	$error = "Съобщение: " .$e->getMessage();
}
?>