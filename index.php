<?php
session_start();
include ('config.php');
include('functions.php');
define('Permitted', TRUE);

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
		case 'profile':
			$page_title = "Профил";
			$tpl = "profile.php";
			break;
		case 'courses':
			if(isset($_POST['id'])){
				$_SESSION['c_id'] = $_POST['id'];
				$_SESSION['op'] = $_POST['op'];
				if(isset($_POST['name'])){
					$page_title = "Избираеми дисциплини от категория \"".$_POST['name']."\"";
				} else {
					$page_title = "Записване на избираеми дисциплини";
				}
			} else {
				$page_title = "Записване на избираеми дисциплини";
			}
			$tpl = "courses.php";
			break;
		case 'participate':
			$page_title = "Записани избираеми/задължителни дисциплини";
			$tpl = "participate.php";
			break;
		default:
			header('HTTP/1.1 404 Not Found');
			exit();
			break;
	}
} else {
	$page_title = "Календар на изпити";
	$tpl = "home.php";
}


include ('template.php');

?>
