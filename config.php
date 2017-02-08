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
$campaign_end = 12; // Крайна дата за отписване на избираеми дисциплини - кампанията за записване започва в месеца, в който започва семесстъра
$first_sem = 10; // Месец на начало на първи сем.
$second_sem = 3; // Месец на начало на втори семестър

//Настройки на сайта
$url = "http://127.0.0.1";
?>