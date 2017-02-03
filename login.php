<?php
session_start();
require_once('config.php');

//Филтрираме базата подадените параметри
$email = $link->real_escape_string($_POST['email']);
$password = $link->real_escape_string($_POST['password']);

//Завка
if($_POST['type'] == 0) {
	$query = "SELECT id, email, password, degree FROM students WHERE email = '$email'";
} else {
    $query = "SELECT id, email, password FROM teachers WHERE email = '$email'";
}

if(!$result = $link->query($query)){
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}

$account = $result->fetch_assoc();

if(password_verify($password, $account['password'])) {
	$_SESSION['logged_in'] = 1;
	$_SESSION['id'] = $account['id'];
	$_SESSION['type'] = $_POST['type'];
	if(isset($account['degree'])){
		$_SESSION['degree'] = $account['degree'];
	}
	header("location:index.php");
} else {
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}
$result->close();
?>