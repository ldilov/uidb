<?php
require_once('config.php');
$firstname = $link->real_escape_string($_POST['firstname']);
$lastname = $link->real_escape_string($_POST['lastname']);
$email = $link->real_escape_string($_POST['email']);
$password = password_hash($link->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
if((int)$_POST['type'] == 0){
	$middlename = $link->real_escape_string($_POST['middlename']);
	$program = $middlename = $link->real_escape_string($_POST['program']);
	$degree = "Бакалавър";
	$query = "INSERT INTO students (password, firstName, middleName, lastName, email, degree, program_id) VALUES ('$password', '$firstname', '$middlename', '$lastname', '$email', '$degree', '$program_id')";
} else {
	$title = $link->real_escape_string($_POST['title']);
	$query = "INSERT INTO teachers (password, firstName, lastName, email, title) VALUES ('$password', '$firstname', '$lastname', '$email', '$title')";
}
if($result = $link->query($query)){
	$success = "Акаунта е създаден успешно. Моля впишете се с вашата ел.поща: $email";
	include('account_err.php');
}
?>