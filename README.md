# UIDB - Университетска информационна база (УИБ)
## Авторски права
- Код: Лазар Дилов
- Графичен дизайн: [Виржиния Вълчева]

## Описание
УИБ е информационен портал за студенти и преподаватели.
Съдържа следните функционалности:
- Три нива на достъп
  - Студент
  - Преподавател
  - Системен администратор
- Студентски функционалности
  - Записване/отписване на избираема дисциплина
  - Календар (с дата и час) за обявени изпити
  - Профилна страница + редакция на профил
  - Страница със записани предмети
  - Страница с преподаватели
  - Страница с взети изпити
- Преподавателски функционалности
  - Календар с моите изпити
  - Страница с моите предмети + възможност за редакция на предметите
  - Страница само с моите избираеми дисциплини
  - Страница за оценяване на моите студенти ( + възможност за филтрация по даден предмет)
- Администраторски функционалности
  - Страница с всички студенти с възможност за филтрация по програма ( Компютърни науки, Информатика и тн... )
    - Възможност за редакция на студенти
    - Възможност за прекратяване/подновяване правата на студенти
  - Страница с всички преподаватели + възможност за редакция
  - Страница с всички курсове с възможност за филтрация по категории
    - Редакция на курсове (TODO)
    - Добавяне на задължителни дисциплини (TODO)
    - Добавяне на избираеми дисциплини
    - Настройки (TODO)
    - Записване/Отписване на студент от дисциплина по факултетен номер
  - Страница с програми (TODO)
  - Страница с изпити + редакция (TODO)
- Кутия за съобщения и система за изпращане на ЛС (TODO)
- XSS injection + SQL injection proof
- Responsive web design

## База от данни

Използва се релационна база от данни с СУБД: [MariaDB (MySQL 5)]
![DBMODEL](https://github.com/ldilov/uidb/blob/master/uidb-database.png?raw=true)

## Използвани технологии
Използвани са езиците HTML/CSS/JS за frontend, PHP 5 (съвместим и със PHP 7 ) за backend.


В реализацията на фронт-енд частта е използван и [Bootstrap]


Плъгини: [Qtip] и [CKEditor]

## Настройки
НастроЙките се осъществяват през `config.php`:
```php
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
$university_name = "СУ \"Св. Климент Охридски\"";  // Име на университета
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
$itemsPerPage = 8; //колко елемента на страница да показва (важи за админ панела)
?>
```

## Принцип на реализация
Системата използва `template based style`, тоест за самият сайт се използват готови шаблонни страници, в които се зарежда съдържанието
на изисканата от нас страница. Това става чрез маршрутизацията, реализирана в `index.php`.
Съобщенията за грешка се извеждат с подходящо съобщение до потребителя, а от гледна точка на кодова реализация, се изхвърлят изключения.

## Снимки
![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-45-26.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-46-13.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-46-38.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-56-11.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-56-46.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-57-06.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-57-43.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_21-58-37.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_22-04-11.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_22-04-37.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_22-05-16.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/chrome_2017-03-09_22-05-38.png?raw=true)
***


![alt](https://github.com/ldilov/uidb/blob/master/docs/firefox_2017-03-14_20-04-51.png?raw=true)

[MariaDB (MySQL 5)]: http://mariadb.org
[Bootstrap]: http://getbootstrap.com/
[Qtip]: http://qtip2.com/
[CKEditor]: http://ckeditor.com/
[Виржиния Вълчева]: https://www.behance.net/virzhiniyavalcheva
