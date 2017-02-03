<?php
//Данни за свързване с БД
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db = 'website';

//Свързване с БД
$link = new mysqli($host, $db_user, $db_pass, $db);
$link->set_charset('utf8');

if (!$link) {
    echo "Възникна грешка при свързването с базата от данни." . PHP_EOL;
    die("Съобщение: " . mysqli_connect_errno());
}
// Данни за университета
$university_name = "СУ \"Св.св. Климент Охридски\"";
$university_logo = "images/login_logo.gif";
?>