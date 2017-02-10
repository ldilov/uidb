<?php
if(file_exists("install.lock")) {
	die("<p style=\"color:red\"> Инсталацията вече е извършена! Не можете да я изпълните за втори път! </p>");
}
require_once('../config.php');
$file = file_get_contents('database.sql');

if (mysqli_multi_query($link, $file)) {
     echo "<p style=\"color:green\">Инсталацията е успешна!</p>";
	 $lock = fopen("install.lock", "w");
	 $lock_system = fopen("../sys.lock", "w");
	 fclose($lock);
	 fclose($lock_system);
} else {
     die("Възникна грешка при инсталацията на базата от данни: <p style=\"color:red\">". PHP_EOL . $link->error . "</p>");
}
?>