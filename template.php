<?php
require_once('functions.php');
logged_in();
?>
<html>
<head> 
	<title> УБИ - Унивеситетска информационна база </title>
	<meta charset="UTF-8"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="styles/calendar.css" rel="stylesheet" type="text/css">
	<link href="styles/style.css" rel="stylesheet" type="text/css">
	<link href="styles/zsocial.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="styles/upload.css">
	<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous" >
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="js/calendar.js"></script>
	<script src="jquery-3.1.1.min.js"></script>
	
</head>
<body>
<div class="header">
	<div class="logo">
		<img src="images/logo.png">
	</div>
	<nav>
		<ul>
			<?php $menu_item = $_SESSION['type'] == 0 ? "НЕВЗЕТИ ИЗПИТИ" : "ИЗПИТИ"; ?>
			<li><a class="third after" href="/index.php?p=exams"> <?php echo $menu_item ; ?></a></li>
			<li><a class="third after" href="/index.php?p=courses"> ЗАПИСВАНЕ НА ИЗБИРАЕМА ДИСЦИПЛИНА </a></li>
			<li><a class="third after" href="/index.php?p=profile"> ПРОФИЛ </a></li>
			<li><a class="third after" href="/index.php?p=logout"> <img src="images/glyphicons/png/glyphicons-681-door.png" height="20" width="20"/></a></li>
		</ul>
	</nav>
	<br>
	<p> Активен период: 
		<?php 
			if(date("M") > 6){
				echo date("Y") . "/" . date("Y") + 1 . " ";
				echo "зимен семестър";
			} else {
				echo date("Y") - 1;
				echo "/";
				echo date("Y") . " ";
				if(date("M") < 3 ) {
					echo "зимен семестър";
				} else {
					echo "летен семестър";
				}
			}
			echo " ";
			echo isset($_SESSION['degree']) ? $_SESSION['degree'] : null;
		?>
	</p>
	<p> 
	<?php if($_SESSION['type'] == 0){
			 echo "Студент: ";
			 $query = "SELECT firstName, middleName, lastName FROM students WHERE fnumber =". $_SESSION['id'];
			 $result = $link->query($query);
			 $name = $result->fetch_assoc();
			 echo $name['firstName'] . " " . $name['middleName'] . " " . $name['lastName'];
		} else {
			echo "Преподавател: ";
			$query = "SELECT firstName, lastName, title FROM teachers WHERE id =". $_SESSION['id'];
			$result = $link->query($query);
			$name = $result->fetch_assoc();
			echo $name['title'] . " " . $name['firstName'] . " " . $name['lastName'];
		} 
	?>		 
	</p>
</div>
<div class="container">
<?php 
	echo "<h2 class=\"page\" >". $page_title . "</h2>";
	echo "<br><br>";
	include($tpl); 
?>
</div>
<footer style="bottom: 0;">
	<div class="splitter"></div>
	<ul>
	<li>
		<div class="icon" data-icon="7"></div>
		<div class="text">
			<h4>Връзка с нас</h4>
			<div>
				Ако имате въпроси относно нашата онлайн система или въпроси от административен характер, можете да се свържете с нас на:
				<table>
					<tr>
						<td>Тел:</td>  <td>(+359 2) 9308 200</td>
					</tr>
					<tr>
						<td>Поща:</td><td> support@uni-sofia.bg</td>
					</tr>
				</table>
			</div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="."></div>
		<div class="text">
			<h4>Дати за изпити</h4>
			<div>Ако желаете да проверите датите за изпитите от предстоящата ви сесия, можете да влезете <a href="/index.php?p=exam_table">ТУК</a></div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="g"></div>
		<div class="text">
			<h4>Github</h4>
			<div>Управлението на тази система се извършва благодарение на Github. Системата е open-source и е достъпна за всички, които се интересуват от нея. Ако желаете да я свалите или да помогнете в развитието и, натиснете <a href="http://github.com/ldilov/">ТУК</a></div>
		</div>
	</li>
	</ul>
	<div class="bar">
		<div class="bar-wrap">
			<ul class="links">
				<li><a href="#">Home</a></li>
				<li><a href="#">License</a></li>
				<li><a href="#">Взети изпити</a></li>
				<li><a href="#">Преподаватели</a></li>
				<li><a href="#">За нас</a></li>
			</ul>
			<div class="social">
				<a href="https://facebook.com/pages/Софийски-университет-Св-Климент-Охридски/108126932554787" class="fb">
					<span data-icon="f" class="icon"></span>
					<span class="info">
						<span class="follow">Facebook страница</span>
					</span>
				</a>
				<a href="https://twitter.com/sofiauniversity?lang=bg" class="tw">
					<span data-icon="T" class="icon"></span>
					<span class="info">
						<span class="follow">Последвайте ни в Twitter</span>
					</span>
				</a>
				<a href="#" class="rss">
					<span data-icon="R" class="icon"></span>
					<span class="info">
						<span class="follow">Subscribe RSS</span>
					</span>
				</a>
			</div>
			<div class="clear"></div>
			<div class="copyright">Лазар Дилов &copy;  2017 Всички права са запазени</div>
		</div>
	</div>
</footer>
</body>
</html>