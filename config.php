<?php
$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db = 'website';

$link = mysqli_connect($host, $db_user, $db_pass, $db);

if (!$link) {
    echo "Възникна грешка при свързването с базата от данни." . PHP_EOL;
    die("Съобщение: " . mysqli_connect_errno());
}

?>