<?php
require_once('config.php');

if(!($_SERVER['REQUEST_METHOD'] == 'POST')){
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}

$firstname = htmlentities($link->real_escape_string($_POST['firstname']));
$lastname = htmlentities($link->real_escape_string($_POST['lastname']));
$email = htmlentities($link->real_escape_string($_POST['email']));
$city = htmlentities($link->real_escape_string($_POST['city']));
$phone = htmlentities($link->real_escape_string($_POST['phone']));
$password = $link->real_escape_string($_POST['password']);
$password = password_hash($password, PASSWORD_BCRYPT);
if((int)$_POST['type'] == 0){
	$middlename = htmlentities($link->real_escape_string($_POST['middlename']));
	$program = $link->real_escape_string($_POST['program']);
	$degree = "Бакалавър";
	$school = isset($_POST['school'])? $link->real_escape_string($_POST['school']) : 'Неизвестен';
	$skype = isset($_POST['skype'])? $link->real_escape_string($_POST['skype']) : 'Неизвестен';
	$query = "INSERT INTO students (password, firstName, middleName, lastName, email, degree, program_id, city, phone, school, skype) 
							VALUES ('$password', '$firstname', '$middlename', '$lastname', '$email', '$degree', '$program', '$city', '$phone', '$school', '$skype')";
} else {
	$title = $link->real_escape_string($_POST['title']);
	$query = "INSERT INTO teachers (password, firstName, lastName, email, title, city, phone) VALUES ('$password', '$firstname', '$lastname', '$email', '$title', '$city', '$phone')";
}
if($result = $link->query($query)){
	$success = "Акаунта е създаден успешно. Моля впишете се с вашата ел.поща: $email";
	include('account_err.php');
} else {
	echo "Възникна грешка по време на регистрацията!";
}
?>