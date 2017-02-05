<?php
require_once('functions.php');
session_start();
//Логнати ли сме
logged_in();

if(isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0){
	$dir = "images/avatars/";
	$file = $dir . basename($_FILES["avatar"]["name"]);
	$flag = 1;
	$imageFileType = pathinfo($file,PATHINFO_EXTENSION);
	
	// Проверка на размера
	if ($_FILES["avatar"]["size"] > 4000000) {
		$error = "Файлът е твърде голям.";
		$flag = 0;
	}
	// Рестрикция на форматите
	$temp = explode(".", $_FILES["avatar"]["name"]);
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$error = "Само JPG, JPEG, PNG и GIF файлове са разрешени.";
		$flag = 0;
	} elseif(sizeof($temp) > 2){
		$error = "Проблем с формата на файла!";
		$флаг = 0;
	}

	// Проверяваме размера на файла
	try {
		$check = getimagesize($_FILES["avatar"]["tmp_name"]);
			if($check !== false) {
				$flag = 1;
			} else {
				$error = "Файлът не е валидна картина!";
				$flag = 0;
			}
	} catch (ErrorException $e) {
		$error = "Файлът не е валидна картина!";
		$flag = 0;
	}
	if($check !== false) {
		$flag = 1;
	} else {
		$error = "Файлът не е валидна картина!";
		$flag = 0;
	}
	
	// ако всичко е ок можем да качим файла
	if($flag) {
		$success[] = "Файлът ".$_FILES["avatar"]["name"]." е качен успешно!";
		$newfilename = round(microtime(true)) . md5($temp[0]). '.' . end($temp);
		$file = $dir . $newfilename; 
		if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $file)) {
			$error = "Възникна грешка при качване на файла!";
		}
		try {
			if(!update_user_info(["avatar" => "$file"], $_SESSION['type'])){
				$error = "Възникна грешка при записване адреса на аватара в базата данни!";
			}
		} catch (Exception $e) {
			$error = 'Съобщение: '.  $e->getMessage(). "\n";
		}	
	}
}

if(isset($_POST['skype'])){
	$skype = htmlentities($link->real_escape_string($_POST['skype']));
		try {
			if(!update_user_info(["skype" => "$skype"], $_SESSION['type'])){
				$error = "Възникна грешка при промяна на записа в базата данни!";
		}
		} catch (Exception $e) {
			$error = 'Съобщение: '.  $e->getMessage(). "\n";
		}	
	$success[] = "Скайпът ви успешно е обновен!";
}

if(isset($_POST['city'])){
	$city = htmlentities($link->real_escape_string($_POST['city']));
		try {
			if(!update_user_info(["city" => "$city"], $_SESSION['type'])){
				$error = "Възникна грешка при промяна на записа в базата данни!";
		}
		} catch (Exception $e) {
			$error = 'Съобщение: '.  $e->getMessage(). "\n";
		}	
	$success[] = "Градът ви успешно е обновен!";
}
if(isset($_POST['phone'])){
	$phone = htmlentities($link->real_escape_string($_POST['phone']));
		try {
			if(!update_user_info(["phone" => "$phone"], $_SESSION['type'])){
				$error = "Възникна грешка при промяна на записа в базата данни!";
		}
		} catch (Exception $e) {
			$error = 'Съобщение: '.  $e->getMessage(). "\n";
		}
	$success[] = "Телефонът ви успешно е обновен!";
}
//Показване на профилната страница със съобщение за грешка/успех
$page_title = "Профил";
$tpl = "profile.php";
include('template.php');

?>