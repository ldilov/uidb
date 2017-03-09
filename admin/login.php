<?php
session_start();
require_once(__DIR__."/../functions.php");
require_once(__DIR__."/../config.php");

if(!isset($_POST['username']) || !isset($_POST['password'])){
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}

//Филтрираме базата подадените параметри
$username = htmlentities($link->real_escape_string($_POST['username']));
$password = htmlentities($link->real_escape_string($_POST['password']));

//Завка
$query = "SELECT id, username, password FROM sysadmins WHERE username = '$username'";

if(!$result = $link->query($query)){
	$_SESSION['loginFailed'] = true;
	die(header("location:index.php?loginFailed"));
}
$account = $result->fetch_assoc();

if(password_verify($password, $account['password'])) {
	$_SESSION['verify'] = 2;
	$_SESSION['id'] = $account['id'];
	$_SESSION['type'] = $_POST['type'];
	$result->close();
	header("location:index.php");
} else {
	$_SESSION['loginFailed'] = true;
	$result->close();
	die(header("location:index.php?loginFailed"));
}

?>