<?php
require_once('functions.php');
verify();
//Меню
$menu_item[0] = $_SESSION['type'] == 0 ? "НЕВЗЕТИ ИЗПИТИ" : "ИЗПИТИ"; 
$menu_item[1] = $_SESSION['type'] == 0 ? "ЗАПИСВАНЕ НА ИЗБИРАЕМА ДИСЦИПЛИНА" : "ИЗБИРАЕМИ ДИСЦИПЛИНИ"; 
?>
<html>
<head> 
	<title> УИБ - Унивеситетска информационна база </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="styles/calendar.css" rel="stylesheet" type="text/css">
	<link href="styles/style.css" rel="stylesheet" type="text/css">
	<link href="styles/zsocial.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous" >
	<link href="styles/staff.css" rel="stylesheet" type="text/css">	
	<link rel="stylesheet" href="styles/font-awesome.min.css">
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="js/jquery-3.1.1.js"></script>
	
</head>
<body>
<div class="header">
	<div class="logo">
		<img src="<?php echo $university_logo; ?>">
	</div>
	<nav>
		<ul>
			<li><a class="third after" href="/index.php?p=exams"> <?php echo $menu_item[0]; ?></a></li>
			<li><a class="third after" href="/index.php?p=courses"> <?php echo $menu_item[1]; ?> </a></li>
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
						<td>Тел:</td>  <td><?php echo $phone; ?></td>
					</tr>
					<tr>
						<td>Поща:</td><td> <?php echo $mail; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="."></div>
		<div class="text">
			<h4>Дати за изпити</h4>
			<div>Ако желаете да проверите датите за изпитите от предстоящата ви сесия, можете да влезете <a href="/index.php">ТУК</a></div>
		</div>
	</li>
	<li>
		<div class="icon" data-icon="å"></div>
		<div class="text">
			<?php if($_SESSION['type'] == 0){ ?>
			<h4>Записани предмети</h4>
			<div>В тази секция можете да видите всички предмети, за които сте се записали. Това са както предметите, които сте взели, така и тези, които все още не сте взели. Моля натиснете <a href="/index.php?p=participate">ТУК</a></div>
			<?php } else { ?>
			<h4>Вашите предмети</h4>
			<div>В тази секция можете да видите всички предмети, за които сте се записали като преподавател. Тък можете и да редактирате съответните предмети. Моля натиснете <a href="/index.php?p=participate">ТУК</a></div>	
			<?php } ?>
		</div>
	</li>
	</ul>
	<div class="bar">
		<div class="bar-wrap">
			<ul class="links">
				<li><a href="index.php">Начало</a></li>
				<?php if($_SESSION['type'] == 0){ ?>
				<li><a href="index.php?p=passed">Взети изпити</a></li>
				<li><a href="index.php?p=staff">Преподаватели</a></li>
				<?php } else { ?>
				<li><a href="index.php?p=students">Студенти</a></li>
				<?php } ?>
				<li><a href="#">За нас</a></li>
			</ul>
			<div class="social">
				<a href="<?php echo  $fb_url; ?>" class="fb">
					<span data-icon="f" class="icon"></span>
					<span class="info">
						<span class="follow">Facebook страница</span>
					</span>
				</a>
				<a href="<?php echo  $tw_url; ?>" class="tw">
					<span data-icon="T" class="icon"></span>
					<span class="info">
						<span class="follow">Последвайте ни в Twitter</span>
					</span>
				</a>
				<a href="https://github.com/ldilov/uidb" class="rss">
					<span data-icon="g" class="icon"></span>
					<span class="info">
						<span class="follow">Посетете Github</span>
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