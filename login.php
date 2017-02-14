<?php
session_start();
require_once('config.php');
require_once('functions.php');

//Филтрираме базата подадените параметри
$email = htmlentities($link->real_escape_string($_POST['email']));
$password = htmlentities($link->real_escape_string($_POST['password']));

//Завка
if($_POST['type'] == 0) {
	$query = "SELECT fnumber, email, password, degree, program_id as program FROM students WHERE email = '$email'";
} else {
    $query = "SELECT id, email, password FROM teachers WHERE email = '$email'";
}

if(!$result = $link->query($query)){
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}

$account = $result->fetch_assoc();

if(password_verify($password, $account['password'])) {
	$_SESSION['verify'] = 1;
	$_SESSION['id'] = $_POST['type'] == 0 ? $account['fnumber'] : $account['id'];
	$_SESSION['program'] = $_POST['type'] == 0 ? $account['program'] : null;
	$_SESSION['program_id'] = $account['program'];
	$_SESSION['type'] = $_POST['type'];
	if(isset($account['degree'])){
		$_SESSION['degree'] = $account['degree'];
	}
	$result->close();
	header("location:index.php");
} else {
	$_SESSION['loginFailed'] = true;
	$result->close();
	die(header("location:index.php?loginFailed"));
}

?>