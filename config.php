<?php
//Данни за свързване с БД
$host = 'localhost';   //сървър
$db_user = 'root';	  // потребител
$db_pass = ''; 		// парола
$db = 'website';	// име на БД

//Свързване с БД
$link = new mysqli($host, $db_user, $db_pass, $db);
$link->set_charset('utf8');

if (!$link) {
    echo "Възникна грешка при свързването с базата от данни." . PHP_EOL;
    die("Съобщение: " . mysqli_connect_errno());
}
// Данни за университета
$university_name = "СУ \"Св.св. Климент Охридски\"";  // Име на университета
$university_logo = "images/login_logo.gif";  //Лого на университета
$campaign_end = 12; // Крайна дата за отписване на избираеми дисциплини - кампанията за записване започва в месеца, в който започва семесстъра
$first_sem = 10; // Месец на начало на първи сем.
$second_sem = 2; // Месец на начало на втори семестър

//Контакти
$fb_url = "https://facebook.com/pages/Софийски-университет-Св-Климент-Охридски/108126932554787";
$tw_url = "https://twitter.com/sofiauniversity?lang=bg";
$phone = "(+359 2) 9308 200";
$mail = "support@uni-sofia.bg";

//Настройки на сайта
$url = "http://127.0.0.1"; //адрес на сайта
?>