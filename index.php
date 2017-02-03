<?php
session_start();
include ('config.php');

if(isset($_GET['loginFailed']) && isset($_SESSION['loginFailed'])){
	$error = "Вписването е неуспешно! Проверете името и паролата!";
	include('account_err.php');
	unset($_SESSION['loginFailed']);
	exit();
}
if(!isset($_SESSION['logged_in'])){
	include('account_err.php');
	exit();
}
if(isset($_GET['p'])){
	switch($_GET['p']){
		case 'logout':
			header("location:logout.php");
			break;
		case 'exams':
			$page_title = "Списък от невзети изпити";
			$tpl = "exams.php";
			break;
	}
} else {
	$page_title = "Начална страница";
	$tpl = "home.php";
}


include ('template.php');

?>

