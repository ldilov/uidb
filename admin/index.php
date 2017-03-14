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

if(!isset($_SESSION['verify']) || $_SESSION['verify'] != 2){
	include('account_err.php');
	exit();
}

define('Permitted', TRUE);

if(isset($_GET['p'])){
	switch($_GET['p']){
		case 'logout':
			header("location:logout.php");
			break;
		case 'teachers':
			if(isset($_POST['name'])){
				$page_title = "Преподаватели от катедра \"".$_POST['name']."\"";
			} else {
				$page_title = "Преподаватели";
			}
			$tpl = "teachers.php";
			break;
		case 'teachhers_add':
			$page_title = "Добавяне на преподавател";
			$tpl = "teachers_add.php";
			break;
		case 'courses':
			$page_title = "Курсове/Предмети";
			$tpl = "courses.php";
			break;
		case 'students':
			if(isset($_POST['name'])){
				$page_title = "Студенти от спец. \"".$_POST['name']."\"";
			} else {
				$page_title = "Студенти";
			}
			$tpl = "students.php";
			break;
		case 'participate':
			if(isset($_GET['op'])){
				if($_GET['op'] == "getuser" || $_GET['op'] == 'sign' || $_GET['op'] == 'remove'){
					$page_title = isset($_POST['fn']) && $_POST['fn'] != '' ? getStudentName($_POST['fn']) : "Записване на студенти за курсове";
				}elseif($_GET['op'] == "add"){
					$page_title = isset($_POST['fn']) && $_POST['fn'] != '' ? getStudentName($_POST['fn']) : "Записване на студенти за курсове";
				}
			} else {
				$page_title = "Записване на студенти за курсове";
			}
			$tpl = "participate.php";
			break;	
		case 'settings':
			$page_title = "Настройки";
			$tpl = "course_settings.php";
			break;
		case 'courses_add':
			$page_title = "Добавяне на курс";
			$tpl = "courses_add.php";
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