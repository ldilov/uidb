<?php
session_start();
require_once(__DIR__."/../functions.php");
require_once(__DIR__."/../config.php");

if(!file_exists("../sys.lock")) {
	header('Location: ../install/install.php');
}

if(isset($_GET['loginFailed']) && isset($_SESSION['loginFailed'])){
	$error = "Вписването е неуспешно! Проверете името и паролата!";
	include('account_err.php');
	unset($_SESSION['loginFailed']);
	exit();
}

if(!isset($_SESSION['verify'])){
	include('account_err.php');
	exit();
}

define('Permitted', TRUE);

if(isset($_GET['p'])){
	switch($_GET['p']){
		case 'logout':
			header("location:logout.php");
			break;
		case 'exams':
			if($_SESSION['type'] == 0)
				$page_title = "Списък от невзети изпити";
			else
				$page_title = "Вашите изпити";
			
			$tpl = "exams.php";
			break;
		case 'profile':
			$page_title = "Профил";
			$tpl = "profile.php";
			break;
		case 'staff':
			$page_title = "Преподаватели";
			$tpl = "staff.php";
			break;
		case 'students':
			$page_title = "Студенти";
			$tpl = "students.php";
			break;
		default:
			header('HTTP/1.1 404 Not Found');
			exit();
			break;
	}
} else {
	$page_title = "Профил";
	$tpl = "home.php";
}

include ('template.php');
?>